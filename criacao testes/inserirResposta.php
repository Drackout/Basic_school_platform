<?php

$idpergunta = $_POST['perguntar'];
$username = $_POST['userr'];
$pergunta = $_POST['pernome'];

$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
// Check connection
if (!$conn)
  die("Error: ".mysqli_connect_error());
mysqli_set_charset($conn, "utf8");


$squery = mysqli_prepare($conn,"insert into tf_respostas (pergunta, texto, certo, cotacao, autor) values(?,?,?,?,?)");

mysqli_stmt_bind_param($squery,"isiis", $_POST['perguntar'], $_POST['resp1'], $_POST['rcerto'], $_POST['rcotacao'], $_POST['userr']);

if(mysqli_stmt_execute($squery)){
  header('Location: verRespostas.php'."?inser&idpergunta=".$idpergunta."&userr=".$username."&respp=".$pergunta);

}else
  header('Location: verRespostas.php'."?ninser&idpergunta=".$idpergunta."&userr=".$username."&respp=".$pergunta);

  mysqli_stmt_close($squery);

mysqli_close($conn);
?>


