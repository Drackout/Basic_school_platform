<?php

$testeid = $_POST['testeid'];
$ufcdide = $_POST['ufcdide'];
$alunoid = $_POST['alunoid'];

$cotacao = 0;
$cotaMenos=0;
$tf_resp = 0;
$resp = 0;
$xrespostas=0;


echo "teste id:". $testeid;
echo "ufcd id:". $ufcdide;
echo "aluno id:". $alunoid;


$conn = mysqli_connect('localhost', 'root', '', 'pfinal');

if (!$conn)
  die("Error: ".mysqli_connect_error());
$res=mysqli_query($conn,"select * from tf_perguntas where teste='$testeid'");

if(!$res)
  die("Error: ".mysqli_error($conn));   //perguntas


echo "<div class=\"container\">"; 


while($row = mysqli_fetch_array($res))

{
   $idpergunta =  $row["idpergunta"]; 

  $idresp = mysqli_query($conn,"select idresposta, certo, cotacao from tf_respostas where pergunta='$idpergunta'"); 
  if(!$idresp)
  die("Error: ".mysqli_error($conn));

  while($row1= mysqli_fetch_array($idresp))   //tf_respostas

  {
    echo "-----------------------------<br>";
    echo "TF_RESPOSTAS:<br>";
    echo "cotacao: ".$row1['cotacao']."<br>";
    echo "certo: ".$row1['certo']."<br>";
    $respid = $row1['idresposta'];
    echo "resposta id: ".$respid."<br>";
    

  $tresp = mysqli_query($conn,"select teste, pergunta, idresposta, resposta, formando from testesregisto where idresposta='$respid' and teste='$testeid' and formando='$alunoid'"); 
  if(!$tresp)

  die("Error: ".mysqli_error($conn));

  echo "<br>TESTE REGISTO:<br>";
  while($row2= mysqli_fetch_array($tresp))    //respostas

  {
    echo "teste: ".$row2['teste']."<br>";
    echo "pergunta: ".$row2['pergunta']."<br>";
    echo "idresposta: ".$row2['idresposta']."<br>";
    echo "resposta: ".$row2['resposta']."<br>";
    echo "formando: ".$row2['formando']."<br><br>";

    if($row2['resposta'] == 1){
      $resp++;
    }
    if($row1['certo'] == 1){
      $tf_resp++;
    }

    if($respid == $row2['idresposta']){
       if($row1['certo'] == $row2['resposta']){
          if($row1['cotacao'] != 0){          
            $cotacao += $row1['cotacao'];
            $cotaMenos = $row1['cotacao'];
        }
       }
    }
    $xrespostas++;
  echo "1 inseridos: ".$resp."<br>";
  echo "1 inserido tf: ".$tf_resp."<br>";

  }//testeregisto
  
  }//tf_resposta
  echo "total resps BD: ".$xrespostas."<br>";
echo "1 reset: ".$resp."<br>";
if($xrespostas==$resp){
  $cotacao-=$cotaMenos;
}
  $resp=0;
  $xrespostas=0;
  echo "1 reset2: ".$resp."<br>";
}//tf_perguntas

echo "1 inseridos: ".$resp."<br>";
echo "1 inserido tf: ".$tf_resp."<br>";
echo "NOTA: ".$cotacao;
echo "</div>";


echo "select ja insere";
$repeteste = mysqli_query($conn,"select * from notas where aluno='$alunoid' and teste='$testeid'"); 
  if(!$repeteste)
  die("Error: ".mysqli_error($conn));

  if(mysqli_num_rows($repeteste)===0){
    $squery = mysqli_prepare($conn,"insert into notas (aluno, teste, ufcd, cotacao) values(?,?,?,?)");
    mysqli_stmt_bind_param($squery,"iiii", $alunoid, $testeid, $ufcdide, $cotacao);

  if(mysqli_stmt_execute($squery)){
  header('Location: Vernotas.php?notainser');

  }else
  header('Location: Vernotas.php?notaninser');
  }

  
  while($row5= mysqli_fetch_array($repeteste))    //respostas
{
  echo $row5['aluno'];
  echo $row5['teste'];

  if ($alunoid == $row5['aluno'] && $testeid == $row5['teste']) {
    echo "one time mistake";
    
    //NO CASO DE O ALUNO PODER REFASER
      $query = mysqli_prepare($conn,"update notas set cotacao=? where aluno=? and teste=?");
      mysqli_stmt_bind_param($query,"iii", $cotacao, $alunoid, $testeid);

      if(mysqli_stmt_execute($query)){
        header('Location: Vernotas.php?notachange');
      }
      else
      header('Location: Vernotas.php?notanchange');


  }else {
    echo "teste fora c:";
    $squery = mysqli_prepare($conn,"insert into notas (aluno, teste, ufcd, cotacao) values(?,?,?,?)");
mysqli_stmt_bind_param($squery,"iiii", $alunoid, $testeid, $ufcdide, $cotacao);

if(mysqli_stmt_execute($squery)){
  header('Location: Vernotas.php?notainser');

}else
  header('Location: Vernotas.php?notaninser');

  }

  }
    

mysqli_free_result($repeteste);
mysqli_free_result($tresp);
mysqli_free_result($idresp);
mysqli_free_result($res);
mysqli_close($conn);
?>
        


	
</body>
</html>

