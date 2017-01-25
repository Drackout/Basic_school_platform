<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"/>
<title>Testes</title>
</head>
<body>
<?php
$idpergunta = $_POST['perguntar'];
$username = $_POST['userr'];
$pergunta = $_POST['pernome'];

$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
	die("Error: ".mysqli_connect_error());

$query = mysqli_prepare($conn,"update tf_respostas set texto=?, certo=?, cotacao=? where idresposta = ?");

mysqli_stmt_bind_param($query,"siii", $_POST['resp2'], $_POST['rcerto2'], $_POST['rcotacao2'], $_POST['idresposta2']);

if(mysqli_stmt_execute($query)){
header('Location: verRespostas.php'."?edit&idpergunta=".$idpergunta."&userr=".$username."&respp=".$pergunta);
}
else
header('Location: verRespostas.php'."?nedit&idpergunta=".$idpergunta."&userr=".$username."&respp=".$pergunta);
echo "Vai ser redirecionado...";
mysqli_stmt_close($query);
mysqli_close($conn);

?>

<!--<script>
setTimeout(function(){location.href="ProfTestes.php";},2000);
</script>-->

</body>
</html>