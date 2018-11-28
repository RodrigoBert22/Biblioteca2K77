<?php
	session_start();
		unset($_SESSION['emailUsuario']);
		//$_SESSION['emailUsuario'] = NULL;
		unset($_SESSION['nomeUsuario']);
		//$_SESSION['nomeUsuario'] = NULL;
		unset($_SESSION['tipoUsuario']);
		//$_SESSION['tipoUsuario'] = NULL;
		unset($_SESSION['vencimentoUsuario']);
		//$_SESSION['vencimentoUsuario'] = NULL;
		header('location:../index.php?page=Home');

?>