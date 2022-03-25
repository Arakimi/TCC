<?php 
    include('header.php');
?>
<div id="content-albuns-perfil">
<br>
    <?php 

        include('paginas/menuEsquerdaPerfil.php');  
        include('paginas/menuDireitaPerfil.php');

    ?>       
    <div id="corpo-albuns-perfil">
        
        <?php // se ja existir o UID na URL, vai para foto, se não album
            if(isset($_GET['aid'])){
                include('paginas/list_fotos_perfil.php');
            }else{
                include('paginas/list_album_perfil.php');
            }
        ?>                        
    </div>
</div>                    
                   