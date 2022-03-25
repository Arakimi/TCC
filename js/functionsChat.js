jQuery(function(){

	var userOnline = Number(jQuery('span.user_onlines').attr('id'));
	var clicou = [];
	function in_array(valor, array){
		for(var i = 0; i < array.length; i ++){
			if(array[i] == valor){ 
				return true;
			}
		}
		return false;
	}

	function add_janela(id, nome, status){
		var janelas = Number(jQuery('#chats .window').length);
		var pixels = (280+4)*janelas;
		var style = 'float: none; position: absolute; bottom:0; left:' + pixels + 'px';

		var splitDados = id.split(':');
		var id_user = Number(splitDados[1]);

		var janela = '<div class="window" id="janela_' + id_user + '" style="' + style + '">';
		   janela += '<div class="header-window"><a href="#" class="close">X</a><span class="nome">' + nome + '</span></div>';
		   janela += '<div class="corpo-chat"><div class="mensagens"><ul> </ul></div>';
		   janela += '<div class="env-mensagem" id="' + id + '"><input type="text" name="mensagem" class="msg" id="'+id+'"></div></div></div>';


		jQuery('#chats').append(janela);
	}

	/*RETORNA MENSAGENS*/
	function retorna_historico(id_conversa){
		jQuery.ajax({
			type: 'POST',
			url: 'sys/historico.php',
			data: {conversacom: id_conversa, online: userOnline},
			dataType: 'json',
			success: function(retorno){
				jQuery.each(retorno, function(i, msg){
					if(jQuery('#janela_'+msg.janela_de).length > 0){
						if(userOnline == msg.id_de){
							jQuery('#janela_'+msg.janela_de+' .mensagens ul ').append('<li id="'+msg.id+'" class="eu"><p>'+msg.mensagem+'</p></li>');
						}else{
							jQuery('#janela_'+msg.janela_de+' .mensagens ul ').append('<li id="'+msg.id+'"><div class="imgPequena"><img src="uploads/user/'+msg.fotoUser+'" /></div><p>'+msg.mensagem+'</p></li>');
						}
					}
				});				
				

				[].reverse.call(jQuery('#janela_'+id_conversa+' .mensagens li')).appendTo(jQuery('#janela_'+id_conversa+' .mensagens ul'));
				var altura = jQuery('#janela_' + id_conversa + ' .mensagens').height();
				jQuery('#janela_'+id_conversa+' .mensagens').animate({scrollTop: altura}, '500');
			}
		});
	}

	jQuery('body').on('click', '#user-online a', function(){
		var id = jQuery(this).attr('id');
		jQuery(this).removeClass('comecar');

		var status = jQuery(this).next().attr('class');
		var splitIds = id.split(':'); 
		var idJanela = Number(splitIds[1]); /* usado para pegar os historicos */

		
		
		if(jQuery('#janela_'+idJanela).length == 0){ /* se a janela nao foi acionada ainda eu autorizo abrir */
			var nome = jQuery(this).text();
			add_janela(id, nome, status);
			retorna_historico(idJanela);
		}else{
			jQuery(this).removeClass('comecar');
		}

	});


	/* AÇÃO NECESSARIO PARA MINIMIZAR A JANELA */
	jQuery('body').on('click', '.header-window', function(){
		var next = jQuery(this).next();
		next.toggle(100);
	});

	/* AÇÃO QUE FECHA A JANELA */
	jQuery('body').on('click', '.close', function(){
		var parent = jQuery(this).parent().parent();
		var idParent = parent.attr('id');
		var splitParent = idParent.split('_');
		var idJanelaFechada = Number(splitParent[1]);
	
		var contagem = Number(jQuery('.window').length)-1;
		var indice = Number(jQuery('.close').index(this));
		var restamAfrente = contagem-indice;

		for(var i = 1; i <= restamAfrente; i++){
			jQuery('.window:eq(' + (indice + i) + ')').animate({left:"-=275"}, 200);
		}
		parent.remove();
		jQuery('#user-online li#' + idJanelaFechada + ' a').addClass('comecar');
	});

	jQuery('body').on('keyup', '.msg', function(e){
		 /* e.whice pega o numero da tecla por exemplo 13 = enter */
		if(e.which == 13 ){
			var texto = jQuery(this).val();
			var id = jQuery(this).attr('id');
			var split = id.split(':');
			var para = Number(split[1]);
			jQuery.ajax({
				type: 'POST',
				url: 'sys/submit.php',
				data: {mensagem: texto, de: userOnline, para: para},
				success: function(retorno){
					if(retorno == 'ok'){
						jQuery('.msg').val('');
					}else{
						alert("Ocorreu um erro ao enviar sua mensagem !");
					}
				}
			});
		}
	}); 
	/*VERIFICA NOVAS MENSAGEM*/
	function verifica(timestamp, lastid, user){
		var t; /*time (tempo de execução)*/
		jQuery.ajax({
			url: './sys/stream.php',
			type: 'GET',
			data: 'timestamp='+timestamp+'&lastid='+lastid+'&user='+user,
			dataType: 'json',
			success: function(retorno){
				clearInterval(t);
				if(retorno.status == 'resultados' || retorno.status == 'vazio'){
					t = setTimeout(function(){
						verifica(retorno.timestamp, retorno.lastid, userOnline);
					},1000);
					if(retorno.status == 'resultados'){
						jQuery.each(retorno.dados, function(i, msg){

							/*VERIFICA SE A JANELA JÁ ESTA ABERTA , CASO NAO TIVER ELE ABRE A JANELA*/
							if(jQuery('#janela_'+msg.janela_de).length == 0){
								jQuery('#user-online #'+msg.janela_de+' a').removeClass('comecar');
								jQuery('#user-online #'+msg.janela_de+' a').click();
								//jQuery('#user-online #'+msg.janela_de+' .comecar').click();
								clicou.push(msg.janela_de);
							}
							/*CASO ESTIVER ABERTA SÓ ADICIONA AS MENSAGENS*/
							if(!in_array(msg.janela_de, clicou)){
								if(jQuery('.mensagens ul li'+ msg.id).length == 0 && msg.janela_de >= 1){
									/*SE A MENSAGEM QUE ESTIVER CHEGANDO FOR PARA MIM*/
									if(userOnline == msg.id_de){
										jQuery('#janela_'+msg.janela_de+' .mensagens ul li').append('<li class="eu" id="'+msg.id+'"><p>'+ msg.mensagem +'</p></li>');
									}else{
										jQuery('#janela_'+msg.janela_de+' .mensagens ul li').append('<li id="'+msg.id+'"><div class="imgPequena"><img src="uploads/user/'+msg.fotoUser+'" /></div><p>'+ msg.mensagem +'</p></li>');
									}
								}
							}
						});
						var altura = jQuery(' .mensagens').height();
						jQuery('.mensagens').animate({scrollTop: altura}, '500');
						console.log(clicou);
					}
				}else if(retorno.status == 'erro'){
					alert('Desculpe, não conseguimos entender. Por favor atualize a pagina.');
				}
			},
			error: function(retorno){
				clearInterval(t);
				t = setTimeout(function(){
					verifica(retorno.timestamp, retorno.lastid, userOnline);
				},15000);

			}
		});
	}
	verifica(0,0,userOnline);
	
});







/*
STATUS> <span id="' + id_user + '" class="' + status + '"></span>
*/

/* */