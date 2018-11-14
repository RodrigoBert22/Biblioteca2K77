$( document ).ready(function() {

	var request;

	// Cadastro Livros

	$("#formCadastroLivro").submit(function(event){

		event.preventDefault();

		if (request) {
			request.abort();
		}
		
		$("#divMensagem").empty();
		
		var $form = $(this);

		var $inputs = $form.find("input, select, button, textarea");

		var serializedData = $form.serialize();
		serializedData+="&operacao=AdicionarLivro"

		$inputs.prop("disabled", true);

		request = $.ajax({
			url: "Controller/UsuarioController.php",
			type: "post",
			data: serializedData
		});


		request.done(function (response, textStatus, jqXHR){
			console.log($.parseJSON(response));

			var response = $.parseJSON(response);
			console.log(response);

			if (!response.success) {
				if (response.erros.email) {
					$('#divMensagem').append('<div class="alert alert-danger" role="alert">' + response.erros.email + '</div>')
					.fadeIn(1000).html();
				}
				if (response.erros.senha) {
					$('#divMensagem').append('<div class="alert alert-danger" role="alert">' + response.erros.senha + '</div>')
					.fadeIn(1000).html();
				}
				if (response.erros.nome) {
					$('#divMensagem').append('<div class="alert alert-danger" role="alert">' + response.erros.nome + '</div>')
					.fadeIn(1000).html();
				}
				if (response.erros.apelido) {
					$('#divMensagem').append('<div class="alert alert-danger" role="alert">' + response.erros.apelido + '</div>')
					.fadeIn(1000).html();
				}
			}
			else {
					$('#divMensagem').append('<div class="alert alert-success" role="alert">' + response.posted + '</div>')
					.fadeIn(1000).html();
					//redirect("index.php?page=Home");
			}
		});

		request.fail(function (jqXHR, textStatus, errorThrown){
			$('#divMensagem').append('<div class="alert alert-danger" role="alert">Erro ao enviar os dados</div>')
					.fadeIn(1000).html();
		});

		request.always(function () {

			$inputs.prop("disabled", false);
		});

	});
});