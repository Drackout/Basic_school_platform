<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"/>
<title>Testes</title>
</head>
<body>
<p><?php $var1 =  $_POST['idudel']?></p>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
	  die("Error: ".mysqli_connect_error());

$query = mysqli_prepare($conn,"delete from user where iduser = ?");

mysqli_stmt_bind_param($query,"i", $var1);

if(mysqli_stmt_execute($query)){
  header("Location:AdminUsers.php?apagado");
  echo "Utilizador eliminado com sucesso...   ";
}
else
  header("Location:AdminUsers.php?napagado");
	echo "Erro na eliminação...";
echo "Vai ser redirecionado...";
mysqli_stmt_close($query);
mysqli_close($conn);
?>

<?php

?>

<!--<script>
setTimeout(function(){location.href="ProfTestes.php";},2000);
</script>-->

</body>
</html>