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

    </head>
  <body>
<!-- VER ISTO PRAS PERGUNTAS -->
<?php $var2 =  $_POST['idteste2'];?>

	<?php include_once('menuProfessor.php'); ?>

    <div class="container pMenu">

	    <h1>Criar Pergunta</h1>
		<br><br>
		<?php //echo "ultimo ID: " . $_SESSION['lastid']?>


		<div id="pergunta">
		<p>Referente ao teste: <?php echo $var2 ?></p>
			<form class="form-signin" action="ProfTestes.php" method="post">
			    <textarea required class='form-control' rows='2' placeholder='Insira a sua Pergunta' style='resize: none;'></textarea>
			    <br>
			<div class='row'>

			  <div class='col-lg-6'>
			    <div class='input-group'>
			      <span class='input-group-addon'>
			        <input type='checkbox' aria-label='Checkbox for following text input'>
			      </span>
			      <input required type='text' class='form-control' aria-label='Text input with checkbox'>
			    </div>
			  </div>

			  <div class='col-lg-6'>
			    <div class='input-group'>
			      <span class='input-group-addon'>
			        <input type='checkbox' aria-label='Checkbox for following text input'>
			      </span>
			      <input required type='text' class='form-control' aria-label='Text input with checkbox'>
			    </div>
			  </div>

			  <div class='col-lg-6'>
			    <div class='input-group'>
			      <span class='input-group-addon'>
			        <input type='checkbox' aria-label='Checkbox for following text input'>
			      </span>
			      <input required type='text' class='form-control' aria-label='Text input with checkbox'>
			    </div>
			  </div>

			  <div class='col-lg-6'>
			    <div class='input-group'>
			      <span class='input-group-addon'>
			        <input type='checkbox' aria-label='Checkbox for following text input'>
			      </span>
			      <input required type='text' class='form-control' aria-label='Text input with checkbox'>
			    </div>
			  </div>

			</div>
			<div style="text-align: center;">
			   <br>
				<button type='submit' class='btn btn-primary'>Criar Pergunta</button>
			</div>
			</form>
		</div>
	</div>
</body>
</html>