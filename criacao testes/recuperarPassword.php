<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projeto Final</title>
 
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
 
<div class="container logcont" style="text-align: center;">
<h3 class="form-signin-heading text-muted">Recuperar Password</h3>
<br>
<form class="form" action="RecuperarPasswordmail.php" method="post">
  <fieldset>
    <div class="form-group">
    <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
            <input id="emailInput" placeholder="email address" name="recupera" id="recupera" class="form-control" type="email" oninvalid="setCustomValidity('Inserir email válido!')" onchange="try{setCustomValidity('')}catch(e){}" required="">
      </div>
    </div>
    <div class="form-group">
    <input class="btn btn-lg btn-primary btn-block" type="submit" name="btnrecupera" id="btnrecupera">
    <a href="index.php">Login</a>
    </div>
  </fieldset>
</form>

</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>