<?php 
    include('header.php');
?>
<div id="content-albuns">
    <?php 

        include('paginas/menuEsquerda.php');  

    ?>
    <br>
    <br>
    
    <div id="corpo-albuns">
        
        <?php // se ja existir o UID na URL, vai para foto, se não album
            if(isset($_GET['aid'])){
                include('paginas/list_fotos.php');
            }else{
                include('paginas/list_album.php');
            }
        ?>                        
    </div>
    <?php
        include('footer.php');
    ?>
</div>                    
                   