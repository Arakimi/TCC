//Reconhece o navegador
function openAjax(){
	var ajax;

	try{
		ajax = new XMLHttpRequest();
	}catch(erro){
		try{
			ajax = new ActiveXObject("Msxl2.XMLHTTP");
		}catch(ee){
			try{
				ajax = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				ajax = false;
			}
		}
	}

	return ajax;
 
}//Instancia dinamicamente o objeto xmlhttp

function busca(){
	if(document.getElementById){

		var termo = document.getElementById('q').value;
		var exibeResultado = document.getElementById('resultado-pesquisa-topo');
		

		if(termo !== "" && termo !== null && termo.length >= 3){
			var ajax = openAjax();

			ajax.open("GET", "buscar/topo/buscar.php?q=" + termo, true);
			ajax.onreadystatechange = function(){
				if(ajax.readyState == 1){
					exibeResultado.innerHTML = '<p>Carregando resultados...</p>';
				}

				if(ajax.readyState == 4){
					if(ajax.status == 200){
						var resultado = ajax.responseText;
						resultado = resultado.replace(/\ + /g , " ");
						resultado = unescape(resultado);
						exibeResultado.innerHTML = resultado;
					}else{
						exibeResultado.innerHTML = '<p>Desculpe mas ouve um erro na requisição</p>';
					}
				}
			}
		ajax.send(null);
		}
	}
	//Verifica se tem mais de 3 digitos na caixa de dialogo , se tiver exibe a caixa de resultado caso contrario deixa ela desativada
	if(document.getElementById('q').value=="" || document.getElementById('q').value.length < 3){
		$("#resultado-pesquisa-topo").removeClass("resu-ativo");
		$("#resultado-pesquisa-topo").addClass("resu-desativado");
	}else{
		$("#resultado-pesquisa-topo").removeClass("resu-desativado");
		$("#resultado-pesquisa-topo").addClass("resu-ativo");

	}
	
}