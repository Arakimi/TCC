<?php 
        if(isset($_GET['index']) AND $_GET['index']=='UPLOAD'){ ?>
        <div id="upload-ft">                        	  
            <form name="upload-foto-perfil" enctype="multipart/form-data" method="post" action="paginas/teste.php">
                <input type="file" name="foto-perfil" />
                <input type="submit" class="btnRecortar" value="Recortar" onClick="placeOrder(this.form)"/>
                <input type="hidden" name="imgantiga" value="<?php echo $user_img ?>" />
                <input type="hidden" name="upload" value="index" />
                <input type="hidden" name="uid"  value="<?php echo $idDaSessao ?>" />
            </form>            
        </div>
        <?php
            }elseif (isset($_GET['index']) AND $_GET['index']=='CROP') {
                include('paginas/foto_perfil.php');   
            }
        ?>