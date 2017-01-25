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
    <link href="css/notificacoes.css" rel="stylesheet">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
  <body>
	<?php include_once('menuAdmin.php'); ?>

  <?php  ?>
    <script>
      function confirmDelete() {
    return confirm("Apagar este utilizador?");}
    </script>

<div class="jumbotron jumbotron1" style="text-align: center;">
  <h1><?php echo $_GET['nomeT'] ?></h1>      
</div>

<div style="text-align: center;">
<form action="ProfPerguntas.php" method="post">
<input type="hidden" name="idteste2" value="<?php echo $var1?>">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myQuest">Criar UFCD</button>
</form>
</div>
<br>

<div class="container well well-sm">



<?php
$idturma1 = $_GET['idturma'];
$conn = mysqli_connect('localhost', 'root', '', 'pfinal');

if (!$conn)
  die("Error: ".mysqli_connect_error());
$res=mysqli_query($conn,"select ufcd.idufcd, ufcd.nomeufcd, user.nome FROM ufcd INNER JOIN user ON ufcd.professor=user.iduser where ufcd.turma='$idturma1'");


if(!$res)
  die("Error: ".mysqli_error($conn));



echo "<div class=\"container\">"; 
echo "<table class=\"table table-hover\" align=\"center\">";
echo "<thead><tr><th>Nº</th><th>Nome</th><th>Professor</th><th></th><th style=\"text-align: right;\">Turma: ".$idturma1."</th></thead>";

while($row = mysqli_fetch_array($res))

{
  ?>
  <form style="display:inline;" action="addufcd.php" method="post">
  <tr>
  <td><?php echo "<b>".$row["idufcd"]."</b>" ?></td>
  <td><?php echo $row["nomeufcd"]; ?></td>
  <td><?php echo $row["nome"]; ?></td>



  <td>
  <div class="form-group">
  <?php
    $res2=mysqli_query($conn,"select * from user where tipo='p'");
    if(!$res2)
    die("Error: ".mysqli_error($conn));
  $select= '<select class="form-control" id="pufcd" name="pufcd">';

  while($row2 = mysqli_fetch_array($res2)){
    $select.='<option value="'.$row2['iduser'].'">'.$row2['nome'].'</option>';
  }
  $select.='</select>';
  echo $select;
  ?>
  </div>
  </td>

  


	<td style="text-align: right;">

	
    <button type="submit" class="btn btn-primary">Alterar</button>
    <input type="hidden" name="idturm" value="<?php echo $row["idufcd"] ?>">
    <input type="hidden" name="taluno" value="<?php echo $_POST['pufcd']; ?>">

    <input type="hidden" name="idufcd" value="<?php echo $idturma1 ?>">
  <input type="hidden" name="nomeTurma" value="<?php echo $_GET['nomeT']; ?>">
  </form>
  <form style="display:inline;" action="deleteUFCD.php" method="post" onsubmit="return confirmDelete()">
    <input type="hidden" name="idufcd" value="<?php echo $row["idufcd"];?>">

    <input type="hidden" name="idufcd1" value="<?php echo $idturma1 ?>">
  <input type="hidden" name="nomeTurma" value="<?php echo $_GET['nomeT']; ?>">
    <button type="submit" class="btn btn-danger">Apagar</button>
    </form>


  </td>
    </tr>
    <?php
}
echo "</table>";
echo '</div>';

?>



<!-- Modal -->
<div id="myQuest" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Criar UFCD</h4>
      </div>
      <div class="modal-body">

      <form action="inserirUFCD.php" method="post" enctype="multipart/form-data">
        <input type="text" name="nameUfcd" autofocus="" required="" class='form-control' placeholder='Nome da UFCD'>

    <div class="form-group">
    <br>
    <span>Professor</span>
  <?php
    $res2=mysqli_query($conn,"select * from user where tipo='p'");
    if(!$res2)
    die("Error: ".mysqli_error($conn));
  $select= '<select class="form-control" id="pufcd" name="pufcd">';

  while($row2 = mysqli_fetch_array($res2)){
    $select.='<option value="'.$row2['iduser'].'">'.$row2['nome'].'</option>';
  }
  $select.='</select>';
  echo $select;
  mysqli_free_result($res);
mysqli_close($conn);
  ?>

  </div>


        <div class="modal-footer">
  <input type="hidden" name="idufcd" value="<?php echo $idturma1 ?>">
  <input type="hidden" name="nomeTurma" value="<?php echo $_GET['nomeT']; ?>">
  <input type="hidden" name="userr" value="<?php echo $autor ?>">
  

  <div style="text-align: left;" class="form-group">

  </div>

      <button type="submit" name="submit" class="btn btn-primary"/>Criar</button>
      </div>
      </form>
      </div>
      
    </div>

  </div>
</div>
</div>


</div>


<?php
if (isset($_GET["ninserido"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Erro ao criar UFCD</strong>
        </div>
        <?php
    }

if (isset($_GET["inserido"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>UFCD criada</strong>
        </div>
        <?php
    }
if (isset($_GET["inser"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>UFCD Associada</strong>
        </div>
        <?php
    }
if (isset($_GET["ninser"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Erro ao atribuir UFCD</strong>
        </div>
        <?php
    }
    if (isset($_GET["apagada"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>UFCD Apagada</strong>
        </div>
        <?php
    }
    if (isset($_GET["napagada"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>UFCD não apagada</strong>
        </div>
        <?php
    }
 ?>

    <script>setTimeout(function() {$("#errnot").fadeOut();}, 2000);</script>


</body>
</html>