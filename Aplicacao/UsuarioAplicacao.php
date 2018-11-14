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
    }
?>