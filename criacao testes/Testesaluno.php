<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aluno</title>
 
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/menusProf.css" rel="stylesheet">

    </head>
  <body>
  <!--pagina teste do aluno-->
	<!--Mostra o menu Aluno-->
	<?php include_once('menuAluno.php'); ?>
	
	 
<div class="jumbotron jumbotron1" style="text-align: center;">
  <h1>Testes</h1>      
  
</div>
<?php
$disp = true;
echo '<div class="container well well-sm">';
echo "<table class=\"table table-hover\" align=\"center\">";
echo "<thead><tr><th>UFCD</th><th>Nome</th><th>Fim</th><th>Cotação</th><th></th></tr></thead>";
$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
  die("Error: ".mysqli_connect_error());
$turma = mysqli_query($conn,"select * from user where iduser='$uid'");//id aluno
//id turma
while($row3= mysqli_fetch_array($turma))

{
	?>
	<?php $idturma = $row3["turma"]; ?>
  

  <?php
}
//id ufcd
$ufcd = mysqli_query($conn,"select * from ufcd where turma='$idturma'");
while($row4= mysqli_fetch_array($ufcd))

{
	?>
	<?php $idufcd = $row4["idufcd"]; ?>
  <?php $idteste = mysqli_query($conn,"select testesformacao.idteste, testesformacao.ufcd, testesformacao.disponivel, testesformacao.tempo, testesformacao.descricao, testesformacao.cotacao, ufcd.nomeufcd FROM testesformacao INNER JOIN ufcd ON testesformacao.ufcd=ufcd.idufcd where testesformacao.ufcd='$idufcd' and disponivel='$disp'"); 



  while($row5= mysqli_fetch_array($idteste))

{
	?>
	
	<tr>
  <?php $testeid = $row5["idteste"]; ?>
  <td><?php echo $row5["nomeufcd"]; ?></td>
  <td><?php echo $row5["descricao"]; ?></td>
  <td><?php echo $row5["tempo"]; ?></td>
  <td><?php echo $row5["cotacao"]; ?></td>
  <?php $ufcdblep = $row5["ufcd"];?>

  <td style="text-align: right;">
   <form style="display:inline;"  action="alunoPerguntas.php" method="request" >
  <input type="hidden" name="testeid" value="<?php echo $testeid ?>">
  <input type="hidden" name="tested" value="<?php echo $row5["descricao"]; ?>">
  <input type="hidden" name="ufcdblep" value="<?php echo $ufcdblep ?>">
  <input type="hidden" name="testempo" value="<?php echo $row5["tempo"]; ?>">
  <button type="submit" class="btn btn-info" >Fazer</button>
  </form>
  </td>
  </tr>
  <?php
}
}
echo "</table>";
echo '</div>';

mysqli_close($conn);
?>
    
</div>

        


	
</body>
</html>