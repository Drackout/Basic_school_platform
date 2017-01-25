<!DOCTYPE html>
<?php 
    session_start();
    /*
    if (isset($_SESSION["login"]))
        header("Location:index.php");*/
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projeto Final</title>
 
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="pfinaljs.js"></script>



    <link rel="stylesheet" href="js/notify.js">
    <link href="js/bootstrap-notify.min.js" rel="stylesheet">

  </head>
  <body>

<?php
if(isset($_SESSION["login"])) // user already logged in
{
    session_destroy();
    header("Location:index.php");
}

if (isset($_POST["login"]) && isset($_POST["username"]) && isset($_POST["password"]))
{
    $conn = mysqli_connect('localhost', 'root', '', 'pfinal');
    $q = mysqli_query($conn, "SELECT * FROM user WHERE nome='".$_POST["username"]."'");

    if (mysqli_num_rows($q) > 0) {
            $info = mysqli_fetch_array($q);
     }
     
        //se for professor
    if($info['nome'] == $_POST['username'] && $info['password'] == $_POST['password'] && $info['tipo'] == 'p'){
        $_SESSION["login"]=$_POST['username']/*$info['nome']*/;
        $_SESSION["usertype"]=$info['tipo'];
        $_SESSION["id2"]=$info['iduser'];
        $_SESSION["pw"]=$info['password'];
        header("Location:ProfPerfil.php");
    }
        //se for administrativo
    else if($info['nome'] == $_POST['username'] && $info['password'] == $_POST['password'] && $info['tipo'] == 's'){
        $_SESSION["login"]=$_POST['username']/*$info['nome']*/;
        $_SESSION["usertype"]=$info['tipo'];
        $_SESSION["id2"]=$info['iduser'];
        $_SESSION["pw"]=$info['password'];
        header("Location:AdminPerfil.php");
    }
        //se for aluno
    else if($info['nome'] == $_POST['username'] && $info['password'] == $_POST['password'] && $info['tipo'] == 'a'){
        $_SESSION["login"]=$_POST['username']/*$info['nome']*/;
        $_SESSION["usertype"]=$info['tipo'];
        $_SESSION["id2"]=$info['iduser'];
        $_SESSION["pw"]=$info['password'];

        header("Location:AlunoPaginaPrincipal.php");
    }
    else
    {   
        header("Location:index.php?wrong");
    }
}
else
{
    if (isset($_GET["wrong"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in" id="error" style="text-align: center;">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Dados Incorretos!</strong>
        </div>
        <?php
    }
}

?>


<div class="container logcont" style="text-align: center;">

    <form class="form-signin" action="index.php" method="post">
    <h1 class="form-signin-heading text-muted">Login</h1>
    <br>
    <input type="text" class="form-control" name="username" placeholder="Utilizador" required="" autofocus="">
    <br>
    <input type="password" class="form-control" name="password" placeholder="Password" required="">
    <br>
    <button class="btn btn-lg btn-primary btn-block" type="submit" value="Login" name='login'>
      Entrar
    </button>
    <a href="recuperarPassword.php">Recuperar Password</a>
  </form>
  
</div>

<script>setTimeout(function() {$("#error").fadeOut();}, 2000);</script>


  </body>
</html>