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
    <script src="pfinaljs.js"></script>
  </head>
  <body>
<!--Login Inicio/Fim de Seção!-->
<?php
if(isset($_SESSION["login"])) // user já logado!
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
    if($_POST["username"]=="Admin" && $_POST["password"]=="1234"){
        $_SESSION["login"]="Admin";
        header("Location:AlunoPaginaPrincipal.php");
      }
        //se for professor
    else if($info['nome'] == $_POST['username'] && $info['password'] == $_POST['password'] && $info['tipo'] == 'p'){
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
        <script>alert("Password ou username errado");</script>
        <?php
    }
}

?>
<!--Fim Login-->
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

  </body>
</html>