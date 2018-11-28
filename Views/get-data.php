<?php
	session_start();
if(!empty($_POST["allbooks"])){

	$conn = new mysqli("localhost", "root", "", "biblioteca");
//var_dump($_SESSION);
//print_r($_SESSION['tipoUsuario']);
//echo "<br>";
  $consulta123 = mysqli_query($conn, "SELECT idLivro, COUNT(nomeLivro) as COUNT, (ROUND(COUNT(nomeLivro)/2)) as COUNT50  FROM livro WHERE nomeLivro LIKE '".$_POST["nomeLivro"]."%' AND disponibilidade = 1");
  echo "<label for=disp>Disponibilidade</label>";
       while($livrose = mysqli_fetch_object($consulta123)):
             echo "<input style='width: 500px' disabled type='text' class='form-control' id='dist' name='dist' value='".$livrose->COUNT."'>";
             if($_SESSION['tipoUsuarioID'] == 1){
             	echo "<br>";
            echo "<label style='width: 30%;margin: 0 auto; text-align: center; justify-content: center; align-items: center;display:flex' for='inputQtdR'>Quantidade Máx para Reservar:</label>'";
             echo "<input disabled style='width: 30%;margin: 0 auto; text-align: center;' type='text' class='form-control' name='qtdReservar' id='qtdReservar' value='".$livrose->COUNT50."'>";

         }
       endwhile;
}

?>