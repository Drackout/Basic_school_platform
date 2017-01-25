<?php
$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
	die("Error: ".mysqli_connect_error());
mysqli_set_charset($conn, "utf8");

$squery = mysqli_prepare($conn,"insert into user (nome, password, tipo, email) values(?,?,?,?)");
mysqli_stmt_bind_param($squery,"ssss", $_POST['nameu'], $_POST['passu'],$_POST['tipouser'], $_POST['emailu']);

if(mysqli_stmt_execute($squery)){
	echo "Pergunta utilizador<br>";
	header("Location:AdminUsers.php?inser");
}
else
    header("Location:AdminUsers.php?ninser");
	echo "Erro ao inserir o utilizador<br>";
mysqli_stmt_close($squery);







