
<?php    
    require_once("Connection.class.php");
    class UsuarioAplicacao
    {    

        public function AdicionarLivro($livro)
        {
            $connection = new Connection();
            $conn = $connection->getConn();

            $sqlLivro = "CALL cadastrarLivro('$livro->Nome', '$livro->Qtd')";

            $stmt = $conn->prepare($sqlLivro);
            
            $stmt->execute();

            if ($stmt->error) {
                $erros['nome'] = "Erro: " . $conn->error;
                $form_data['success'] = false;
                $form_data['erros']  = $erros; 
                
            } else {
                $form_data['success'] = true;
                $form_data['posted'] = 'Livro(s) cadastrado(s) com sucesso!';
            }

            $conn->close(); 

            echo json_encode($form_data);
            die();
        }

        public function AdicionarUsuario($usuario)
        {
            $connection = new Connection();
            $conn = $connection->getConn();

            $sqlLivro = "CALL cadastrarUsuario('$usuario->Email', '$usuario->Senha', '$usuario->Nome', '$usuario->Data', '$usuario->Tipo')";

            $stmt = $conn->prepare($sqlLivro);
            
            $stmt->execute();

            if ($stmt->error) {
                $erros['nome'] = "Erro: " . $conn->error;
                $form_data['success'] = false;
                $form_data['erros']  = $erros; 
                
            } else {
                $form_data['success'] = true;
                $form_data['posted'] = 'Usuário cadastrado com sucesso!';
            }

            $conn->close(); 

            echo json_encode($form_data);
            die();
        }

        public function VerificaLogin($email, $senha)
        {
            $connection = new Connection();
            $conn = $connection->getConn();

            $sql = "SELECT email, nome, senha FROM usuarioadmin where email = ? and senha = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $email, $senha); // 's' especifica o tipo => 'string'

            $stmt->execute();
            if ($stmt->error) {
                $erros['nome'] = "Erro: " . $conn->error;
                $form_data['success'] = false;
                $form_data['erros']  = $erros; 
                
            } else {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    if($row = $result->fetch_assoc()) {

                        session_start([
                            'cookie_lifetime' => 86400,
                        ]);
                        $_SESSION['email'] = $row["email"];
                        $_SESSION['nome'] = $row["nome"];
                             
                        $form_data['success'] = true;
                        $form_data['posted'] = 'Login efetuado com sucesso!';

                    }
                } 
                else
                {
                    $erros['email'] = 'usuário ou senha inválidos';
                    $form_data['success'] = false;
                    $form_data['erros']  = $erros;
                }
            }
            $conn->close();	

            echo json_encode($form_data);
            die();
        }



        public function Emprestimo($emprestimo)
        {
            $connection = new Connection();
            $conn = $connection->getConn();
            
            //$sql = "UPDATE livro SET disponibilidade = 0 WHERE nomeLivro LIKE '".$emprestimo->LivroEmp."%' AND disponibilidade = 1 LIMIT 1";           

            $sqlEmp = "CALL EmprestimoLivro('$emprestimo->LivroEmp', '$emprestimo->Qtd', '$emprestimo->idUsuarioE', '$emprestimo->idTipoUE')";

            //(IN `nomeLivroS` VARCHAR(150), IN QtdLivro INT(11), IN idUsuario INT (11), IN idTipoUsuario INT (11))

            $stmt = $conn->prepare($sqlEmp);
            
            $stmt->execute();

            //$sql2 = "INSERT INTO";           
            //$stmt = $conn->prepare($sql2);
            //$stmt->bind_param('ss', $email, $senha); // 's' especifica o tipo => 'string'

            //$stmt->execute();

             if ($stmt->error) {
                $erros['nome'] = "Erro: " . $conn->error;
                $form_data['success'] = false;
                $form_data['erros']  = $erros; 
            }else{
                $form_data['success'] = true;
                $form_data['posted'] = 'Empréstimo efetuado com sucesso!'; 
            }
            $conn->close(); 

            echo json_encode($form_data);
            die();
        }



        public function VerificaLoginUsuario($email, $senha)
        {
            $connection = new Connection();
            $conn = $connection->getConn();

            //$sql = "SELECT idUsuario, email, nome, tipo, data_vencimento_cadastro FROM usuario where email = ? and senha = ?";
            $sql = "SELECT 
            u.idUsuario AS idUsuario, 
            email, 
            nome, 
            tipo, 
            data_vencimento_cadastro,
            COUNT(e.idUsuario) AS 'livrosEmp'
            FROM usuario u
            INNER JOIN emprestimo e ON u.idUsuario = e.idUsuario
            WHERE email = ? and senha = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $email, $senha); // 's' especifica o tipo => 'string'

            $stmt->execute();
            if ($stmt->error) {
                $erros['nome'] = "Erro: " . $conn->error;
                $form_data['success'] = false;
                $form_data['erros']  = $erros; 
                
            } else {
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    if($row = $result->fetch_assoc()) {

                        session_start([
                            'cookie_lifetime' => 86400,
                        ]);
                        $_SESSION['emailUsuario'] = $row["email"];
                        $_SESSION['nomeUsuario'] = $row["nome"];
                        $_SESSION['tipoUsuarioID'] = $row["tipo"];
                        $_SESSION['idUsuario'] = $row["idUsuario"];
                        $_SESSION['qtdEmprestada'] = $row["livrosEmp"];
                        //$_SESSION['vencimentoUsuario'] = $row["data_vencimento_cadastro"];

                    $dataSQL = $row["data_vencimento_cadastro"];
                    $dataDDMMAAAA = date("d/m/Y", strtotime($dataSQL));
                    $_SESSION['vencimentoUsuario'] = $dataDDMMAAAA;

                     //var_dump($_SESSION);   
                        if($_SESSION['tipoUsuarioID'] == 1){
                            $_SESSION['tipoUsuario'] = 'Professor';
                            $_SESSION['limiteLivros'] = 5;
                            $_SESSION['prazo'] = 14;
                        }
                        if($_SESSION['tipoUsuarioID'] == 2){
                            $_SESSION['tipoUsuario'] = 'Aluno';
                            $_SESSION['limiteLivros'] = 3;
                            $_SESSION['prazo'] = 7;
                        }
                        if($_SESSION['tipoUsuarioID'] == 3){
                            $_SESSION['tipoUsuario'] = 'Comunidade';
                            $_SESSION['limiteLivros'] = 2;
                            $_SESSION['prazo'] = 4;
                        }
                             
                        $form_data['success'] = true;
                        $form_data['posted'] = 'Login de usuário efetuado com sucesso!';

                        //redirect("index.php?page=emprestimoLivro");
                        //header('location:../index.php?page=emprestimoLivro');
                        //echo 'redirect("index.php?page=emprestimoLivro")';
                        //header('location:index.php?page=emprestimoLivro');
                    }
                } 
                else
                {
                    $erros['email'] = 'usuário ou senha inválidos';
                    $form_data['success'] = false;
                    $form_data['erros']  = $erros;
                }
            }
            $conn->close(); 

            echo json_encode($form_data);
            die();
        }


    
}


?>