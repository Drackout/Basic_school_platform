<?php

$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
// Check connection
if (!$conn)
  die("Error: ".mysqli_connect_error());
mysqli_set_charset($conn, "utf8");


$squery = mysqli_prepare($conn,"insert into turma (nomeT) values(?)");

mysqli_stmt_bind_param($squery,"s", $_POST['nameTurma']);

if(mysqli_stmt_execute($squery)){
  echo "Turma Criada";
header("Location:AdminCriarTurma.php?inserido");
}else
header("Location:AdminCriarTurma.php?ninserido");
  echo "Erro ao inserir a Turma";

  mysqli_stmt_close($squery);

mysqli_close($conn);
?>



