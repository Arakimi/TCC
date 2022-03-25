$(function(){
	var atual_fs, next_fs, prev_fs;
	var formulario = $('form[name=formulario]');
	
	/* Botão Avançar */
	function next(elem){
		atual_fs = $(elem).parent();
		next_fs = $(elem).parent().next();

		$('#progress li').eq($('fieldset').index(next_fs)).addClass('ativo');
		atual_fs.hide(800);
		next_fs.show(800);
	}
	
	/* Botão Voltar */
	$('.prev').click(function(){
		atual_fs = $(this).parent();
		prev_fs = $(this).parent().prev();

	$('#progress li').eq($('fieldset').index(atual_fs)).removeClass('ativo');
		atual_fs.hide(800);
		prev_fs.show(800);
	});

	/* Verificação 1 Etapa*/
	$('input[name=next1]').click(function(){
		var array = formulario.serializeArray();
		
		if(array[0].value == '' || array[1].value == '' || array[2].value == '' || array[3].value == '' || array[4].value == '' || array[5].value == '' || array[6].value == '' || array[7].value == ''){
			$('#resp').html('<div id="errorCad"><br/>Preencha todos os campos antes de prosseguir</div>');
		}else{
			$('#resp').html('');
			next($(this));
		}
	})
	/* Verificação 2 Etapa*/
	$('input[name=next2]').click(function(){
		var array = formulario.serializeArray();
		
		if(array[8].value == '' || array[9].value == '' || array[10].value == '' || array[11].value == '' || array[12].value == '' || array[13].value == '' || array[14].value == '' || array[15].value == '' || array[16].value == '' ){
			$('#resp').html('<div id="errorCad" ><br/>Preencha todos os campos antes de prosseguir</div>');
		}else{
			$('#resp').html('');
			next($(this));
		}
	})

	$('input[type=submit]').click(function(evento){
		evento.preventDefault();
	});

});