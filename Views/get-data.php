<?php
if(!empty($_POST["allbooks"])){

	$conn = new mysqli("localhost", "root", "", "biblioteca");

  $consulta123 = mysqli_query($conn, "SELECT idLivro, COUNT(nomeLivro) as COUNT FROM livro WHERE nomeLivro LIKE '%".$_POST["nomeLivro"]."%'");
  echo "<label for=disp>Disponibilidade</label>";
       while($livrose = mysqli_fetch_object($consulta123)):
            // echo "<option value='$livrose->COUNT'>".$livrose->COUNT."</option>";
             echo "<input style='width: 500px' disabled type='text' class='form-control' id='dist' name='dist' value='".$livrose->COUNT."'>";

       endwhile;
}

?>