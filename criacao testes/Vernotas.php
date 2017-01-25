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
    <link href="css/notificacoes.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    </head>
  <body>
  <!--pagina teste do aluno-->
	<!--Mostra o menu Aluno-->
	<?php include_once('menuAluno.php'); ?>
	
	 <?php   
			$uid = $_SESSION["id2"];
  ?>

<div class="jumbotron jumbotron1" style="text-align: center;">
  <h1>Notas</h1>      
</div>

 <div class="container  well well-sm" align="center">

 <?php
$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
  die("Error: ".mysqli_connect_error());
$res=mysqli_query($conn,"select notas.idnota, notas.aluno, testesformacao.descricao, ufcd.nomeufcd,  notas.cotacao from notas INNER JOIN testesformacao ON notas.teste=testesformacao.idteste INNER JOIN ufcd ON notas.ufcd=ufcd.idufcd where aluno='$uid'");

if(!$res)
  die("Error: ".mysqli_error($conn));

echo '<div class="container">';
echo "<table class='table table-hover' align='center'";
echo "<thead><tr><th>UFCD</th><th>Teste</th><th>Nota</th></tr></thead>";

while($row = mysqli_fetch_array($res))

{
  ?>
  <tr>
  <td><?php echo $row["nomeufcd"]; ?></td>
  <td><?php echo $row["descricao"]; ?></td><!--Nome do teste-->
  <td><?php  
  if ($row["cotacao"]<10) {
    ?> <span style="color: red"><b><?php echo $row["cotacao"]?></b></span> <?php
  }else if ($row["cotacao"]>=10) {
    ?> <span style="color: green"><b><?php echo $row["cotacao"]?></b></span> <?php
  }
  ?></td>
  

  </tr>
    <?php
}
echo "</table>";
echo '</div>';
mysqli_free_result($res);
mysqli_close($conn);
?>

 </div>

 <?php 

if (isset($_GET["expirado"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Teste Expirado</strong>
        </div>
        <?php
    }
if (isset($_GET["notachange"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Nota alterada</strong>
        </div>
        <?php
    }
    if (isset($_GET["notanchange"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Nota não alterada</strong>
        </div>
        <?php
    }
    if (isset($_GET["notainser"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Nova nota inserida</strong>
        </div>
        <?php
    }
    if (isset($_GET["notaninser"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Nota não inserida</strong>
        </div>
        <?php
    }
 ?>






    <script>setTimeout(function() {$("#errnot").fadeOut();}, 2000);</script>
	
</body>
</html>
