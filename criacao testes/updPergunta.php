<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"/>
<title>Testes</title>
</head>
<body>
<?php
echo $_POST['idperg4'];
$idteste = $_POST['idteste2'];
$uusername = $_POST['userr'];
$tested = $_POST['testenome'];

$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
	die("Error: ".mysqli_connect_error());

$query = mysqli_prepare($conn,"update tf_perguntas set texto=? where idpergunta = ?");

mysqli_stmt_bind_param($query,"si", $_POST['per2'], $_POST['idperg4']);

if(mysqli_stmt_execute($query)){
  header('Location: ProfPerguntas.php'."?upd&idteste=".$_POST['idtes4']."&uusername=".$uusername."&tested=".$tested);

}
else
header('Location: ProfPerguntas.php'."?nupd&idteste=".$_POST['idtes4']."&uusername=".$uusername."&tested=".$tested);

echo "Vai ser redirecionado...";
mysqli_stmt_close($query);
mysqli_close($conn);
?>

<!--<script>
setTimeout(function(){location.href="ProfTestes.php";},2000);
</script>-->

</body>
</html>