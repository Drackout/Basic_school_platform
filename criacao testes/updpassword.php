<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8"/>
<title>Testes</title>
</head>
<body>
<?php

echo $_POST['iduse'];
echo $_POST['newpw'];

$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
	die("Error: ".mysqli_connect_error());

$query = mysqli_prepare($conn,"update user set password=? where iduser=?");

mysqli_stmt_bind_param($query,"si", $_POST['newpw'], $_POST['iduse']);

if(mysqli_stmt_execute($query)){
  header("Location:ProfPerfil.php?pws");
}
else
header("Location:ProfPerfil.php?pwn");
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