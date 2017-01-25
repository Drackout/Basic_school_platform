<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"/>
<title>Testes</title>
</head>
<body>
<p><?php $var1 =  $_POST['idturma'];?></p>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
	die("Error: ".mysqli_connect_error());

$query = mysqli_prepare($conn,"delete from turma where idturma = ?");

mysqli_stmt_bind_param($query,"i", $var1);

if(mysqli_stmt_execute($query)){
  echo "Turma eliminada com sucesso...   ";
  header("Location:AdminCriarTurma.php?exterminated");

}
else
	header("Location:AdminCriarTurma.php?nexterminated");
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