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


    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">


    </head>
  <body>
	<?php include_once('menuProfessor.php'); ?>
  <div class="jumbotron jumbotron1" style="text-align: center;">
  <h1>Criar Testes</h1>      
</div>
    <div class="container pMenu">
<br>

<?php 
//echo "Bem vindo " . $_SESSION["login"];
?><br>
<div>
    
    <form class="form-signin"  action="passo01.php" method="post">
    <span>Insira o nome do teste: </span>
    <input class="form-control" style="width: 20%" type="text" id="tnome" name="tnome" required>
    <br>
    <span>Insira a UFCD: </span>

      <?php
      $conn = mysqli_connect('localhost', 'root', '', 'pfinal');

      if (!$conn)
        die("Error: ".mysqli_connect_error());
      $res=mysqli_query($conn,"select * from ufcd where professor='$uid'");

      if(!$res)
        die("Error: ".mysqli_error($conn));

        $select= '<select class="form-control" style="width: 20%" id="ufcd" name="ufcd">';

        while($row = mysqli_fetch_array($res)){
          $select.='<option value="'.$row['idufcd'].'">'.$row['nomeufcd'].'</option>';
        }
        $select.='</select>';
        echo $select;
        ?>

      <br>
    
    <span>Insira a Cotação: </span>
    <input class="form-control" min="0" step="5" value="100" style="width: 20%" type="number" id="cotacao" name="cotacao" required>
      <br>

<span>Insira data e hora para terminar o teste: </span>
        <fieldset style="width: 65%;">
            <div class="form-group">
                <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="" data-link-field="dtp_input1">
                    <input class="form-control" size="16" name="tempo" type="text" readonly>
          <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
          <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                </div>
        <input type="hidden" id="dtp_input1" value="" /><br/>
            </div>
        </fieldset>

<script type="text/javascript" src="js/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.pt.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    forceParse: 0,
        showMeridian: 1
    });
  $('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
  $('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 1,
    minView: 0,
    maxView: 1,
    forceParse: 0
    });
</script>
<!--
    <span>Insira o Tempo em minutos (-1 sem tempo limite): </span>
    <input class="form-control" min="-1" step="1" value="-1" style="width: 20%" type="number" id="tempo" name="tempo" required>
    -->
      <input type="hidden" name="disponivel" id="disponivel" value="0">
      <input type="hidden" name="prof" id="prof" value="<?php echo $_SESSION['login']?>">

    <button type="submit" class="btn btn-primary">Criar</button>
    </form>

</div>

<br>

    </div>
</body>
</html>