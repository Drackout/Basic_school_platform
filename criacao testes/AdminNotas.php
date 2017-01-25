<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notas</title>
 
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/menusProf.css" rel="stylesheet">

    </head>
  <body>
	<?php include_once('menuAdmin.php'); ?>
  <div class="jumbotron jumbotron1" style="text-align: center;">
  <h1>Notas</h1>      
</div>
    <div class="container pMenu">

    

<?php
$autor = $_SESSION['login'];
$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
  die("Error: ".mysqli_connect_error());
$res=mysqli_query($conn,"select notas.idnota, notas.cotacao, user.nome, testesformacao.descricao, ufcd.nomeufcd FROM notas INNER JOIN user ON notas.aluno=user.iduser INNER JOIN testesformacao ON notas.teste=testesformacao.idteste INNER JOIN ufcd ON notas.ufcd=ufcd.idufcd where notas.cotacao>='10' order by idufcd asc, teste asc");

$res2=mysqli_query($conn,"select notas.idnota, notas.cotacao, user.nome, testesformacao.descricao, ufcd.nomeufcd FROM notas INNER JOIN user ON notas.aluno=user.iduser INNER JOIN testesformacao ON notas.teste=testesformacao.idteste INNER JOIN ufcd ON notas.ufcd=ufcd.idufcd where notas.cotacao<'10' order by idufcd asc, teste asc");

//"select notas.idnota, notas.cotacao, user.nome, testesformacao.descricao, ufcd.nomeufcd FROM notas INNER JOIN user ON notas.aluno=user.iduser INNER JOIN testesformacao ON notas.teste=testesformacao.idteste INNER JOIN ufcd ON notas.ufcd=ufcd.idufcd order by idufcd asc, teste asc"


if(!$res)
  die("Error: ".mysqli_error($conn));

echo '<div class="container well well-sm col-md-5">';
echo '<p style="text-align:center;"><b>Avaliações <span style="color:green;">Positivas</span></b></p><hr>';
echo "<table class=\"table table-hover\" align=\"center\">";
echo "<thead><tr><th>Aluno</th><th>Teste</th><th>UFCD</th><th>Cotacao</th></tr></thead>";

while($row = mysqli_fetch_array($res))

{
  ?>
  <tr>
  <td><?php echo $row["nome"]; ?></td>
  <td><?php echo $row["descricao"]; ?></td>
  <td><?php echo $row["nomeufcd"]; ?></td>
  <td><?php  
  if ($row["cotacao"]>=10) {
    ?> <span style="color: green"><b><?php echo $row["cotacao"]?></b></span> <?php
  }
  ?></td>

  <?php
}
?>
  </tr>
<?php
echo "</table>";
echo '</div>';
mysqli_free_result($res);



echo '<div class="col-md-2">';
echo '</div>';

if(!$res2)
  die("Error: ".mysqli_error($conn));

echo '<div class="container well well-sm col-md-5">';
echo '<p style="text-align:center;"><b>Avaliações <span style="color:red;">Negativas</span></b></p><hr>';
echo "<table class=\"table table-hover\" align=\"center\">";
echo "<thead><tr><th>Aluno</th><th>Teste</th><th>UFCD</th><th>Cotacao</th></tr></thead>";

while($row2 = mysqli_fetch_array($res2))

{
  ?>
  <tr>
  <td><?php echo $row2["nome"]; ?></td>
  <td><?php echo $row2["descricao"]; ?></td>
  <td><?php echo $row2["nomeufcd"]; ?></td>
  <td><?php  
  if ($row2["cotacao"]<10) {
    ?> <span style="color: red"><b><?php echo $row2["cotacao"]?></b></span> <?php
  }
  ?></td>

  <?php
}
?>
  </tr>
<?php
echo "</table>";
echo '</div>';
mysqli_free_result($res2);
?>

<?php mysqli_close($conn); ?>

    </div>
</body>
</html>