<link rel="stylesheet" type="text/css" href="Content/css/custom.css">
  <div id="divMensagem" name="divMensagem"></div>
 <div class="principal-emprestimo container-fluid" style="justify-content: center; display: flex">
     <div class="container-emprestimo">
      <h5 id="user">Usuário:  <?php echo $_SESSION['nomeUsuario'] ?></h5>
         <h5 id="tipoUsuarioId1">Tipo: <?php echo $_SESSION['tipoUsuario'] ?></h5>
      <h5 id="data">Cadastro Expira em: <?php echo $_SESSION['vencimentoUsuario'] ?></h5>
      <a href="Views/sairUsuario.php"><button style="margin: 0 auto; text-align: center; display: block" type="button" id="deslogar" class="btn">Deslogar Usuário</button></a>

      <br>
       <div class="after-container-emprestimo">
         <h1 class="titulo-emprestimo">Emprestimo de Livros</h1>
          <form id="emprestimoConfirmar">
            <div class="form-group">
              <label for="nomeLivro">Nome Do Livro</label>
              <select style="width: 500px" class="form-control" name="emprestimoCombo" id="emprestimoCombo">
   <?php  

       $conn = new mysqli("localhost", "root", "", "biblioteca");

      // $consulta = mysqli_query($conn, "SELECT idLivro, nomeLivro, COUNT(nomeLivro) FROM livro GROUP BY nomeLivro");
         // echo "<option id='opt' value='0'> Selecione um Livro </option>";
       echo "<option id='opt' value= '0'> Selecione o Livro </option>";
       foreach ( $conn->query('SELECT idLivro, nomeLivro, COUNT(nomeLivro) AS COUNT FROM livro WHERE disponibilidade = 1 GROUP BY nomeLivro') as $row ) {
          echo "<option id='opt' value= ".$row['nomeLivro']."> ".$row['nomeLivro']." </option>";
      } 

   ?> 
</select>  

<div id="show" class="show">
</div>
<br>


<script type="text/javascript">
  var conceptName = $('#emprestimoCombo').val();
  //console.log(conceptName);

  $(document).ready(function(){ 
      $("#emprestimoCombo").change(function(){ 
        var conceptName = $(this).val();
        var allbooks = $(this).val(); 
        var dataString = "allbooks="+allbooks+"&nomeLivro="+conceptName; 

        $.ajax({ 
         type: "POST", 
          url: "Views/get-data.php", 
          data: dataString, 
          success: function(result){ 
            $("#show").html(result);
          }
      });

    });
  }); 

</script>



          </form>
       </div>
     </div>
 </div>