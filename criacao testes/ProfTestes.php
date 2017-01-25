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

    <script>
      function confirmDelete() {
    return confirm("Apagar este teste?");}
    </script>
    
<div class="jumbotron jumbotron1" style="text-align: center;">
  <h1>Testes</h1>      
</div>

<?php
$autor = $_SESSION['login'];
$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
  die("Error: ".mysqli_connect_error());
$res=mysqli_query($conn,"select testesformacao.descricao, testesformacao.idteste, testesformacao.cotacao, testesformacao.disponivel, ufcd.nomeufcd FROM testesformacao INNER JOIN ufcd ON testesformacao.ufcd=ufcd.idufcd where testesformacao.autor='$autor'");


if(!$res)
  die("Error: ".mysqli_error($conn));

echo '<div class="container well well-sm">';
echo "<table class=\"table table-hover\" align=\"center\">";
echo "<thead><tr><th>Descricao</th><th>UFCD</th><th>Cotacao</th><th>Estado</th><th></th></tr></thead>";

while($row = mysqli_fetch_array($res))

{
  ?>
  <tr>
  <td><?php echo $row["descricao"]; ?></td>
  <td><?php echo $row["nomeufcd"]; ?></td>
  <td><?php echo $row["cotacao"]; ?></td>
  <td><?php 
  if($row["disponivel"]==0){
?>
    <form style="display:inline;" action="updTeste1.php" method="post">
      <input type="hidden" name="teavailable" value="1">
      <input type="hidden" name="idteste3" value="<?php echo $row["idteste"];?>">
      <button type="submit" class="btn btn-link">Indisponivel</button>
    </form>
<?php
    } else if($row["disponivel"]==1){
?>
    <form style="display:inline;" action="updTeste1.php" method="post">
      <input type="hidden" name="teavailable" value="0">
      <input type="hidden" name="idteste3" value="<?php echo $row["idteste"];?>">
      <button type="submit" class="btn btn-link">Disponivel</button>
    </form>
<?php
    } 
?>
</td>


    <td style="text-align: right;">

  <form style="display:inline;" method="post">
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#updt2Quest" data-id="<?php echo $row['idteste'];?>" id="<?php echo $row['idteste'];?>">Edit</button>
    <input type="hidden" name="descricaot" value="<?php echo $row["descricao"];?>">
    </form>

  <form style="display:inline;" action="ProfPerguntas.php" method="get">
    <input type="hidden" name="idteste" value="<?php echo $row["idteste"];?>">
    <input type="hidden" name="uusername" value="<?php echo $autor?>">
    <input type="hidden" name="tested" value="<?php echo $row["descricao"];?>">
    <button type="submit" class="btn btn-primary">Perguntas</button>
    </form>
    
  <form style="display:inline;" action="deleteTeste.php" method="post" onsubmit="return confirmDelete()">
    <input type="hidden" name="idteste" value="<?php echo $row["idteste"];?>">
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



<!-- Modal mudar-->
<div id="updt2Quest" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Actualizar o Teste</h4>
      </div>

      <div class="modal-body">
    <div>
  <form action="updTeste.php" method="post">
        
  <input class="form-control"  type="text" id="tes2" name="tes2" placeholder="Nome do Teste" required>
  <span>UFCD:</span>
  <?php
      $conn = mysqli_connect('localhost', 'root', '', 'pfinal');

      if (!$conn)
        die("Error: ".mysqli_connect_error());
      $res=mysqli_query($conn,"select * from ufcd where professor='$uid'");

      if(!$res)
        die("Error: ".mysqli_error($conn));

        $select= '<select class="form-control" style="width: 20%" id="ufcd" name="ufcd">';

        while($row = mysqli_fetch_array($res)){
          $select.='<option value="'.$row['idufcd'].'">'.$row['nomeufcd'].'</option>';
        }
        $select.='</select>';
        echo $select;
        ?>

    <span>Cotação: </span>
    <input class="form-control" min="0" step="5" value="100" style="width: 20%" type="number" id="tcotacao" name="tcotacao" required>
    <br>
  <div class="modal-footer">

    <input type="hidden" name="idtestea" id="idtestea" class="input"/>

    <button type="submit" class="btn btn-primary"/>Alterar</button>
  </div>
      </form>
      </div>
      
    </div>
  </div>
</div>
</div>
    <script>
        $('#updt2Quest').on('show.bs.modal', function(e) {
            
            var $modal = $(this),
                esseyId = e.relatedTarget.id;
                $modal.find('.edit-content').html(esseyId);
                $("#idtestea").val(esseyId);
        })
    </script>



<?php
if (isset($_GET["upd"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Teste alterado</strong>
        </div>
        <?php
    }
if (isset($_GET["nupd"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Erro ao alterar teste</strong>
        </div>
        <?php
    }
    if (isset($_GET["del"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Teste apagado</strong>
        </div>
        <?php
    }
if (isset($_GET["ndel"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Erro ao apagar teste</strong>
        </div>
        <?php
    }
if (isset($_GET["criado"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Teste criado!</strong>
        </div>
        <?php
    }
?>
 
    <script>setTimeout(function() {$("#errnot").fadeOut();}, 2000);</script>



</body>
</html>