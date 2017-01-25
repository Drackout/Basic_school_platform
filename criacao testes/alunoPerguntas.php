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
	<?php include_once('menuAluno.php'); ?>


  
    

<div class="jumbotron jumbotron1" style="text-align: center;">
  <h1><?php echo $_GET['tested']?></h1>
  <p id="timer"></p>
</div>

<div class="container">



<br>

<?php
$testeid= $_GET['testeid'];
$ufcdid= $_GET['ufcdblep'];
$tempoo = $_GET['testempo'];

$conn = mysqli_connect('localhost', 'root', '', 'pfinal');

if (!$conn)
  die("Error: ".mysqli_connect_error());
$res=mysqli_query($conn,"select * from tf_perguntas where teste='$testeid'");

if(!$res)
  die("Error: ".mysqli_error($conn));

echo "<div class=\"container well well-sm\">"; 
echo "<table class=\"table table-hover\" align=\"center\">";
echo "<thead><tr><th>Perguntas</th><th></th></tr></thead>";

while($row = mysqli_fetch_array($res))

{
  ?>
  <tr>
  <td><?php echo $row["texto"]; ?></td>

 <td style="text-align: right;">

 <form style="display:inline;" action="alunoResposta.php" method="get">

	<input type="hidden" name="testeid" value="<?php echo $testeid ?>">
	<input type="hidden" name="pergunta" value="<?php echo $row["texto"];?>">
	<input type="hidden" name="ufcdide1" value="<?php echo $ufcdid ?>">
    <input type="hidden" name="idpergunta1" value="<?php echo $row["idpergunta"];?>">
	<input type="hidden" name="tested" value="<?php echo $_GET['tested'];?>">
	<input type="hidden" name="tempoo" value="<?php echo $tempoo ?>">
    <button type="submit" class="btn btn-primary">Responder</button>
    </form>
    </td>
 </tr>
    <?php
}
echo "</table>";
?>
<form style='display:inline;' action='Notas.php' method='post'>
<div align='center'>
<input type="hidden" name="testeid" value="<?php echo $testeid ?>">
<input type="hidden" name="ufcdide" value="<?php echo $ufcdid ?>">
<input type="hidden" name="alunoid" value="<?php echo $uid ?>">
<button type='submit' class='btn btn-primary'>Finalizar Teste</button>
</div>
</form>
<br>




<script type="text/javascript">
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $_GET['testempo'] ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("timer").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("timer").innerHTML = "Teste Expirado!";
    }
}, 1000);
</script>




</div>
<?php

mysqli_free_result($res);
mysqli_close($conn);
?>

</div>

<?php
if (isset($_GET["updsim"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Resposta Alterada</strong>
        </div>
        <?php
    }
if (isset($_GET["updnao"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Erro a Alterar Resposta</strong>
        </div>
        <?php
    }
    if (isset($_GET["inssim"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-success alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Respondido com successo</strong>
        </div>
        <?php
    }
if (isset($_GET["insnao"]))
    {
        ?>
        <!--<script>alert("Password ou username errado");</script>-->
        <div class="alert alert-danger alert-dismissable fade in nots" id="errnot">
            <!--<a class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
            <strong>Erro ao responder</strong>
        </div>
        <?php
    }
    ?>

<script>setTimeout(function() {$("#errnot").fadeOut();}, 2000);</script>
</body>
</html>