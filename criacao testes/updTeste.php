<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"/>
<title>Testes</title>
</head>
<body>
<?php

echo $_POST['idtestea'];

$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
	die("Error: ".mysqli_connect_error());

$query = mysqli_prepare($conn,"update testesformacao set ufcd=?, descricao=?, cotacao=? where idteste = ?");

mysqli_stmt_bind_param($query,"isii", $_POST['ufcd'], $_POST['tes2'], $_POST['tcotacao'], $_POST['idtestea']);

if(mysqli_stmt_execute($query)){
  header("Location:ProfTestes.php?upd");
}
else
header("Location:ProfTestes.php?nupd");
echo "Vai ser redirecionado...";
mysqli_stmt_close($query);
mysqli_close($conn);
?>

<!--<script>
setTimeout(function(){location.href="ProfTestes.php";},2000);
</script>-->

</body>
</html>