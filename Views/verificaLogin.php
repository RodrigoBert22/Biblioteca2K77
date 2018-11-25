<?php 
	if((!isset ($_SESSION['nome']) == true) && (!isset ($_SESSION['email']) == true) && $page != "Login")
	{
		unset($_SESSION['nome']);
		unset($_SESSION['email']);
		
		unset($_SESSION['emailUsuario']);
		unset($_SESSION['nomeUsuario']);
		unset($_SESSION['tipoUsuario']);
		unset($_SESSION['vencimentoUsuario']);
		header('location:index.php?page=Login');
	}
?>