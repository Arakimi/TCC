<script type="text/javascript">
	function placeOrder(form){
    form.submit();
}	
</script>

<form method="POST" enctype="multipart/form-data" name="update-config-pessoal" action="paginas/updatePessoais.php">			
	<div id="left-configuracoes-pessoais">
		<ul>		
			<li><span class="txtcampo">Nome:</span></li><br>
			<li><span class="txtcampo">Sobrenome:</span></li><br>
			<li><span class="txtcampo">Sexo:</span></li><br>
			<li><span class="txtcampo">Cabelo:</span></li><br>
			<li><span class="txtcampo">Olhos:</span></li><br>
    		<li><span class="txtcampo">Relacionamento:</span></li><br>	        		
			<li><span class="txtcampo">Celular:</span></li><br>
    	</ul>
	</div>
	<div id="right-configuracoes-pessoais">
		<ul>
			<li><input type="text" name="nome" class="dig-campo" value="<?php echo $user_nome; ?>"></li><span class="inf-atualiza">* Esse nome sera ultilizado para te encontrar!</span><br>
			<li><input type="text" name="sobrenome" class="dig-campo" value="<?php echo $user_sobrenome; ?>"></li><br>
			<li><select name="sexo" class="select-campo">
				<option value="Feminino"  <?php if($confResu[3] == 'Feminino'){ echo 'selected="selected"'; } ;?>>Feminino</option>
				<option value="Masculino" <?php if($confResu[3] == 'Masculino'){ echo 'selected="selected"'; } ;?> >Masculino</option>				
				<option value="Outros"  <?php if($confResu[3] == 'Outros'){ echo 'selected="selected"'; } ;?> >Outros</option>
			</select></li><br>
			<li><select name="cabelo" class="select-campo">
				<option value="0" <?php if($confResu[4] == '0'){ echo 'selected="selected"'; } ;?> >Não Informar</option>
				<option value="1" <?php if($confResu[4] == '1'){ echo 'selected="selected"'; } ;?> >Preto</option>
				<option value="2" <?php if($confResu[4] == '2'){ echo 'selected="selected"'; } ;?> >Castanho</option>
				<option value="3" <?php if($confResu[4] == '3'){ echo 'selected="selected"'; } ;?> >Loiro</option>
				<option value="4" <?php if($confResu[4] == '4'){ echo 'selected="selected"'; } ;?> >Ruivo</option>
				<option value="5" <?php if($confResu[4] == '5'){ echo 'selected="selected"'; } ;?> >Outros</option>
			</select></li><span class="inf-atualiza">* Informe sua cor de OLHO para ultilizar a busca avançada!</span><br>
			<li><select name="olhos" class="select-campo" value="<?php echo $user_olhos; ?>">
				<option value="0" <?php if($confResu[5] == '0'){ echo 'selected="selected"'; } ;?> >Não Informar</option>
				<option value="1" <?php if($confResu[5] == '1'){ echo 'selected="selected"'; } ;?> >Preto</option>
				<option value="2" <?php if($confResu[5] == '2'){ echo 'selected="selected"'; } ;?> >Castanho</option>
				<option value="3" <?php if($confResu[5] == '3'){ echo 'selected="selected"'; } ;?> >Azul</option>
				<option value="4" <?php if($confResu[5] == '4'){ echo 'selected="selected"'; } ;?> >Verde</option>
				<option value="5" <?php if($confResu[5] == '5'){ echo 'selected="selected"'; } ;?> >Outros</option>
        	</select></li><span class="inf-atualiza">* Informe sua cor de CABELO para ultilizar a busca avançada!</span><br>
			<li><select name="relacionamento" class="select-campo">
				<option value="0" <?php if($confResu[6] == '0'){ echo 'selected="selected"'; } ;?> >Não Informar</option>
				<option value="1" <?php if($confResu[6] == '1'){ echo 'selected="selected"'; } ;?> >Solteiro</option>
				<option value="2" <?php if($confResu[6] == '2'){ echo 'selected="selected"'; } ;?> >Relacionamento Serio</option>
				<option value="3" <?php if($confResu[6] == '3'){ echo 'selected="selected"'; } ;?> >Casado</option>
        	</select></li><br>				
			<li>
				<input type="text" name="ddd1" class="ddd-campo" placeholder="DDD" maxlength="2" value="<?php echo $user_ddd; ?>">
				<input type="text" name="telefone" class="fone-campo" placeholder="Telefone" maxlength="9" value="<?php echo $user_celular; ?>">
				<input type="text" name="idUser" hidden value="<?php echo $idDaSessao;  ?>">
			</li><br>
			<li>
				<input type="submit" class="btn-atualiza" value="Atualizar Dados Pessoais" onClick="placeOrder(this.form)">
			</li><br>
		</ul>					
	</div>
</form>