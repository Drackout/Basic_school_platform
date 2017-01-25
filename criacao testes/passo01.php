<?php
  
$upload=false;  
$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
// Check connection
if (!$conn)
  die("Error: ".mysqli_connect_error());
mysqli_set_charset($conn, "utf8");



$squery = mysqli_prepare($conn,"insert into testesformacao (ufcd,  descricao, cotacao, tempo, disponivel, autor) values(?,?,?,?,?,?)");

mysqli_stmt_bind_param($squery,"isisis", $_POST['ufcd'], $_POST['tnome'], $_POST['cotacao'], $_POST['tempo'], $_POST['disponivel'], $_POST['prof']);

if(mysqli_stmt_execute($squery)){
  echo "Testes inserido";
  $upload=true;

}else
  echo "Erro ao inserir o Teste";

  mysqli_stmt_close($squery);
  if ($upload) {
    header("Location:ProfTestes.php?criado");
  }

mysqli_close($conn);
?>
















