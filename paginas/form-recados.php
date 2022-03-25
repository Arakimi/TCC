<?php

$user_fullname = $user_nome.' '.$user_sobrenome;


 $txt_for_recado = ($idDaSessao<>$idExtrangeiro) ? 'Deixe um recado para '.$user_fullname : 'Fazer Publicação';



	   if(isset($_POST['postarrecado'])){

      $_POST['recadoamigos'] = isset($_POST['recadoamigos']) ? $_POST['recadoamigos'] : '';

        if($_POST['recadopara']=='selecionar' AND $_POST['recadoamigos']<>''){
        $para = $_POST['recadoamigos'];
        }else{
          $para = (!isset($_POST['recadopara'])) ? $idExtrangeiro : $_POST['recadopara'];
        }

        if($_POST['txtrecado']<>''){
        Recados::setRecado($idDaSessao,$para,$_POST['txtrecado']);

        $location = ($idExtrangeiro<>$idDaSessao) ? 'paginas/exbi-line.php?uid='.$idExtrangeiro : './';

        echo'<script>window.location="'.$location.'";</script>';
        exit();
        }
    }
  		
	if($idDaSessao==$idExtrangeiro):  

?>
<br>
<form name="deixar-recado" action="" method="post" enctype="multipart/form-data">
<div class="mandar-postagem">
	<textarea name="txtrecado" id="txtrecado" class="msgcampo" maxlength="250" placeholder="Escreva uma mensagem aqui"></textarea>
	<button name="postarrecado" class="btnmsg" type="submit" value="postar" id="postarrecado"><img src="img/env.png"/></button>							
</div>
<div style="display:none;" id="marcrecadosamigos">
        <ul class="marcaramigos">
            <?php
            $selamigos= DB::getConn()->prepare('SELECT u.id, u.nome, u.sobrenome, u.img FROM usuario u INNER JOIN amizade a ON (((u.id=a.de) AND (a.para=?)) OR ((u.id=a.para) AND (a.de=?))) AND a.status=1');
            $selamigos->execute(array($idExtrangeiro,$idExtrangeiro));
            $list_amigos = Amizade::list_amigos($idExtrangeiro);
        if($list_amigos['num']>0){

            while ($resAmigos= $selamigos->fetch(PDO::FETCH_NUM)) {
                /* Pega a foto de perfil do usuario ou se ele não tiver coloca a padrão */
                $imagemamigo = (file_exists('uploads/user/'.$resAmigos[3])) ? $resAmigos[3] : 'default_mas.png';
                /* Exibi os Amigos */
                echo '<li class="amigosli"><div id="campo-marcar"><label><input type="checkbox" value="'.$resAmigos[0].'" name="recadoamigos[]" class="checkrecadoamigos"> <img title="'.$resAmigos[1].' '.$resAmigos[2].'" class="amigosimg"  src="uploads/user/'.$imagemamigo.'" alt="" title="'.$resAmigos[1].' '.$resAmigos[2].'" /><br><span class="nome-marcar">'.$resAmigos[1].' '.$resAmigos[2].'</span></label></div></li><hr width="96%" size="1px" color="#EEEEEE" />';
                }   
        }else{
            /* Se não existir amigos */
            echo '<span class="amigos-erro-busca-postagem">Nenhum Amigo Encontrado</span>';
        }
        ?>
        
        
        </ul>
    </div>
<p>com: (Usuario 1,  Usuario 2, Usuario 3) </p>
<div id="radio">
	<select name="recadopara" id="recadopara" class="selmsg">
		<option value="publico">Publico</option>
    	<option value="amigos">Amigos</option>
        <option value="selecionar">Selecionar</option> 
    </select>
</div>

<?php endif; ?>