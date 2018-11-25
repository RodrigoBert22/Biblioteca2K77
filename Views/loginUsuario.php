<body id="LoginFormUsuario">
<div class="container">
  <div id="divMensagem"></div>
<h1 class="form-heading">Login Usuário</h1>

<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Necessário Login de Usuário para Empréstimo de Livros</h2>
   </div>

    <form id="formLoginU">
    <form class="form-signin" id="formLogin">
        <div class="form-group">
            <input type="email" id="inputEmailU" name="inputEmailU" class="form-control" placeholder="Email" required autofocus>

        <div class="form-group">

        <input type="password" id="inputSenhaU" name="inputSenhaU" class="form-control" placeholder="Senha" required >

        </div>
        <div class="forgot">
</div>
         <button class="btn btn-outline-success btn-primary btn-block " type="submit">Entrar</button>
         
    </form>
        </form>
        
    </div>
        <br>
         <p>Usuário não possui Login?</p>
         <button onclick="location.href = 'index.php?page=CadastrarUsuarios';" class="btn btn-info btn-block">Cadastrar</button>
</div>
</div>
</div>


</body>
</html>
