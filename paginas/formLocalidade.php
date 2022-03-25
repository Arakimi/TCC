<script type="text/javascript">
	function placeOrder(form){
    form.submit();
}	
</script>
<form method="POST" enctype="multipart/form-data" name="update-config-pessoal" action="paginas/updateLocalidade.php">			
	<div id="left-configuracoes-localizacao">
		<ul>
			<li><span class="txtcampo">Pais:</span></li><br>		
			<li><span class="txtcampo">Estado:</span></li><br>        
      		<li><span class="txtcampo">Cidade:</span></li><br>							            	
    	</ul>
	</div>
	<div id="right-configuracoes-localizacao">
		<ul>			
			<li><select name="pais" class="select-campo" action="paginas/updateLocalidade.php">
				<option value="Brasil">Brasil</option>
			</select></li>			
			<li><select name="estado" id="estado" onchange="buscar_cidades()" class="select-campo">
        		<option value="">Estado</option>
        			<?php foreach ($arrEstados as $value => $name) {
          				echo "<option value='{$value}'>{$name}</option>";
       				}?>
     		</select></li>
		  	<li><div id="load_cidades">
	               	<select name="cidade" id="cidade" class="select-campo">
	          			<option value="">Selecione o estado</option>
	       			</select>
	       			<span class="inf-atualiza">Selecione primeiro o estado !</span>
	       			<br>	
            </div></li><br>											
			<li>
			<input type="text" name="idUser" hidden value="<?php echo $idDaSessao; ?>">
				<br><input type="submit" class="btn-atualiza-local" value="Atualizar Localidade" onClick="placeOrder(this.form)">
			</li>
		</ul>					
	</div>
</form> 