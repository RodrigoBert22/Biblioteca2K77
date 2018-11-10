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

            case "AdicionarUsuario":
                if (empty($_POST['inputEmail']) OR $_POST['inputEmail'] == "") {
                            $form_data['success'] = false;
                    $erros['email'] = 'Você deve informar um Email';
                }
    
                else if (empty($_POST['inputNome']) OR $_POST['inputNome'] == "") {
                    $form_data['success'] = false;
                    $erros['nome'] = 'Você deve informar um Nome';
                }

                else if (empty($_POST['inputApelido']) OR $_POST['inputApelido'] == "") {
                   $form_data['success'] = false;
                    $erros['apelido'] = 'Você deve informar um Apelido/Nickname';
                }

                else if (empty($_POST['inputSenha'] OR $_POST['inputSenha'] == "") OR $_POST['inputSenha'] == NULL) {
                    $form_data['success'] = false;
                    $erros['senha'] = 'Você deve informar uma Senha';
                }
                //if(md5($_POST['inputSenha'] == "d41d8cd98f00b204e9800998ecf8427e")){
                //    $erros['senha'] = 'Você deve informar uma Senha';
                //}
                else{
            
                $jog = new Usuario();
                $jog->Email = $_POST['inputEmail'];
                $jog->Senha = $_POST['inputSenha'];
                $jog->Apelido = $_POST['inputApelido'];
                $jog->Nome = $_POST['inputNome'];
                $jog->Data = $_POST['inputData'];
                $jog->Api = base64_encode($_POST['inputSenha']);
                $jog->Tipo = 'J';
                $jog->ImgPerfil = 'profile.png';
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