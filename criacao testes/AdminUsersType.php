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
  <h1>Utilizadores</h1>      
</div>

<div style="text-align: center;">
<form action="ProfPerguntas.php" method="post">
<input type="hidden" name="idteste2" value="<?php echo $var1?>">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myQuest">Criar utilizador</button>
</form>
</div>
<br>
<div class="container">
        <div class="input-group">
                <div class="input-group-btn search-panel">
                    <button style="
    border-radius: 20px 20px 20px 20px;
" type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                      <span id="search_concept">Filtrar</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="AdminUsersType.php?admin">Administradores</a></li>
                      <li><a href="AdminUsersType.php?prof">Professores</a></li>
                      <li><a href="AdminUsersType.php?aluno">Alunos</a></li>
                    </ul>
                </div>
            </div>
</div>
<br>
<br>

<div class="container well well-sm">

<?php
if (isset($_GET["admin"]))
    {
        $utypo = "s";
    }
else
  if (isset($_GET["prof"]))
    {
        $utypo = "p";
    }
else
if (isset($_GET["aluno"]))
    {
        $utypo = "a";
}




$conn = mysqli_connect('localhost', 'root', '', 'pfinal');

if (!$conn)
  die("Error: ".mysqli_connect_error());
$res=mysqli_query($conn,"SELECT * FROM user where iduser>0 and tipo='$utypo'");

if(!$res)
  die("Error: ".mysqli_error($conn));

echo "<div class=\"container\">"; 
echo "<table class=\"table table-hover\" align=\"center\">";
echo "<thead><tr><th>Nome</th><th>User</th><th>Email</th><th></th></thead>";

while($row = mysqli_fetch_array($res))

{
  ?>
  <tr>
  <td><?php echo "<b>".$row["nome"]."</b>" ?></td>
  <td><?php if($row["tipo"]=='p'){
          echo "<b>Professor</b>";
        } else 
        if ($row["tipo"]=='a'){
          echo "<b>Aluno</b>";
        } else
        if ($row["tipo"]=='s'){
          echo "<b>Administrador</b>";
        }else
          echo "<b>Desconhecido</b>";
      ?>
  </td>
  <td><?php echo $row["email"]; ?></td>
	<td style="text-align: right;">

	<form style="display:inline;" method="post">
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#updt3Quest" data-id="<?php echo $row['iduser'];?>" id="<?php echo $row['iduser'];?>">Edit</button>
    <input type="hidden" name="ptexto" value="<?php echo $row["iduser"];?>">
    <?php $idusrr = $row["iduser"] ?>
    </form>

  <form style="display:inline;" action="AdminusrDel.php" method="post" onsubmit="return confirmDelete()">
    <input type="hidden" name="idudel" value="<?php echo $row["iduser"];?>">
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
        <h4 class="modal-title">Criação de Utilizador</h4>
      </div>
      <div class="modal-body">

      <form action="AdmininserirUser.php" method="post" enctype="multipart/form-data">
      <input class='form-control' required="" type="texto" name="nameu" placeholder="Nome do utilizador"><br>
      <input class='form-control' required="" type="texto" name="passu" placeholder="Password do utilizador"><br>
      <input class='form-control' required="" type="email" name="emailu" placeholder="Email do utilizador"><br>

      <label class="radio-inline">
        <input type="radio" name="tipouser" id="tp1" value="p"> Professor
      </label><br>
      <label class="radio-inline">
        <input type="radio" checked="true" name="tipouser" id="tp2" value="a"> Aluno
      </label><br>
      <label class="radio-inline">
        <input type="radio" name="tipouser" id="tp3" value="s"> Administrador
      </label>
        
    <div class="modal-footer">
      <input type="hidden" name="idteste2" value="<?php echo $var1?>">
	    <input type="hidden" name="userr" value="<?php echo $autor?>">

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
        <h4 class="modal-title">Actualizar o utilizador</h4>
      </div>

      <div class="modal-body">
<div>
  <form action="AdminUpdUser.php" method="post">

  <input class='form-control' required="" type="texto" name="nameu2" placeholder="Nome do utilizador"><br>
      <input class='form-control' required="" type="texto" name="passu2" placeholder="Password do utilizador"><br>
      <input class='form-control' required="" type="email" name="emailu2" placeholder="Email do utilizador"><br>

  <div class="modal-footer">

    <input type="hidden" name="iduser2" id="iduser2" class="input"/>
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
                $("#iduser2").val(esseyId);
        })
    </script>

</div>

<?php
if (isset($_GET["inser"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Utilizador criado</strong>
        </div>
        <?php
    }
if (isset($_GET["ninser"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Erro ao criar Utilizador</strong>
        </div>
        <?php
    }
    if (isset($_GET["upd"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Utilizador actualizado</strong>
        </div>
        <?php
    }
    if (isset($_GET["nupd"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-warning alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Utilizador não alterado</strong>
        </div>
        <?php
    }
    if (isset($_GET["apagado"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Utilizador apagado</strong>
        </div>
        <?php
    }
    if (isset($_GET["napagado"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Utilizador não apagado</strong>
        </div>
        <?php
    }

    ?>

    <script>setTimeout(function() {$("#errnot").fadeOut();}, 2000);</script>

</body>
</html>