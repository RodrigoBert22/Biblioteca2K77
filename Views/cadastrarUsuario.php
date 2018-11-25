<link rel="stylesheet" type="text/css" href="Content/css/custom.css">		
		<div class="container-fluid">
			<div id="divMensagem"></div>
			<div class="APorraToda" style="width: 40%; display: block; margin: 0 auto; margin-top: 10%;" >
			<h1 style="text-align: center;">Cadastro de Usuário</h1>
			<form id="formCadastroUsuario">
			 <div class="form-group"><br>
		    <label for="inputTipo">Tipo</label><br>
  			<input type="radio" id="inputTipo" name="inputTipo" value="1"> Professor<br>
  			<input type="radio" id="inputTipo" name="inputTipo" value="2"> Aluno<br>
  			<input type="radio" id="inputTipo" name="inputTipo" value="3"> Comunidade<br>
  			</div>
			<div class="form-group">
			    <label for="inputEmail">Email</label>
			    <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="emailHelp" placeholder="Informe o email">
			  </div>
			  <div class="form-group">
			    <label for="inputNome">Nome</label>
			    <input type="text" class="form-control" id="inputNome" name="inputNome" aria-describedby="nomeHelp" placeholder="Informe o nome completo">	 
			  </div>
			  <div class="form-group">
			    <label for="inputData">Data de Nascimento</label>
			    <input type="date" class="form-control" id="inputData" name="inputData">
			  </div>
			  <div class="form-group">
			    <label for="inputSenha">Senha</label>
			    <input type="password" class="form-control" id="inputSenha" name="inputSenha" placeholder="Informe uma senha">
			  </div>
			  </div>
			  <button style="margin: 0 auto; text-align: center; display: block" type="submit" class="btn btn-outline-info">Cadastrar</button>
			</form>
			<br>
			<br>
		</div>