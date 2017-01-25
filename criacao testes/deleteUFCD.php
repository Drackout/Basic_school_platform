<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"/>
<title>Testes</title>
</head>
<body>
<p><?php $var1 =  $_POST['idufcd'];?></p>

<?php
$idufcd = $_POST['idufcd1'];
$nomeTurma = $_POST['nomeTurma'];

$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
	die("Error: ".mysqli_connect_error());

$query = mysqli_prepare($conn,"delete from ufcd where idufcd = ?");

mysqli_stmt_bind_param($query,"i", $var1);

if(mysqli_stmt_execute($query)){
  echo "UFCD eliminada com sucesso...   ";
  header("Location:AdminProfUfcd.php?apagada&idturma=".$idufcd.'&nomeT='.$nomeTurma);

}
else
	header("Location:AdminProfUfcd.php?napagada&idturma=".$idufcd.'&nomeT='.$nomeTurma);
	echo "Erro na eliminação da UFCD...";
echo "Vai ser redirecionado...";
mysqli_stmt_close($query);
mysqli_close($conn);
?>



<!--<script>
setTimeout(function(){location.href="ProfTestes.php";},2000);
</script>-->

</body>
</html>