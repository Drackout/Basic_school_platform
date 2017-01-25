<?php
$ufcd = $_POST['idufcd'];

$idufcd = $_POST['idufcd'];
$nomeTurma = $_POST['nomeTurma'];

//echo $_POST['idufcd'];
//echo $_POST['nameUfcd'];

$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
// Check connection
if (!$conn)
  die("Error: ".mysqli_connect_error());
mysqli_set_charset($conn, "utf8");


$squery = mysqli_prepare($conn,"insert into ufcd (nomeufcd, professor, turma) values(?,?,?)");

mysqli_stmt_bind_param($squery,"sii", $_POST['nameUfcd'],  $_POST['pufcd'], $ufcd);

if(mysqli_stmt_execute($squery)){
  echo "UFCD Criada";
    header("Location:AdminProfUfcd.php?inserido&idturma=".$idufcd.'&nomeT='.$nomeTurma);

}else
header("Location:AdminProfUfcd.php?ninserido&idturma=".$idufcd.'&nomeT='.$nomeTurma);
  echo "Erro ao inserir a UFCD";

  mysqli_stmt_close($squery);

  

mysqli_close($conn);
?>

