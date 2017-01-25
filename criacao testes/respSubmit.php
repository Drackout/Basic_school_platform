<?php



$tperguntas = $_POST['totalps'];
$testeid = $_POST['testeid'];
$idpergunta = $_POST['idpergunta'];
$idaluno =  $_POST['idaluno'];
$tested = $_POST['tested'];
$ufcd = $_POST['ufcdide'];
  $tempinho = $_POST['testempo'];

echo "Teste id:".$testeid."<br>";
echo "Pergunta id:".$idpergunta."<br>";
echo "Id aluno id:".$idaluno."<br>";


$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
// Check connection
if (!$conn)
  die("Error: ".mysqli_connect_error());
mysqli_set_charset($conn, "utf8");

for($i=1;$i<$tperguntas;$i++){
  $respid = $_POST['respid_'.$i].", ";
  $resposta = $_POST['repostra_'.$i]."<br>";

if ($_POST['opcao'] == 1) {
  
  $squery = mysqli_prepare($conn,"insert into testesregisto (teste, pergunta, idresposta, resposta, formando) values(?,?,?,?,?)");
  mysqli_stmt_bind_param($squery,"iiiii", $testeid, $idpergunta, $respid, $resposta, $idaluno);

  if(mysqli_stmt_execute($squery)){
    header('Location:alunoPerguntas.php'."?inssim&testeid=".$testeid."&tested=".$tested."&ufcdblep=".$ufcd."&testempo=".$tempinho);
  }else
    header('Location:alunoPerguntas.php'."?insnao&testeid=".$testeid."&tested=".$tested."&ufcdblep=".$ufcd."&testempo=".$tempinho);

  mysqli_stmt_close($squery);
} 



if($_POST['opcao'] == 2){
  

  $query2 = mysqli_prepare($conn,"update testesregisto set resposta=? where teste=? and pergunta=? and idresposta=? and formando=?");
  mysqli_stmt_bind_param($query2,"iiiii", $resposta, $testeid, $idpergunta, $respid, $idaluno);

  if(mysqli_stmt_execute($query2)){
    header('Location:alunoPerguntas.php'."?updsim&testeid=".$testeid."&tested=".$tested."&ufcdblep=".$ufcd."&testempo=".$tempinho);
  }
  else
  header('Location:alunoPerguntas.php'."?updnao&testeid=".$testeid."&tested=".$tested."&ufcdblep=".$ufcd."&testempo=".$tempinho);

}
}

//mysqli_stmt_close($squery2);
mysqli_close($conn);
?>


