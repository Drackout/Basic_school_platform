<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"/>
<title>Testes</title>
</head>
<body>
<?php
echo $_POST['uid'];
echo $_POST['turmaluno'];

$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
	die("Error: ".mysqli_connect_error());

$query = mysqli_prepare($conn,"update user set turma=? where iduser = ?");

mysqli_stmt_bind_param($query,"ii", $_POST['turmaluno'], $_POST['uid']);

if(mysqli_stmt_execute($query)){
  echo "teste Alterado com sucesso...   ";
  header("Location:AdminTurmaAluno.php?inserido");
}
else
header("Location:AdminTurmaAluno.php?ninserido");
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