		<meta charset="utf-8">
		<header>
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>

			  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			    <ul class="navbar-nav mr-auto">
			    	<li class="nav-item active">
			    		<?php 
			      	if((isset ($_SESSION['nome']) == null))
							{ ?>
			        <a class="nav-link" href="index.php?page=Login">Login<span class="sr-only">(current)</span></a>
			      </li>
			      <?php 
					 }
			      	?>

			      	<?php 
			      	if((isset ($_SESSION['nome']) == true))
			      		if((isset ($_SESSION['email']) == true))			   
							{ ?>
			      <li class="nav-item active">
			        <a class="nav-link" href="index.php?page=Home">Home<span class="sr-only"></span></a>
			      </li>
			      <?php 
					 }
			      	?>

			      	<?php 
			      	if((isset ($_SESSION['nome']) == true))
					{ ?>
			      <li class="nav-item">
			        <a class="nav-link" href="index.php?page=CadastrarLivros">Cadastrar Livros<span class="sr-only"></span></a>
			      </li>
			      	<?php 
			      	}
			      	?>
   	
   				<?php 
			      	if((isset ($_SESSION['nome']) == true))
					{ ?>
			      <li class="nav-item">
			        <a class="nav-link" href="Views/sair.php">Sair</a>
			      </li>
			      	<?php 
			      	}
			      	?>

			    </ul>
			  </div>
			</nav>
		</header>