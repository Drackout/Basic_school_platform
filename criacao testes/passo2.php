<?php
  
$upload=false;  
$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
// Check connection
if (!$conn)
  die("Error: ".mysqli_connect_error());
mysqli_set_charset($conn, "utf8");


/*

$squery = mysqli_prepare($conn,"insert into testesformacao (ufcd, tema, descricao, cotacao, disponivel, autor) values(?,?,?,?,?,?)");

mysqli_stmt_bind_param($squery,"sisiis", $_POST['ufcd'], $_POST['tema'], $_POST['tnome'], $_POST['cotacao'], $_POST['disponivel'], $_POST['prof']);

if(mysqli_stmt_execute($squery)){
  echo "Testes inserido";
  $upload=true;

}else
  echo "Erro ao inserir o Teste";


  mysqli_stmt_close($squery);
  if ($upload) {
    header("Location:passo1.php");
  }
  */

$squery = mysqli_prepare($conn,"insert into tf_perguntas (teste, texto, autor) values(?,?,?)");

mysqli_stmt_bind_param($squery,"sss", $_POST['ufcd'], $_POST['tema'], $_POST['tnome'], $_POST['cotacao'], $_POST['disponivel'], $_POST['prof']);

if(mysqli_stmt_execute($squery)){
  echo "Testes inserido";
  $upload=true;

}else
  echo "Erro ao inserir o Teste";


mysqli_close($conn);
?>

