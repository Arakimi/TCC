<?php 
    include ("./classes/conexao.php");
    include('./classes/funcoes.php');            
?> 
<script type="text/javascript">
    function placeOrder(form){
    form.submit();
}   
</script> 
 <?php 

    //Desativar Postagem no Banco
    if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['recadoId'])){
        extract($_POST);

        $update = DB::getConn()->prepare('UPDATE recados SET `status` = 0 WHERE `id` = ?');
        $update->execute(array($recadoId));
        $rows = $update->rowCount();

        echo '<script>window.location="./"; </script>';
    }

    //Enviar Comentario
    if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comentario'])){
            extract($_POST);            

            $inserir = DB::getConn()->prepare('INSERT INTO `comentarios` SET `comentario`=?, `usuario`=?,`recado`=?, `data`=NOW()');
            $inserir->execute(array($comentario,$idUser,$idRecado));
            $rows = $inserir->rowCount();

            echo'<script>window.location="./";</script>';
        }


    //Select Informações Id da Sessão
        $user_sessao = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `img` FROM usuario WHERE `id`=? ");
        $user_sessao->execute(array($idDaSessao));
        $usessao = $user_sessao->fetch(PDO::FETCH_ASSOC);

    //Importa Classe Recados
    $recados = Recados::getRecadosPerfil($idExtrangeiro);


    if($recados['num']>0){
        foreach($recados['dados'] as $asRecados){
            $de =  DB::getConn()->prepare("SELECT * FROM usuario u  where u.id = ?");
            $de->execute(array($asRecados['de']));

            $resp = $de->fetchAll();
            
            $userDe = $resp[0];
    
            $imagemamigo = (file_exists('uploads/user/'.$userDe[12])) ? $userDe[12] : 'default_mas.png';
            if($asRecados['para']=='amigos'){
                $amigos_recados = Amizade::list_amigos($asRecados[4]);
			}

            $asstatusamizade ['nome'] = $user_nome;
            $asstatusamizade ['sobrenome'] = $user_sobrenome;
            $asstatusamizade ['img'] = $user_img; 

             

            





            $para =  DB::getConn()->prepare("SELECT *
                FROM usuario u 
                where u.id = ?");


            $para->execute(array($asRecados['para']));

            

            


            $amigos_recados = Amizade::list_amigos($asRecados['de']);

            echo'<br><div id="msgtotal">
              <div id="corpomsg">
                    <div id="topmsg">
                    <div id="nomeusu">
                    	<a href="perfil.php?uid='.$asRecados['de'].'">'.$userDe['nome'].' '.$userDe['sobrenome'].'</a>
                    </div>        
                    <div id="hrmsg">
                    	<span>'.date('H:i',strtotime($asRecados[10])).'</span>
                    </div>
                    </div>
                    <div id="color">
            		<div id="ftmsg">
                    	<a href="perfil.php?uid='.$userDe['id'].' "><img width="90" height="100"  src="uploads/user/'.$userDe['img'].'" alt="" title="'.$userDe['nome'].' '.$userDe['sobrenome'].'"/></a>
                    </div>
                    <div id="parausu">';
                    if($asRecados['para'] == 'amigos'){
                   		echo'Disse para: <a href="#">Amigos</a>';
                    }else if($asRecados['para'] == 'publico'){
                        echo 'Disse para: Todos';
                    }else{
                        $resPara = $para->fetchAll();
            
                        $userPara = $resPara[0];
                        echo'Disse para: <a href="perfil.php?uid='.$userPara['id'].'">'  .$userPara['nome']. ' ' .$userPara['sobrenome'].'</a>';
                    }
             echo'</div>
                <br>
                    <div id="msgusu">                    
               	  		'.$asRecados[7].'
                    </div>
                    <div id="comentario">';?>
         
            
                    <?php

            echo        '<div id="fimmsg">	
                    </div>
            		</div>
                </div>

                <div id="curtidas">
                    <hr width="96%" size="1px" color="#EEEEEE" />
                ';

            if($asRecados['de'] == $idDaSessao){
                echo '<form method="POST" name="excluirPostagem">
                        <div id="excluir-postagem">                            
                            <input type="hidden" value="'.$asRecados[6].'" name="recadoId"/>
                            <input type="hidden" value="'.$asRecados['de'].'" name="idDe" />
                            <button type="submit"><img src="img/del.png" width="20" height="20"> </button>
                        </div>
                    </form>';
            }

?>
<script type="text/javascript" src="./js/jquerylike.js"></script>
<script type="text/javascript" src="./js/funcoes.js"></script>   

<?php
        $rec = get_artigos_by_id($asRecados['id']); 
        echo'<ul><div class="curtir-align">';
           
        if($rec['user_liked'] == '0'){
            echo'<a href="#" class="like" onclick="javascript:add_like('.$rec['id'].');"><img src="./img/curtir.png"/></a><span class="like-texto" id="artigo_'.$rec['id'].'_like">'.$rec['likes'].'</p></span>';
        }else{
            echo'

            <a href="#" class="like" onclick="javascript:un_like('.$rec['id'].','.$_SESSION['socialisee_uid'].');"><img src="./img/curtirAcionado.png"/></a><span class="like-texto-acionado" id="artigo_'.$rec['id'].'_like">'.$rec['likes'].'</p></span>';
        }
        echo'';
        
    
        echo '</div></ul>'; 
        
        echo '<hr width="100%" size="1px" color="#EEEEEE" /></div>'; ?>
        <?php 
            echo '</div>';
                    $idpost = $asRecados[6];
                    $selcom = DB::getConn()->prepare('SELECT c.id, c.usuario, c.recado, c.comentario, c.data, u.id, u.nome, u.sobrenome, u.img FROM comentarios c INNER JOIN usuario u ON c.usuario=u.id AND c.recado = ? GROUP BY c.id ');
                    $selcom-> execute(array($idpost));
                    $coment['num'] = $selcom -> rowCount();
                    $coment['dados'] = $selcom ->fetchAll();
                echo '
                    ';

       
                    
?> 
                   <div class="comentarios-form">
                    <form  name="commentform" method="post">
                        <img class="foto-user-comment-perfil" src="./uploads/user/<?php echo $usessao['img']; ; ?>" width="50px" height="50px" name="<?php echo $usessao['nome']; ?>"/>
                        <div class="align-comment">
                            <input type="text" name="idUser" hidden value="<?php echo $idDaSessao; ?>">
                            <input type="text" name="idRecado" hidden value="<?php echo $asRecados[6]; ?>">
                            <textarea class="cmtcampo" name="comentario" value="" placeholder=" Fazer Comentario" maxlength="250"></textarea>
                            <button type="submit" name="submit" class="btn-comentar" value="Cadastrar" onClick="placeOrder(this.form)"><img src="./img/env.png"></button>
                        </div>                    
                    </form>
                    </div>
<?php 
foreach ($coment['dados'] as $coment):
                    $nome = $coment[6].' '.$coment[7];
                echo  '<hr width="100%" size="1px" color="#EEEEEE" />
                <div class="exibir_coment"> <div class="align-comentarios"><a href="perfil.php?uid='.$coment[5].'"><img class="foto-user-commen" src="./uploads/user/'.$coment[8].'" width="50px" height="50px" name="'.$nome.'"/> </a><span class="post-comment">' .$coment[3].'</span>
                    </div></div><br>
                    ';
                    endforeach;

'</div>';
				
				}

                                echo '</ul>';
                    }
				




?>