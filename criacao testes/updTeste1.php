<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"/>
<title>Testes</title>
</head>
<body>
<?php
echo  $_POST['teavailable'];
echo  $_POST['idteste3'];

$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
	die("Error: ".mysqli_connect_error());

$query = mysqli_prepare($conn,"update testesformacao set disponivel=? where idteste = ?");

mysqli_stmt_bind_param($query,"ii", $_POST['teavailable'], $_POST['idteste3']);

if(mysqli_stmt_execute($query)){
  echo "Alterado com sucesso...   ";
}
else
echo "Erro ao Alterar...";
echo "Vai ser redirecionado...";
mysqli_stmt_close($query);
mysqli_close($conn);
?>

<?php
header("Location:ProfTestes.php");
?>

<!--<script>
setTimeout(function(){location.href="ProfTestes.php";},2000);
</script>-->

</body>
</html>