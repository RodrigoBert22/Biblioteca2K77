<?php
    include_once '../Aplicacao/UsuarioAplicacao.php';
    include_once '../Dominio/Usuario.class.php';

    $erros = array();
    $form_data = array();
    
    $erros['nome'] = "";
    $erros['email'] = "";
    $erros['senha'] = "";

    $aplicacao = new UsuarioAplicacao();

    if (empty($_POST['operacao'])) {
		$erros['operacao'] = 'Operacao não foi informada';
    }
    else
    {                
        $operacao = $_POST['operacao'];
        switch($operacao)
        {
            case "VerificarLogin":
                if (empty($_POST['inputEmail'])) {
                    $erros['email'] = 'Você deve informar um email';
                }
            
                if (empty($_POST['inputSenha'])) {
                    $erros['senha'] = 'Você deve informar uma senha';
                }

                $Senha = $_POST['inputSenha'];
                $Email = $_POST['inputEmail'];


                $form_data = $aplicacao->VerificaLogin($Email, $Senha);
                break;

                case "VerificarLoginUsuario":
                if (empty($_POST['inputEmailU'])) {
                    $erros['email'] = 'Você deve informar um email';
                }
            
                if (empty($_POST['inputSenhaU'])) {
                    $erros['senha'] = 'Você deve informar uma senha';
                }

                $SenhaU = $_POST['inputSenhaU'];
                $EmailU = $_POST['inputEmailU'];


                $form_data = $aplicacao->VerificaLoginUsuario($EmailU, $SenhaU);
                break;

            case "AdicionarLivro":
                if (empty($_POST['inputLivro']) OR $_POST['inputLivro'] == "") {
                            $form_data['success'] = false;
                    $erros['livro'] = 'Você deve informar um Livro';
                }
    
                else if (empty($_POST['inputQtd']) OR $_POST['inputQtd'] == "") {
                    $form_data['success'] = false;
                    $erros['quantidade'] = 'Você deve informar a quantidade';
                }   

               
                else{
            
                $livro = new Usuario();
                $livro->Nome = $_POST['inputLivro'];
                $livro->Qtd = $_POST['inputQtd'];
                $form_data = $aplicacao->AdicionarLivro($livro);

                
                break;

                }

                case "emprestimoConfirmar":
                             
                
                $emprestimo = new Usuario();
                $emprestimo->LivroEmp = $_POST['emprestimoCombo'];
                $form_data = $aplicacao->Emprestimo($emprestimo);

                
                break;

                


                case "AdicionarUsuario":
                if (empty($_POST['inputEmail']) OR $_POST['inputEmail'] == "") {
                            $form_data['success'] = false;
                    $erros['email'] = 'Você deve informar um Email';
                }
    
                else if (empty($_POST['inputNome']) OR $_POST['inputNome'] == "") {
                    $form_data['success'] = false;
                    $erros['nome'] = 'Você deve informar um Nome';
                }

                else if (empty($_POST['inputSenha'] OR $_POST['inputSenha'] == "") OR $_POST['inputSenha'] == NULL) {
                    $form_data['success'] = false;
                    $erros['senha'] = 'Você deve informar uma Senha';
                }

                else if (empty($_POST['inputTipo']) OR $_POST['inputTipo'] == "") {
                    $form_data['success'] = false;
                    $erros['tipo'] = 'Você deve informar o Tipo';
                }

                else{
            
                $usuario = new Usuario();
                $usuario->Email = $_POST['inputEmail'];
                $usuario->Senha = $_POST['inputSenha'];
                $usuario->Nome = $_POST['inputNome'];
                $usuario->Data = $_POST['inputData'];
                $usuario->Tipo = $_POST['inputTipo'];
                $form_data = $aplicacao->AdicionarUsuario($usuario);

                
                break;
            }
        }
    }

    if (!empty($erros)) { //Se houve erros
		$form_data['success'] = false;
		$form_data['erros']  = $erros;
    }
    
    echo json_encode($form_data);
?>