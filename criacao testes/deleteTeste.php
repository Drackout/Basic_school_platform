<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"/>
<title>Testes</title>
</head>
<body>
<p><?php $var1 =  $_POST['idteste'];?></p>

<?php
$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
	die("Error: ".mysqli_connect_error());

$query = mysqli_prepare($conn,"delete from testesformacao where idteste = ?");

mysqli_stmt_bind_param($query,"i", $var1);

if(mysqli_stmt_execute($query)){
header("Location:ProfTestes.php?del");
}
else
header("Location:ProfTestes.php?ndel");
echo "Vai ser redirecionado...";
mysqli_stmt_close($query);
mysqli_close($conn);
?>

<!--<script>
setTimeout(function(){location.href="ProfTestes.php";},2000);
</script>-->

</body>
</html>