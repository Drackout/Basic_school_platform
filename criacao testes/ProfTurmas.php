<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projeto Final</title>
 
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/menusProf.css" rel="stylesheet">

    </head>
  <body>
	<?php include_once('menuProfessor.php'); ?>
  <div class="jumbotron jumbotron1" style="text-align: center;">
  <h1>UFCDs / Turmas</h1>      
</div>
    <div class="container pMenu">

    

<?php
$autor = $_SESSION['login'];
$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
  die("Error: ".mysqli_connect_error());
$res=mysqli_query($conn,"select ufcd.idufcd, ufcd.nomeufcd, turma.nomeT FROM ufcd INNER JOIN turma ON ufcd.turma=turma.idturma where ufcd.professor='$uid' order by turma asc");

if(!$res)
  die("Error: ".mysqli_error($conn));

echo '<div class="container well well-sm">';
echo "<table class=\"table table-hover\" align=\"center\">";
echo "<thead><tr><th>Nº</th><th>UFCD</th><th>Turma</th></tr></thead>";

while($row = mysqli_fetch_array($res))

{
  ?>
  <tr>
  <td><?php echo $row["idufcd"]; ?></td>
  <td><?php echo $row["nomeufcd"]; ?></td>
  <td><?php echo $row["nomeT"]; ?></td>

  </tr>
    <?php
}
echo "</table>";
echo '</div>';
mysqli_free_result($res);
mysqli_close($conn);
?>








    </div>
</body>
</html>