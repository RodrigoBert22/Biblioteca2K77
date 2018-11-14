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
        }
    }

    if (!empty($erros)) { //Se houve erros
		$form_data['success'] = false;
		$form_data['erros']  = $erros;
    }
    
    echo json_encode($form_data);
?>