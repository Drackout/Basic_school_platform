<!DOCTYPE html>
<?php
    session_start();
    if (!isset($_SESSION["login"]))
        header("Location:index.php");

    if (isset($_SESSION["usertype"]) && $_SESSION["usertype"]!="s")
        header("Location:perfil.php");  

    $uid = $_SESSION["id2"];
    $pw = $_SESSION["pw"];
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projeto Final</title>
 
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/menusProf.css" rel="stylesheet">

    </head>
  <body>


<!--

<nav class="navbar navbar-inverse" style="margin-bottom: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="AdminPerfil.php">
      <img src="images/cinel.png" style="margin-top: -10px;" alt="Cinel :3" width="40" height="40"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="AdminTurmaAluno.php">Turma/Aluno</a></li>
        <li><a href="AdminCriarTurma.php">Turmas</a></li>
        <li><a href="AdminUsers.php">Utilizadores</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="AdminPerfil.php"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
-->


<nav style="position: absolute;" class="navbar navbar-default sidebar" role="navigation">
    <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>      
    </div>
    <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
      <ul class="nav navbar-nav hovey1">

      <li><a href="AdminNotas.php">Dashboard<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tasks"></span></a></li> 

        <li><a href="AdminTurmaAluno.php">Associar Turma/Aluno<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-resize-small"></span></a></li> 
        
        <li><a href="AdminCriarTurma.php">Turmas<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-edit"></span></a></li> 

        <li><a href="AdminUsers.php">Utilizadores<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>  

        <li><a href="AdminPerfil.php">Perfil<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a></li>
      
        <?php
  if (isset($_SESSION["login"])){
    ?>
    <li ><a href="logout.php">Logout<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-off"></span></a></li>
    <?php
    }
      else{
        ?>
          <li ><a href="logout.php">Logout<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-off"></span></a></li>
        <?php           
          }
  ?>
      </ul>
    </div>
  </div>
</nav>



  </body>
</html>