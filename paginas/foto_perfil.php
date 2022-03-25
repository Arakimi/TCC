<script type="text/javascript" src="../js/jcrop.js"></script>


<script type="text/javascript">

		$(function(){
		$('#cropbox').Jcrop({
		aspectRatio: 0,
		onSelect: updateCoords($(this))
		});

		function updateCoords(c){
		$('#x').val(c.x);
		$('#y').val(c.y);
		$('#w').val(c.w);
		$('#h').val(c.h);
		};
		});

</script>
<img src="uploads/user/<?php echo $user_img ?>" id="cropbox"/>
<div id="content-crop">
<form name="crop" method="post" enctype="multipart/form-data" action="crop.php">
	<input type="hidden" name="imagem" value="<?php echo $user_img ?>" />
	<input type="hidden" name="usuario" value="<?php echo $idDaSessao ?>" />
	<input type="hidden" name="x" id="x" />
	<input type="hidden" name="y" id="y" />
	<input type="hidden" name="w" id="w" />
	<input type="hidden" name="h" id="h" />
	<input type="submit" class="btnmsg" name="salvar" value="salvar" />
</form>
</div>