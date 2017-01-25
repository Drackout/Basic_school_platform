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
	<?php include_once('menuProfessor.php'); ?>

<?php $var1 =  $_GET['idteste'];?>

  <?php  ?>
    <script>
      function confirmDelete() {
    return confirm("Apagar esta Pergunta?");}
    </script>

<div class="jumbotron jumbotron1" style="text-align: center;">
  <h1><?php echo $_GET['tested']?></h1>      
</div>

<div class="container">

<div style="text-align: center;">
<form action="ProfPerguntas.php" method="get">
<input type="hidden" name="idteste2" value="<?php echo $var1?>">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myQuest">Criar Pergunta</button>
</form>
</div>
<br>

<?php
$autor = $_GET['uusername'];


$conn = mysqli_connect('localhost', 'root', '', 'pfinal');

if (!$conn)
  die("Error: ".mysqli_connect_error());
$res=mysqli_query($conn,"select * from tf_perguntas where autor='$autor' and teste='$var1'");

if(!$res)
  die("Error: ".mysqli_error($conn));

echo "<div class=\"container well well-sm\">"; 
echo "<table class=\"table table-hover\" align=\"center\">";
echo "<thead><tr><th>Perguntas</th><th></th><th style=\"text-align: right;color:lightgray;\">".$var1."</th></thead>";

while($row = mysqli_fetch_array($res))

{
  ?>
  <tr>
  <td><?php echo $row["texto"]; ?></td>
<td></td>
	<td style="text-align: right;">

	<form style="display:inline;" method="post">
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#updt3Quest" data-id="<?php echo $row['idpergunta'];?>" id="<?php echo $row['idpergunta'];?>">Edit</button>
    <input type="hidden" name="ptexto" value="<?php echo $row["descricao"];?>">
  </form>


	<form style="display:inline;" action="verRespostas.php" method="get">
  	<input type="hidden" name="idpergunta" value="<?php echo $row["idpergunta"];?>">
  	<input type="hidden" name="userr" value="<?php echo $autor?>">
  	<input type="hidden" name="respp" value="<?php echo $row["texto"]; ?>">
  	<button type="submit" class="btn btn-primary">Respostas</button>
	</form>

  <form style="display:inline;" action="deletePergunta.php" method="post" onsubmit="return confirmDelete()">
    <input type="hidden" name="idpergunta" value="<?php echo $row["idpergunta"];?>">
  <input type="hidden" name="idteste2" value="<?php echo $var1?>">
  <input type="hidden" name="userr" value="<?php echo $autor?>">
  <input type="hidden" name="testenome" value="<?php echo $_GET['tested']; ?>">
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
        <h4 class="modal-title">Criação Perguntas</h4>
      </div>
      <div class="modal-body">

      <form action="inserirPergunta.php" method="post" enctype="multipart/form-data">
        <textarea required name="textoz" autofocus="" class='form-control' rows='2' placeholder='Insira a sua Pergunta' style='resize: none;'></textarea>
        <div class="modal-footer">
  <input type="hidden" name="idteste2" value="<?php echo $var1?>">
	<input type="hidden" name="userr" value="<?php echo $autor?>">
  <input type="hidden" name="testenome" value="<?php echo $_GET['tested']; ?>">

	<div style="text-align: left;" class="form-group">

    <label for="exampleInputFile">Inserir Imagem</label>
    <input type="file" name="imagempergunta" id="imagempergunta">

  </div>

      <button type="submit" name="submit" class="btn btn-primary"/>Criar</button>
      </div>
      </form>
      </div>
      
    </div>

  </div>
</div>
</div>



<!-- Modal mudar-->
<div id="updt3Quest" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Actualizar a Pergunta</h4>
      </div>

      <div class="modal-body">
<div>
  <form action="updPergunta.php" method="post">

  <input class="form-control"  type="text" id="per2" name="per2" placeholder="Pergunta" required>
    <br>
  <div class="modal-footer">

  <input type="hidden" name="idtes4" value="<?php echo $var1;?>">
  <input type="hidden" name="idperg4" id="idperg4" class="input"/>

  <input type="hidden" name="userr" value="<?php echo $autor?>">
  <input type="hidden" name="testenome" value="<?php echo $_GET['tested']; ?>">
    

    <button type="submit" class="btn btn-primary"/>Alterar</button>
  </div>
      </form>
      </div>
      
    </div>
  </div>
</div>
</div>


<script>
        $('#updt3Quest').on('show.bs.modal', function(e) {
            
            var $modal = $(this),
                esseyId = e.relatedTarget.id;
                $modal.find('.edit-content').html(esseyId);
                $("#idperg4").val(esseyId);
        })
    </script>

<?php
if (isset($_GET["insimg"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Pergunta criada com imagem</strong>
        </div>
        <?php
    }
if (isset($_GET["ninsimg"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-warning alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Pergunta criada sem imagem</strong>
        </div>
        <?php
    }
    if (isset($_GET["del"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Pergunta apagada</strong>
        </div>
        <?php
    }
if (isset($_GET["ndel"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Pergunta não apagada</strong>
        </div>
        <?php
    }
    if (isset($_GET["upd"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Pergunta Editada</strong>
        </div>
        <?php
    }
if (isset($_GET["nupd"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Pergunta não editada</strong>
        </div>
        <?php
    }
?>
 
    <script>setTimeout(function() {$("#errnot").fadeOut();}, 2000);</script>


</div>
</body>
</html>