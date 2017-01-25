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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    </head>
  <body>
	<?php include_once('menuAluno.php'); ?>
	
	
<div class="jumbotron jumbotron1" style="text-align: center;">
<h2><?php echo $_GET['pergunta'] ?></h2> 
<p id="timer"></p> 
</div>

<div class="container">

<?php
$incr=1;
$testeid = $_GET['testeid'];
$idpergunta = $_GET['idpergunta1'];
$tested = $_GET['tested'];
$ufcd = $_GET['ufcdide1'];
$tempz = $_GET['tempoo'];


//conexão
$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
  die("Error: ".mysqli_connect_error());


$nome=mysqli_query($conn,"select texto, idresposta from tf_respostas where pergunta='$idpergunta'");
$idresp = $_SESSION['login'];


echo '<div class="container well well-sm">';
echo "<table class=\"table table-hover\" align=\"center\">";
echo '<img src="uploadteste/'.$idpergunta.'.png" class="img-thumbnail" alt="Pergunta sem imagem" width="200" height="200">';
echo "<thead><tr><th></th><th></th></tr></thead>";
?>
<form style='display:inline;'  action='respSubmit.php' method='post' >
<?php
$respids = array();
while($row = mysqli_fetch_array($nome))

{
?>
  <tr>
<td>
    <div class="checkbox" style="text-align: center;">
      <input type="radio" name="repostra_<?php echo $incr ?>" value="1">True<br>
      <input type="radio" name="repostra_<?php echo $incr ?>" value="0" checked>False
    </div>
</td>

<td><?php echo $row["texto"]; ?></td>


<input type="hidden" name="respid_<?php echo $incr ?>" value="<?php echo $row['idresposta']; ?>">

<?php $incr++; ?>

 </tr>
<?php
}
?>
<input type="hidden" name="totalps" value="<?php echo $incr ?>">
<input type="hidden" name="testeid" value="<?php echo $testeid ?>">
<input type="hidden" name="idpergunta" value="<?php echo $idpergunta ?>">
<input type="hidden" name="idaluno" value="<?php echo $uid ?>">
<input type="hidden" name="tested" value="<?php echo $tested ?>">
<input type="hidden" name="ufcdide" value="<?php echo $ufcd ?>">
<input type="hidden" name="testempo" value="<?php echo $tempz ?>">

<?php
echo "<div style='text-align:right'>";
echo "<button style='display:inline' type='submit' class='btn btn-primary'>Confirmar</button>";
echo "<select name='opcao' style='display:inline; width:30%' class='form-control'> <option value='1'>Inserir</option> <option value='2'>Modificar</option> </select>";
echo "</div>";
echo "</form>";
echo "</table>";
echo '</div>';
mysqli_free_result($nome);
mysqli_close($conn);
?>

  
<script type="text/javascript">
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $_GET['tempoo'] ?>").getTime();

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
        //document.getElementById("timer").innerHTML = "Teste Expirado!";
        window.location = 'Vernotas.php?expirado';
    }
}, 1000);
</script>


</div>
</body>
</html>