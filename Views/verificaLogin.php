<?php 
	if((!isset ($_SESSION['nome']) == true) && (!isset ($_SESSION['email']) == true) && $page != "Login")
	{
		unset($_SESSION['nome']);
		unset($_SESSION['email']);
		header('location:index.php?page=Login');
	}
?>