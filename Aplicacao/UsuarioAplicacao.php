<?php    
    require_once("Connection.class.php");

    class UsuarioAplicacao
    {    

      /*  public function AdicionarUsuario($usuario)
        {
            $connection = new Connection();
            $conn = $connection->getConn();
            
          //  $stmt = $conn->prepare("INSERT INTO jogador (email, senha, nome) VALUES (?, ?, ?)"); /INSERT _ OR

            $sqlC = "CALL cadastrarJogador('$jogador->Email', '$jogador->Senha', '$jogador->Nome', '$jogador->Apelido', '$jogador->Data', '$jogador->Api','$jogador->ImgPerfil' ,'$jogador->Tipo')";

            $stmt = $conn->prepare($sqlC);
            
            $stmt->execute();

            if ($stmt->error) {
                $erros['nome'] = "Erro: " . $conn->error;
                $form_data['success'] = false;
                $form_data['erros']  = $erros; 
                
            } else {
                $form_data['success'] = true;
                $form_data['posted'] = 'Jogador cadastrado com sucesso!';
            }

            $conn->close();	

            echo json_encode($form_data);
            die();
        }
*/
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