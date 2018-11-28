
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



        public function Emprestimo($nomeLivroEmprestado)
        {
            $connection = new Connection();
            $conn = $connection->getConn();

            $sql = "UPDATE livro SET disponibilidade = 0 WHERE nomeLivro LIKE '".$nomeLivroEmprestado."%' AND disponibilidade = 1 LIMIT 1";           
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
                        $form_data['posted'] = 'Empréstimo efetuado com sucesso!';

                    }
                } 
                else
                {
                    $erros['email'] = 'Erro ao Realizar o Empréstimo';
                    $form_data['success'] = false;
                    $form_data['erros']  = $erros;
                }
            }
            $conn->close(); 

            echo json_encode($form_data);
            die();
        }



        public function VerificaLoginUsuario($email, $senha)
        {
            $connection = new Connection();
            $conn = $connection->getConn();

            $sql = "SELECT email, nome, tipo, data_vencimento_cadastro FROM usuario where email = ? and senha = ?";
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
                        $_SESSION['tipoUsuario'] = $row["tipo"];
                        //$_SESSION['vencimentoUsuario'] = $row["data_vencimento_cadastro"];

                    $dataSQL = $row["data_vencimento_cadastro"];
                    $dataDDMMAAAA = date("d/m/Y", strtotime($dataSQL));
                    $_SESSION['vencimentoUsuario'] = $dataDDMMAAAA;

                        if($_SESSION['tipoUsuario'] == 1){
                            $_SESSION['tipoUsuario'] = 'Professor';
                        }
                        else if($_SESSION['tipoUsuario'] == 2){
                            $_SESSION['tipoUsuario'] = 'Aluno';
                        }
                        else{
                            $_SESSION['tipoUsuario'] = 'Comunidade';
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