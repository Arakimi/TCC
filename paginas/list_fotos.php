<?php 
$minhasfotos = Albuns::getAlbum((int)$_GET['aid']);

if(empty($minhasfotos)){
	header('Location: album.php');	
	exit();
}

if($minhasfotos['album']['permissao']==1 AND $idDaSessao<>$idExtrangeiro){
	header('Location: album.php');
	exit();

}elseif ($minhasfotos['album']['permissao']==2){

	$visivel = Amizade::solicitacao($idDaSessao,$idExtrangeiro);

	if($visivel['r']<>2 && $idDaSessao<>$idExtrangeiro) {
		header('Location: album.php');
	exit();

	}
}
?>

<span class="bem-vindo"><?php echo $minhasfotos['album']['titulo'].' ('.$minhasfotos['fotos']['num'].')' ?></span>
<span class="voltar-album"><a href="album.php?uid=<?php echo $idExtrangeiro; ?>">Voltar para os albuns de <?php echo $user_nome ?></a></span>
<br>

<?php
if(isset($_GET['fid'])){
	include('galeria.php');
	exit();
}
?>
<div id="listFotos">

<?php if(Albuns::meuAlbum((int)$_GET['aid'],$idExtrangeiro) AND $idDaSessao==$idExtrangeiro) {?><div id="btn-adicionar-fotos-album"><a href="album.php?uid=<?php echo $idDaSessao ?>&aid=<?php echo (int)$_GET['aid'] ?>&ac=ADD_FOTOS">Adicionar Fotos</a></div><?php } ?>

<?php 
// adicionando fotos
if (isset($_GET['ac']) AND $_GET['ac']=='ADD_FOTOS' AND $idDaSessao==$idExtrangeiro){
	include('addFotos.php');
	exit();
}


// listando fotos

if($minhasfotos['fotos']['num']>0){
	echo '<ul>';
	foreach ($minhasfotos['fotos']['dados'] as $resfotos):
		echo '<li><a href="album.php?uid='.$idExtrangeiro.'&aid='.(int)$_GET['aid'].'&fid='.$resfotos['id'].'" >'.$resfotos['legenda'].'<img src="uploads/fotos/'.$resfotos['foto'].'" width="200" /></a>';
	
		echo $idDaSessao==$idExtrangeiro ?'<a class="delfotos" id="delFoto-'.$resfotos['id'].'" href="javascript:void();">Excluir</a>': '';

			if($minhasfotos['album']['capa'] != $resfotos['foto'] AND $idDaSessao==$idExtrangeiro){
		echo '<a href="javascript:void(0);" lang="'.$resfotos['foto'].'" class="definirCapa"> CAPA </a>';
	}



		if($idDaSessao==$idExtrangeiro){

		echo $resfotos['legenda'] == '' ? '<br /><a class="editLegenda" id="editFoto-'.$resfotos['id'].'" title="Adicionar uma legenda" href="javascript:void(0);"> Editar legenda </a>' : '<p class="mudarlegenda">'.$resfotos['legenda'].'</p>';
	}else{
		
	}

	echo'</li>';
	endforeach;
	echo '</ul>';
	

}else{
	echo'<span class="sem-fotos-album-mensagem"> Não encontramos nenhuma foto neste album, desculpe ! <span>';
}
?>
</div>