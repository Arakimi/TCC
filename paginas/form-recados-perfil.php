<?php

$user_fullname = $user_nome.' '.$user_sobrenome;


 $txt_for_recado = ($idDaSessao<>$idExtrangeiro) ? 'Deixe um recado para '.$user_fullname : 'Fazer Publicação';



	if(isset($_POST['postarrecado'])){

     
        if($_POST['txtrecado']<>''){
        Recados::setRecado($idDaSessao,$idExtrangeiro,$_POST['txtrecado']);

        $location = ($idExtrangeiro<>$idDaSessao) ? 'perfil.php?uid='.$idExtrangeiro : './';

        
        echo'<script>window.location="'.$location.'";</script>';       
        exit();
        }
    }
  		
	

?>
<br>
    <form name="deixar-recado" action="" method="post" enctype="multipart/form-data">
    <div id="mandar-postagem-perfil">
    	<textarea name="txtrecado" id="txtrecado" class="msgcampo" maxlength="250" placeholder="Escreva uma mensagem aqui para <?php echo $user_nome; ?>"></textarea>
    	<button name="postarrecado" class="btnmsg" type="submit" value="postar" id="postarrecado"><img src="img/env.png"/></button>							
    </div>
<!-- <p>com: (Usuario 1,  Usuario 2, Usuario 3) </p>

    
 -->
