
		<!--meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> -->
        <link rel="stylesheet" type="text/css" href="estilo/default.css" /
		<script src="js/modernizr.custom.17475.js"></script>		
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquerypp.custom.js"></script>
		<script type="text/javascript" src="js/jquery.elastislide.js"></script>
		<script type="text/javascript">
			
			$( '#carousel' ).elastislide();
			
		</script>
		<div class="container demo-1">
			<!-- Codrops top bar -->
            <div class="codrops-top clearfix">
               
            </div><!--/ Codrops top bar -->

            <div>
            	<?php             	
include('./classes/conexao.php');
   $objLogin = new Login;
	
	/*VERIFICA SE ESTA LOGADO*/
	if(!$objLogin->logado()){
		include('login.php');
		exit();
	}

            		$idExtrangeiro = (isset($_GET['uid'])) ? $_GET['uid'] : $_SESSION['socialisee_uid'];
	$idDaSessao = $_SESSION['socialisee_uid'];

		

         	$album1 = mysql_query("SELECT * FROM `album`") or die(mysql_error());
     //       	$album = mysql_num_rows($album1);
            	$selfoto = mysql_query("SELECT * FROM `foto`") or die(mysql_error());
            	$foto = mysql_num_rows($selfoto);
            	//var_dump($album);
            //	var_dump($foto);
            	print '<ul id="carousel" class="elastislide-list">';
            	//while($album = mysql_fetch_array($album1)){
            	while(($foto = mysql_fetch_array($selfoto))){// AND ($album = mysql_fetch_array($album1))
            		
            	//	var_dump($foto['foto']);
            		if($foto['usuario'] == $_GET['uid']){
				print '<li><a href="#"><img src="uploads/fotos/'.$foto['foto'].'"/></a></li>';
					}
					}
				print '</ul>';
				?>
		</div>
	</div>
