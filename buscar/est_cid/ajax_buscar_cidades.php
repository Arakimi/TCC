<?php
header("Content-Type: text/html;  charset=ISO-8859-1",true);
include('conexao.php');
$estado = $_GET['estado'];
$sql = "SELECT * FROM cidade WHERE est_id = $estado ORDER BY nome";
$res = mysql_query($sql, $conexao);
$num = mysql_num_rows($res);
for ($i = 0; $i < $num; $i++) {
  $dados = mysql_fetch_array($res);
  $arrCidades[$dados['id']] = utf8_encode($dados['nome']);
}

?>
<link href="../../css/padrao.css" rel="stylesheet" type="text/css" />
<select name="cidade" id="cidade" class="cad">
  <?php foreach($arrCidades as $value => $nome){
    echo "<option value='{$value}'>{$nome}</option>";
  }
?>
</select>