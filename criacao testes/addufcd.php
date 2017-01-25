<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"/>
<title>Testes</title>
</head>
<body>
<?php
echo $_POST['idturm'];
echo $_POST['pufcd'];
$idufcd = $_POST['idufcd'];
$nomeTurma = $_POST['nomeTurma'];

$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
	die("Error: ".mysqli_connect_error());

$query = mysqli_prepare($conn,"update ufcd set professor=? where idufcd = ?");

mysqli_stmt_bind_param($query,"ii", $_POST['pufcd'], $_POST['idturm']);

if(mysqli_stmt_execute($query)){
  echo "teste Alterado com sucesso...   ";
  header("Location:AdminProfUfcd.php?inser&idturma=".$idufcd.'&nomeT='.$nomeTurma);
}
else
  header("Location:AdminProfUfcd.php?ninser&idturma=".$idufcd.'&nomeT='.$nomeTurma);
echo "Erro ao Alterar...";
echo "Vai ser redirecionado...";
mysqli_stmt_close($query);
mysqli_close($conn);
?>



<!--<script>
setTimeout(function(){location.href="ProfTestes.php";},2000);
</script>-->

</body>
</html>