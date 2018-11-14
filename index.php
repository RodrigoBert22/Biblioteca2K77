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

        case 'CadastrarLivros':
        $script = "cadastrarLivro";
        $titulo = "Cadastrar Livro";
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
  </head>
  <body>
        <?php 
            include 'Views/verificaLogin.php';
            include 'Views/navbar.php';
            include 'Views/'.$script.'.php';
        ?>    
  </body>
</html>