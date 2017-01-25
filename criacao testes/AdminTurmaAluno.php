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
    confirm("Apagar este utilizador?");}
    </script>

<div class="jumbotron jumbotron1" style="text-align: center;">
  <h1>Turma - Aluno</h1>      
</div>

<div class="container well well-sm">
<?php

$conn = mysqli_connect('localhost', 'root', '', 'pfinal');

if (!$conn)
  die("Error: ".mysqli_connect_error());
$res=mysqli_query($conn,"select user.iduser, user.nome, user.email, turma.nomeT FROM user INNER JOIN turma ON user.turma=turma.idturma where user.tipo='a'");


if(!$res)
  die("Error: ".mysqli_error($conn));



echo "<div class=\"container\">"; 
echo "<table class=\"table table-hover\" align=\"center\">";
echo "<thead><tr><th>Nome</th><th>Email</th><th>Turma</th><th></th><th></th></thead>";

while($row = mysqli_fetch_array($res))

{
  ?>
  <form style="display:inline;" action="addaturma.php" method="post">
  <?php $idusrr = $row["iduser"]?>
  <tr>
  <td><?php echo "<b>".$row["nome"]."</b>" ?></td>
  <td><?php echo $row["email"]; ?></td>
  <td><?php echo $row["nomeT"]; ?></td>



  <td>
  <div class="form-group">
  <?php
    $res2=mysqli_query($conn,"select * from turma");
    if(!$res2)
    die("Error: ".mysqli_error($conn));
  $select= '<select class="form-control" id="turmaluno" name="turmaluno">';

  while($row2 = mysqli_fetch_array($res2)){
    $select.='<option value="'.$row2['idturma'].'">'.$row2['nomeT'].'</option>';
  }
  $select.='</select>';
  echo $select;
  ?>
  </div>
  </td>

  


	<td style="text-align: right;">

	
    <button type="submit" class="btn btn-primary">Adicionar</button>
    <input type="hidden" name="uid" value="<?php echo $row["iduser"]; ?>">
    <input type="hidden" name="taluno" value="<?php echo $_POST['turmaluno']; ?>">
  </form>


  </td>
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
if (isset($_GET["ninserido"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-warning alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Erro ao adicionar turma</strong>
        </div>
        <?php
    }

if (isset($_GET["inserido"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Turma adicionada</strong>
        </div>
        <?php
    }

 ?>

    <script>setTimeout(function() {$("#errnot").fadeOut();}, 2000);</script>

</body>
</html>