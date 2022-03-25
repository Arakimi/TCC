<?php
include('conexao.php');
$sql = "SELECT * FROM mes ORDER BY mes_id";
$res = mysql_query($sql, $conexao);
$num = mysql_num_rows($res);
for ($i = 0; $i < $num; $i++) {
  $dados = mysql_fetch_array($res);
  $arrMes[$dados['mes_id']] = $dados['mes'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns='http://www.w3.org/1999/xhtml'>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script>
    function buscar_dias(){
      var mes = $('#mes').val();
      if(mes){
        var url = 'ajax_buscar_dias.php?mes='+mes;
        $.get(url, function(dataReturn) {
          $('#load_dias').html(dataReturn);
        });
      }
    }
    </script>
  </head>
  <form>
	<div id="col">
	<span class="titulo">Estado:</span><br /> 
    	<select name="mes" class="digitar" id="mes" onchange="buscar_dias()">
        <option value="">Selecione...</option>
        <?php foreach ($arrMes as $value => $mes) {
          echo "<option value='{$value}'>{$mes}</option>";
        }?>
      </select>
    </div>
	<div id="load_cidades" class="col"> 
	<span class="titulo">Cidade:</span><br />
        <select name="dia" id="dia" class="digitar">
          <option value="">Selecione o mês</option>
        </select>
    </div>
    </form>
</html>