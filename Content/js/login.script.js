$( document ).ready(function() {
	var request;

	$("#btnRegistrar").click(function(event){
		redirect("index.php?page=Cadastrar");
	});
	$("#formLogin").submit(function(event){

		event.preventDefault();

		if (request) {
			request.abort();
		}
		
		$("#divMensagem").empty();
		
		var $form = $(this);

		var $inputs = $form.find("input, select, button, textarea");

		var serializedData = $form.serialize();
		serializedData+="&operacao=VerificarLogin"

		$inputs.prop("disabled", true);

		request = $.ajax({
			url: "Controller/UsuarioController.php",
			type: "post",
			data: serializedData
		});

		request.done(function (response, textStatus, jqXHR){
			var response = $.parseJSON(response);
			if (!response.success) { 
				if (response.erros.email) {
					$('#divMensagem').append('<div class="alert alert-danger" role="alert">' + response.erros.email + '</div>')
					.fadeIn(1000).html();
				}
			}
			else {
					$('#divMensagem').append('<div class="alert alert-success" role="alert">' + response.posted + '</div>')
					.fadeIn(1000).html();

					redirect("index.php?page=Home");
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