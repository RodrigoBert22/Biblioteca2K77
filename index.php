<?php
 if(!isset($_GET['page']))
        $page = "Home";
    else
        $page = $_GET['page'];

    switch($page)
    {
        case 'Home':
        $script = "home";
        $titulo = "Sistema";
        break;

        case 'emprestimoLivro':
            $script = "emprestimoLivro";
            $titulo = 'Empréstimo Livros';
            break;

        case 'CadastrarLivros':
        $script = "cadastrarLivro";
        $titulo = "Cadastrar Livro";
        break;

         case 'CadastrarUsuarios':
        $script = "cadastrarUsuario";
        $titulo = "Cadastrar Usuários";
        break;

        case 'loginUsuario';
        $script = "loginUsuario";
        $titulo = "Empréstimo Livros";
        break;

        case 'Login':
        default:
            $script = "login";
            $titulo = "Login";
            break;
    }
?>

<!DOCTYPE html>
<html>
  <head>
        <?php include 'Views/header.php' ?>
        <link href="Content/css/custom.css" rel="stylesheet" type=“text/css” />
    <title>Biblioteca 2K77 - <?php echo $titulo ?></title>
    <script src="Content/js/<?php echo $script ?>.script.js"></script>
        <script src="Content/js/util.js"></script>
  </head>
  <body>
        <?php 
            include 'Views/verificaLogin.php';
            include 'Views/navbar.php';
            include 'Views/'.$script.'.php';
        ?>    
  </body>
</html>