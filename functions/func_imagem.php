<?php
function upload($tmp, $nome, $larguraP, $pasta){
	
	$ext = strtolower(end(explode('.',$name)));
	

	if($ext=='jpg'){
		$img = imagecreatefromjpeg($tmp);
	}elseif($ext=='gif'){
		$img = imagecreatefromgif($tmp);
	}else{
		$img = imagecreatefrompng($tmp);
	}

	$x = imagesx($img);
	$y = imagesx($img);

	$largura = ($x>$larguraP) ? $larguraP : $x;
	$altura = ($largura*$y) /$x;

	if($altura>$alturaP){
		$altura = $larguraP;
		$altura = ($largura*$y) /$x;		
	}

	$nome = imagecreatetruecolor($largura, $altura);
	imagecopyresampled($nova, $img, 0, 0, 0, 0, $largura, $altura, $x, $y);
	imagejpeg($nova, "$pasta/$nome");
	imagedestroy($img);
	imagedestroy($nova);

	return $nome;
}

if(isset($_POST['salvar'])){
	$img = $_FILES['img'];


	$exts = $arrayName('image/png', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/jpg');

	if(in_array($img['type'], $exts)){
		upload($img['tmp_name'], $img['name'], date('his').'.jpg', 800, 'uploads');
	}
}


?>




