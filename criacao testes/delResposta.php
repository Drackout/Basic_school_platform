<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"/>
<title>Testes</title>
</head>
<body>
<?php $var1 =  $_POST['idresposta'];
$idpergunta = $_POST['perguntar'];
$username = $_POST['userr'];
$pergunta = $_POST['pernome'];

$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
	die("Error: ".mysqli_connect_error());

$query = mysqli_prepare($conn,"delete from tf_respostas where idresposta = ?");

mysqli_stmt_bind_param($query,"i", $var1);

if(mysqli_stmt_execute($query)){
  header('Location: verRespostas.php'."?del&idpergunta=".$idpergunta."&userr=".$username."&respp=".$pergunta);
}
else
  header('Location: verRespostas.php'."?ndel&idpergunta=".$idpergunta."&userr=".$username."&respp=".$pergunta);
echo "Vai ser redirecionado...";
mysqli_stmt_close($query);
mysqli_close($conn);


	

	
?>

<!--<script>
setTimeout(function(){location.href="ProfTestes.php";},2000);
</script>-->

</body>
</html>