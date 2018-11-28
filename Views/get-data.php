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

             echo "<label id='disponibilidadeL' style='margin: 0 auto; text-align: center;justify-content: center;display: block;'>Deseja Alugar:</label>";

            echo "<input style='width: 30%;margin: 0 auto; text-align: center;' type='number' class='form-control' name='qtdEmp' id='qtdEmp' value='1' oninput='checkLength(this)' min='1' max='".$_SESSION['limiteLivros']."'>";

            echo "<button style='margin: 0 auto; margin-top: 10px; display: block; justify-content: center; align-items: center;' type='submit' id='emprestimoConfirmarBtn' class='btn'>Confirmar</button>";

             if($_SESSION['tipoUsuarioID'] == 1){
             	echo "<br>";
            echo "<label style='width: 30%;margin: 0 auto; text-align: center; justify-content: center; align-items: center;display:flex' for='inputQtdR'>Quantidade Máx para Reservar:</label>'";
             echo "<input disabled style='width: 30%;margin: 0 auto; text-align: center;' type='text' class='form-control' name='qtdReservar' id='qtdReservar' value='".$livrose->COUNT50."'>";

         }
       endwhile;
}

?>
<script type="text/javascript">
  function checkLength(elem) {
  if (elem.value > <?php echo $_SESSION['limiteLivros'] ?>) {
    elem.value = <?php echo $_SESSION['limiteLivros'] ?>;
  }
  else if(elem.value <= 0){
    elem.value = 1;
  }
}
</script>