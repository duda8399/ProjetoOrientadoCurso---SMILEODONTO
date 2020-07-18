/*
    var cont = 1;
		$('#add-campo').click(function () {
			cont++;

			$('#add-telefone').append('<div id="campo2' + cont + '"><label for="telefone" class="pt-3">Telefone:</label><div class="input-group"><input type="text" class="form-control tel" id="' + cont + '" name="telefone[]" placeholder="Ex.: (00) 00000-0000"><div class="input-group-append"><span class="input-group-text"><i class="fas fa-phone text-white"></i></span></div></div></div>');
			$('#tira-campo').append('<div id="campo3' + cont + '"><button type="button" id="' + cont + '" class="btn btn-danger btn-custom mt-5 btn-apagar"><i class="fas fa-minus text-white"></i></button></div>');
		});

		$('form').on('click', '.btn-apagar', function () {
                var button_id = $(this).attr("id");
                $('#campo2' + button_id + '').remove();
                $('#campo3' + button_id + '').remove();
        });

*/

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