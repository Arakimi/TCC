<div id="galeria-perfil">
<?php
if($minhasfotos['fotos']['num']>0){
	echo '<ul>';

	$verFoto = array();
	foreach ($minhasfotos['fotos']['dados'] as $resfotos):

if($resfotos['id']==$_GET['fid']){
	$verFoto[] = $resfotos;
}

		echo '<li><span><a href="palbum.php?uid='.$idExtrangeiro.'&aid='.(int)$_GET['aid'].'&fid='.$resfotos['id'].'" ><img src="uploads/fotos/'.$resfotos['foto'].'" width="50" /></a></span></li>';
	endforeach;
	echo '</ul>';
	

}else{
	echo'<span>Nenhuma foto encontrada</span>';
}

if(empty($verFoto)){
	header('Location: palbum.php');
	exit();
}

echo '<img class="atualfotogaleria-perfil" src="uploads/fotos/'.$verFoto[0]['foto'].'" />';
?>
</div>