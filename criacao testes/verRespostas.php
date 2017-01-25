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

  <?php  ?>
    <script>
      function confirmDelete() {
    return confirm("Apagar esta Pergunta?");}
    </script>
    <div class="jumbotron jumbotron1" style="text-align: center;">
  <h1><?php echo $_GET['respp'];?></h1>      
</div>

<div class="container">
<div style="text-align: center;">
<form method="post">
<input type="hidden" name="idteste2" value="<?php echo $var1?>">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myQuest">Criar Resposta</button>
</form>
</div>
<br>

<?php
$autor = $_GET['userr'];
$pergunta = $_GET['idpergunta'];


$conn = mysqli_connect('localhost', 'root', '', 'pfinal');

if (!$conn)
  die("Error: ".mysqli_connect_error());
$res=mysqli_query($conn,"select * from tf_respostas where autor='$autor' and pergunta='$pergunta'");

if(!$res)
  die("Error: ".mysqli_error($conn));

echo "<div class=\"container well well-sm\">";
echo "<table class=\"table table-hover\" align=\"center\">";
echo "<thead><tr><th>Resposta</th><th>Certo</th><th>Cotacao</th><th style=\"text-align: right; color:lightgray;\">".$pergunta."</th></thead>";

while($row = mysqli_fetch_array($res))

{
  ?>
  <tr>
  <td><?php echo $row["texto"]; ?></td>
  <td><?php 
        if($row["certo"]==0){
          echo "<font color='red'><b>Errado</b>";
        } else{
          echo "<font color='green'><b>Certo</b>";
        }  
      ?></td>
  <td><?php echo $row["cotacao"]; ?></td>

	 <td style="text-align: right;">
  <form style="display:inline;" method="post">
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#updtQuest" data-id="<?php echo $row['idresposta'];?>" id="<?php echo $row['idresposta'];?>">Edit</button>
    <input type="hidden" name="idresposta2" value="<?php echo $row["idresposta"];?>">
  </form>

  <form style="display:inline;" action="delResposta.php" method="post" onsubmit="return confirmDelete()">
    <input type="hidden" name="idresposta" value="<?php echo $row["idresposta"];?>">

    <input type="hidden" name="idteste2" value="<?php echo $var1?>">
    <input type="hidden" name="userr" value="<?php echo $autor?>">
    <input type="hidden" name="perguntar" value="<?php echo $pergunta?>">
    <input type="hidden" name="pernome" value="<?php echo $_GET['respp']; ?>">

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


<!-- Modal criar-->
<div id="myQuest" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Criação de Respostas</h4>
      </div>

      <div class="modal-body">
      <form action="inserirResposta.php" method="post">
  <input class="form-control"  type="text" id="resp1" name="resp1" placeholder="Resposta" required>
  <span>Certo? </span>
  <select class="form-control" style="width: 40%" id="rcerto" name="rcerto">
    <option value="0">Não</option>
    <option value="1">Sim</option>
  </select>
  <br>
  <input class="form-control" min="0" style="width: 40%" step="1" value="0" type="number" id="rcotacao" name="rcotacao" required>
        <div class="modal-footer">
    <input type="hidden" name="idteste2" value="<?php echo $var1?>">
	  <input type="hidden" name="userr" value="<?php echo $autor?>">
    <input type="hidden" name="perguntar" value="<?php echo $pergunta?>">
    <input type="hidden" name="pernome" value="<?php echo $_GET['respp']; ?>">
      <button type="submit" class="btn btn-primary"/>Criar</button>
        </div>
      </form>
      </div>

    </div>
  </div>
</div>
</div>


<!-- Modal mudar-->
<div id="updtQuest" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Actualizar a Resposta</h4>
      </div>

      <div class="modal-body">
    <div>
      <form action="updResposta.php" method="post">

  <input class="form-control"  type="text" id="resp2" name="resp2" placeholder="Nova resposta" required>
  <span>Certo? </span>
  <select class="form-control" style="width: 40%" id="rcerto2" name="rcerto2">
    <option value="0">Não</option>
    <option value="1">Sim</option>
  </select>
  <br>
  <input class="form-control" min="0" style="width: 40%" step="1" value="0" type="number" id="rcotacao2" name="rcotacao2" required>
        <div class="modal-footer">

  <input type="hidden" name="idresposta2" id="idresposta2" class="input"/>
  <input type="hidden" name="idteste2" value="<?php echo $var1?>">
  <input type="hidden" name="userr" value="<?php echo $autor?>">
  <input type="hidden" name="perguntar" value="<?php echo $pergunta?>">
    <input type="hidden" name="pernome" value="<?php echo $_GET['respp']; ?>">


      <button type="submit" class="btn btn-primary"/>Alterar</button>
        </div>
      </form>
      </div>
      
    </div>
  </div>
</div>
</div>

<script>
        $('#updtQuest').on('show.bs.modal', function(e) {
            
            var $modal = $(this),
                esseyId = e.relatedTarget.id;
                $modal.find('.edit-content').html(esseyId);
                $("#idresposta2").val(esseyId);
        })
    </script>

</div>
</body>

<?php
if (isset($_GET["inser"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Resposta criada</strong>
        </div>
        <?php
    }
if (isset($_GET["ninser"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-warning alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Resposta nao criada</strong>
        </div>
        <?php
    }
if (isset($_GET["edit"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Resposta modificada</strong>
        </div>
        <?php
    }
if (isset($_GET["nedit"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-warning alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Resposta nao modificada</strong>
        </div>
        <?php
    }
if (isset($_GET["del"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Resposta apagada</strong>
        </div>
        <?php
    }
if (isset($_GET["ndel"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-warning alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Resposta nao apagada</strong>
        </div>
        <?php
    }
?>
 
    <script>setTimeout(function() {$("#errnot").fadeOut();}, 2000);</script>


</html>