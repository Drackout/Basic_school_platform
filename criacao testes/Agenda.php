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

    </head>
  <body>
  <!--pagina agenda do aluno-->
	<!--Verifica a ligação do Aluno-->
	<?php include_once('menuAluno.php'); ?>
	
	 <?php   
			$uname = $_SESSION["login"];
			$uid = $_SESSION["id2"];
            $pw = $_SESSION["pw"];
  ?>

<div class="jumbotron jumbotron1" style="text-align: center;">
  <h1>Agenda</h1>      
  
</div>
<!--Conteiner !!!!! para nao fugir-->
 <div class="container pMenu well well-sm" align="center" style="width:75%">

	<div>
		<table class="table table-hover">
			<tr>
				<th>UFCD</th>
				<th>Teste</th>
				<th>Dia</th>    
			</tr>
			<tr>
				<td>8596</td>
				<td>teste 1</td>
				<td>23/01/2017</td>    
			</tr>
			<tr>
				<td>2569</td>
				<td>teste 2</td>
				<td>28/01/2017</td>
			</tr>
		
		</table>
        
	</div>

    
</div>	
</body>
</html>
