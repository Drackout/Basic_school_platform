<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"/>
<title>Testes</title>
</head>
<body>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
	die("Error: ".mysqli_connect_error());

$query = mysqli_prepare($conn,"update user set nome=?, password=?, email=? where iduser = ?");

mysqli_stmt_bind_param($query,"sssi", $_POST['nameu2'], $_POST['passu2'], $_POST['emailu2'], $_POST['iduser2'] );

if(mysqli_stmt_execute($query)){
	header("Location:AdminUsers.php?upd");
  echo "Utilizador Alterada com sucesso...   ";
}
else
	header("Location:AdminUsers.php?nupd");
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