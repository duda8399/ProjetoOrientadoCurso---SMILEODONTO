/*Início função adicionar campos*/
    var cont = 1;
		$('#add-campo').click(function () {
			cont++;

			$('#add-tipo').append('<div id="campo1' + cont + '"><label for="tipo" class="pt-3">Tipo:</label> <select class="form-control" name="tipo" id="' + cont + '"><option>Selecione:</option><option>Celular</option><option>Telefone residencial</option></select></div>');
			$('#add-telefone').append('<div id="campo2' + cont + '"><label for="telefone" class="pt-3">Telefone:</label><div class="input-group"><input type="tel" class="form-control" id="' + cont + '" name="telefone"><div class="input-group-append"><span class="input-group-text"><i class="fas fa-phone text-white"></i></span></div></div></div>');
			$('#tira-campo').append('<div id="campo3' + cont + '"><button type="button" id="' + cont + '" class="btn btn-danger btn-custom mt-5 btn-apagar"><i class="fas fa-minus text-white"></i></button></div>');
		});

		$('form').on('click', '.btn-apagar', function () {
                var button_id = $(this).attr("id");
                $('#campo1' + button_id + '').remove();
                $('#campo2' + button_id + '').remove();
                $('#campo3' + button_id + '').remove();
        });
/*Fim função adicionar campos*/

/* Início função pré-visualizar foto*/
	$(function(){
		$('#foto-upload').change(function(){
            const file = $(this)[0].files[0];
            const fileReader = new FileReader();
        	fileReader.onloadend = function(){
        	   $('#img-file').attr('src', fileReader.result);
            }
        	fileReader.readAsDataURL(file);
        	});
		});
/* Fim função pré-visualizar foto*/

/* Início função CEP*/
    $('#cep').blur(function (e) {
        var cep=$('#cep').val();
        var url="http://viacep.com.br/ws/" + cep + "/json/";
        var validacep=/^[0-9]{5}-?[0-9]{3}$/;

        if (validacep.test(cep)) {
            $('#mensagem').hide();
                pesquisarCEP(url);
        }else{
            $('#mensagem').show();
            $('#mensagem').html("CEP Inválido");
        }        
    });

    function pesquisarCEP (endereco) {
        $.ajax({
            type:"GET",
            url:endereco,
            async:false
        }).done(function (data) {
            $('#bairro').val(data.bairro);
            $('#endereco').val(data.logradouro);
            $('#cidade').val(data.localidade);
            $('#estado').val(data.uf);
            $('#complemento').val(data.complemento);
        }).fail(function(){
            console.log('erro');
        });
     }
/* Fim função CEP*/