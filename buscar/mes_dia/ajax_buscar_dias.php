<?php
include('conexao.php');
$mes = $_GET['mes'];
$sql = "SELECT * FROM dia WHERE mes_id = $mes ORDER BY dia";
$res = mysql_query($sql, $conexao);
$num = mysql_num_rows($res);
for ($i = 0; $i < $num; $i++) {
  $dados = mysql_fetch_array($res);
  $arrDia[$dados['id']] = utf8_encode($dados['dia']);
}
?>
<link href="../../styllo/inicial.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<select name="cidade" id="cidade" class="txt bradius">
  <?php foreach($arrDia as $value => $dia){
    echo "<option value='{$value}'>{$dia}</option>";
  }
?>
</select>