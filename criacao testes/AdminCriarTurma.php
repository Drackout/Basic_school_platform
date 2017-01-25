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
    return confirm("Apagar esta Turma?");}
    </script>

<div class="jumbotron jumbotron1" style="text-align: center;">
  <h1>Turmas</h1>      
</div>

<div style="text-align: center;">
<form action="ProfPerguntas.php" method="post">
<input type="hidden" name="idteste2" value="<?php echo $var1?>">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myQuest">Criar Turma</button>
</form>
</div>
<br>
<div class="container well well-sm">


<br>

<?php
//$autor = $_POST['uusername'];

$conn = mysqli_connect('localhost', 'root', '', 'pfinal');

if (!$conn)
  die("Error: ".mysqli_connect_error());
$res=mysqli_query($conn,"select * from turma where idturma>0");

if(!$res)
  die("Error: ".mysqli_error($conn));

echo "<div class=\"container\">"; 
echo "<table class=\"table table-hover\" align=\"center\">";
echo "<thead><tr><th>Nº</th><th>Nome</th><th></th></tr></thead>";

while($row = mysqli_fetch_array($res))

{
  ?>
  <tr>
  <td><?php echo $row["idturma"]; ?></td>
  <td><?php echo $row["nomeT"]; ?></td>
	<td style="text-align: right;">

  	<form style="display:inline;" action="AdminProfUfcd.php" method="get">
    <input type="hidden" name="idturma" value="<?php echo $row["idturma"];?>">
    <input type="hidden" name="nomeT" value="<?php echo $row["nomeT"]; ?>">
    <button type="submit" class="btn btn-primary">UFCDs</button>
    </form>

  <form style="display:inline;" action="deleteTurma.php" method="post" onsubmit="return confirmDelete()">
    <input type="hidden" name="idturma" value="<?php echo $row["idturma"];?>">
    <button type="submit" class="btn btn-danger">Apagar</button>
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

<!-- Modal -->
<div id="myQuest" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Nova turma</h4>
      </div>
      <div class="modal-body">

      <form action="inserirTurma.php" method="post" enctype="multipart/form-data">
        <input type="text" name="nameTurma" autofocus="" class='form-control' placeholder='Nome da Turma'>
        <div class="modal-footer">
    <input type="hidden" name="idteste2" value="<?php echo $var1?>">
	<input type="hidden" name="userr" value="<?php echo $autor?>">

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
            <strong>Erro ao criar turma</strong>
        </div>
        <?php
    }
if (isset($_GET["inserido"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Turma criada</strong>
        </div>
        <?php
    }
    if (isset($_GET["exterminated"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Turma apagada</strong>
        </div>
        <?php
    }
    if (isset($_GET["nexterminated"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Turma não apagada</strong>
        </div>
        <?php
    }

 ?>

    <script>setTimeout(function() {$("#errnot").fadeOut();}, 2000);</script>

</body>
</html>