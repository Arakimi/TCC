<?php 

    include('header.php');
    include('./classes/conexao.php'); 
?>

<?php   

    //Verifica Quantidade de Videos Cadastrados
    $meus_videos = DB::getConn()->prepare('SELECT * FROM `video` WHERE usuario=?');
    $meus_videos->execute(array($idExtrangeiro));
    $quantidadeVideos = $meus_videos->rowcount();
    
    if($idDaSessao==$idExtrangeiro){ 
            
        if (isset($_POST['acao']) && $_POST['acao'] == 'cadastrar') {
            $titulo = strip_tags($_POST['titulo']);
            $url = strip_tags($_POST['url']);
            $usuario = $_GET['uid'];
            $embed = substr($_POST['url'],32,12);
            $foto ="http://i1.ytimg.com/vi/".$embed."/default.jpg";

            
                $cadastra = DB::getConn()->prepare("INSERT INTO video SET titulo=?, url=?, foto=?, embed=?, usuario=? ");
                $cadastra -> execute(array($titulo,$url,$foto,$embed,$usuario));
                if($cadastra){echo '<script>alert("Cadastrado")</script>';}
            
            

        }

    }

  
?>
    <br>
    <div id="corpo-videos-perfil">
        <?php 

            include('paginas/menuEsquerdaPerfil.php');
        
                        
        ?>        
        <div id="align-pagina-videos-perfil">
            <div class="bem-vindo">
                Meus Videos
            </div>
            <br>
            <?php if($idDaSessao==$idExtrangeiro): ?>
            <div id="form-videos-env-perfil">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="text" name="titulo" size="30" placeholder="Digite um Titulo para o video , minimo 3 caracteres" class="campo-envia-videos-perfil" /><br />
                    <input type="text" name="url" size="30" placeholder="URL do video (YOUTUBE)" class="campo-envia-videos-perfil"/><br />
                    <input type="hidden" name="acao" value="cadastrar" />
                    <input type="submit" value="Cadastrar Video" class="btn-cadastrar-video-pagina-perfil" />
                </form>
                <span class="mensagem-videos-pagina-informacao-perfil">* No momento só é aceito videos do 
                    <a href="https://www.youtube.com.br" target="_blank">YOUTUBE</a>
                </span>
            </div>
            <?php endif; ?>
            <?php 

            if($quantidadeVideos >= 1){ 

            ?>
            <div id="box-videos-perfil">
                <div id="videos-perfil">
                    <?php
                    if (!isset($_GET['video'])) {
                        $selUltimo = mysql_query("SELECT * FROM `video` ORDER BY `id` DESC");
                        $qr = mysql_fetch_array($selUltimo);
                            echo '<span class="titulo-video-pagina-perfil">'.$qr['titulo'].'</span><br><iframe title="'.$qr['titulo'].'" width="490" height="340" src="http://www.youtube.com/embed/'.$qr['embed'].'" frameborder="0" allowfullscreen class="video-iframe-perfil"></iframe>';
                    }elseif(isset($_GET['video'])){
                        $get = $_GET['video'];
                        $selVideo = mysql_query("SELECT * FROM `video` WHERE `id` = '$get'");
                        $qr2 = mysql_fetch_array($selVideo);
                            echo '<span class="titulo-video-pagina-perfil">'.$qr2['titulo'].'</span><br><iframe title="'.$qr2['titulo'].'" width="490" height="340" src="http://www.youtube.com/embed/'.$qr2['embed'].'" frameborder="0" allowfullscreen class="video-iframe-perfil"></iframe>';
                    }
                    ?>
                </div>
            </div>
            <?php 

            }else if($quantidadeVideos < 1){
                echo '<div id="nenhum-video-encontrado-mensagem"><br>Desculpe não encontramos nenhum video !</div>';
            }

            ?>
        </div>
        <?php 
            if($quantidadeVideos >= 1){ 

        
        ?>
        <div class="exibe-miniatura-videos-mensagem-perfil">
        <span>Alguns Videos:</span>
        </div>
        <div id="carrosel-perfil">
            <br>
            <?php
                $selThumb= mysql_query("SELECT * FROM `video` ORDER BY `id` DESC");
                while($lnThumb = mysql_fetch_array($selThumb)){
                    if ($lnThumb['usuario'] == $_GET['uid']){
            ?>
                
                <a href="videos.php?video=<?php echo $lnThumb['id'];?>&uid=<?php echo $idExtrangeiro;?>"><img src="<?php echo $lnThumb['foto'];?>" /></a>
            <?php
                    }
                }
            }else{
            ?>
        </div>            
    </div>    
<?php   
    }     
    include('footer.php');
?>                    
          