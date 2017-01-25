<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"/>
<title>Testes</title>
</head>
<body>
<?php 

$var1 =  $_POST['idpergunta'];
$idteste = $_POST['idteste2'];
$uusername = $_POST['userr'];
$tested = $_POST['testenome'];

$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
	die("Error: ".mysqli_connect_error());

$query = mysqli_prepare($conn,"delete from tf_perguntas where idpergunta = ?");

mysqli_stmt_bind_param($query,"i", $var1);

if(mysqli_stmt_execute($query)){
header('Location: ProfPerguntas.php'."?del&idteste=".$idteste."&uusername=".$uusername."&tested=".$tested);

  //apagar a imagem com a pergunta
  $cam= 'uploadteste/';
  $cam .= $_POST['idpergunta'];
  $cam .= ".png";
  unlink($cam);


}
else
header('Location: ProfPerguntas.php'."?ndel&idteste=".$idteste."&uusername=".$uusername."&tested=".$tested);
echo "Vai ser redirecionado...";
mysqli_stmt_close($query);
mysqli_stmt_close($query1);
mysqli_close($conn);
?>

<!--<script>
setTimeout(function(){location.href="ProfTestes.php";},2000);
</script>-->

</body>
</html>