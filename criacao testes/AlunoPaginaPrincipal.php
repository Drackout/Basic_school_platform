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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
  <body>
  <!--pagina principal do aluno-->
	<!--Mostra o menu Aluno-->
	<?php include_once('menuAluno.php'); ?>
	
	 <?php   
			$uname = $_SESSION["login"];
			$uid = $_SESSION["id2"];
      $pw = $_SESSION["pw"];
  ?>

<div class="jumbotron jumbotron1" style="text-align: center;">
  <h1>Perfil</h1>      
  <p><?php echo "Bem vindo/a <b>".$uname."</b>!" ?></p>
</div>

    <div class="container pMenu" align="center">
    <br>
    <?php
     echo '<img src="uploadavatar/'.$uid.'.png" class="img-circle" alt="Faça upload do seu avatar" width="150" height="150">';
     ?>
     <form action="insereAvatar3.php" method="post" enctype="multipart/form-data">
        <br><br>
        <label for="exampleInputFile">Mudar Imagem</label>
        <input type="file" name="imagempergunta" id="imagempergunta" required="">
        <input type="hidden" name="iduse2" id="iduse2" value="<?php echo $uid ?>">
        <br>
        <button type="submit" name="submit" class="btn btn-primary"/>Alterar Avatar</button>
        </form>
    <br><hr><br>
    <div class="input-group pwmuda">
    <form action="updpassword3.php" method="post">
    <label for="exampleInputFile">Mudar Password</label>
      <input type="Password" class="form-control" name="newpw" id="newpw" style="width: 100%" placeholder="Password" value="<?php echo $pw;?>">

      <input type="hidden" name="iduse" id="iduse" value="<?php echo $uid ?>">

      <span class="input-group-btn">
        <button class="btn btn-primary" type="submit">Actualizar</button>
      </span>
      </form>
    </div>


        

    </div>
	
<?php
if (isset($_GET["sim"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Imagem Alterada</strong>
        </div>
        <?php
    }
if (isset($_GET["nao"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Erro a Alterar Imagem</strong>
        </div>
        <?php
    }
    if (isset($_GET["pws"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Password Alterada</strong>
        </div>
        <?php
    }
if (isset($_GET["pwn"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Password não alterada</strong>
        </div>
        <?php
    }
    ?>
    <script>setTimeout(function() {$("#errnot").fadeOut();}, 2000);</script>

</body>
</html>
