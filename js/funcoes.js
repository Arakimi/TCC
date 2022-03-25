function add_like(id_artigo){
	$('#artigo_'+id_artigo+'_like').html('<img src="./img/load.gif" width="40px" height="20px" />');
	
	$.post('init/add_like.php', {id:id_artigo}, function(dados){
		if(dados == 'sucesso'){
			get_like(id_artigo);
			location.href="index.php";
			
		}else{
			alert("Você já votou neste artigo");
			location.href="index.php";
		}
	});
}

function get_like(id_artigo){
	$.post('init/get_like.php', {id: id_artigo}, function(valor){
		$('#artigo_'+id_artigo+'_like').text(valor);
	});
}

function un_like(id_artigo, id_user){
	$('#artigo_'+id_artigo+'_like').html('<img src="./img/load.gif" width="40px" height="20px" />');

	$.post('init/un_like.php', {id: id_artigo, user_id: id_user}, function(valor){
		if(valor == 'sucesso'){
			location.href="index.php";

		}else{
			alert("Desculpe, ocorreu algum erro");
			location.href="index.php";
		}	
	});
}