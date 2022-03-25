<div id="listAlbuns-perfil">
<span class="bem-vindo">
	<?php 
		echo ($idDaSessao<>$idExtrangeiro) ? 'Albuns de '.$user_nome.' '.$user_sobrenome.'('.$albuns['num'].')' : 
		'Meus albuns ('.$albuns['num'].')';
	?> 
</span>
				
<?php if($idDaSessao==$idExtrangeiro){ ?>

 

<div id="form-albuns-env-perfil">
	<?php
		if(isset($_POST['criaralbum']) AND trim($_POST['tituloalbum'])<>''){
			$album = Albuns::newAlbum($user_id,$_POST['tituloalbum'],$_POST['descricao'],$_POST['permissao']);
			echo'<script>window.location="palbum.php?uid='.$idDaSessao.'&aid='.$album.'&ac=ADD_FOTOS";</script>'; 


		}else if(isset($_POST['criaralbum']) AND trim($_POST['tituloalbum'])==''){
			echo '<div class="error-campo-branco-album">Preencha o campo Titulo do Album para prosseguir.</div>';
		}
	?>
	<form name="novoalbum" method="post" enctype="multpart/form-data" action="">
		<input type="text" name="tituloalbum" placeholder="Titulo do Album" class="campo-envia-albuns">
		<input type="text" name="descricao" placeholder="Digite uma descrição para o Album" class="campo-envia-albuns"/>
		<div id="radio-button-albuns-cadastro">
			<input type="radio" name="permissao" checked="checked" value="2"/> Amigos
			<input type="radio" name="permissao" value="3" /> Publico
			<input type="radio" name="permissao" value="1" /> Privado
		</div>
		<input type="submit" class="btn-cadastrar-album-pagina" name="criaralbum" value="Criar Álbum"/>
	</form>
</div>

<?php } // Mostrar os albuns dependendo o nivel. 1 somente p o usuario, 2 amigos 3 todo mundo

if($albuns['num']>0){
	echo '<div id="exibe-albuns-principal-perfil"><ul>';

	$visivel = Amizade::solicitacao($idDaSessao,$idExtrangeiro);

	foreach ($albuns['dados'] as $resalbuns) :
		
		$numfotos = Albuns::getAlbum($resalbuns['id']);
		
		$file = 'uploads/fotos/'.$resalbuns['capa'];


		$li = '<li><a href="palbum.php?uid='.$idExtrangeiro.'&aid='.$resalbuns['id'].'"><img class="capa-album" src="'.(file_exists($file) ? $file : 'uploads/fotos/default.jpg').'" width="50px" height="50px" /><span>'.$resalbuns['titulo'].'  ('.$numfotos['fotos']['num'].')</span></a></li>';

		if($resalbuns['permissao']==1 AND $idDaSessao==$idExtrangeiro){
			echo $li;
		}elseif ($resalbuns['permissao']==2 AND $visivel['r']==2 || $idDaSessao==$idExtrangeiro) {
			echo $li;
		}else{//
			echo $li;
		}
	endforeach;
	echo '</ul></div>';


}else{
	echo '<div id="exibe-albuns-principal-none"> NÃO FORAM ENCONTRADOS ALBUNS ! <br><img class="sem-albuns-perfil" src="img/wind.png" width="100px" height="80px"/> </div>';
}

?>
</div> <!--listalbum>