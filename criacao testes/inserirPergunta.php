<?php

$idteste = $_POST['idteste2'];
$uusername = $_POST['userr'];
$tested = $_POST['testenome'];

$upload=false;
$conn = mysqli_connect('localhost', 'root', '', 'pfinal');
if (!$conn)
	die("Error: ".mysqli_connect_error());
mysqli_set_charset($conn, "utf8");

$squery = mysqli_prepare($conn,"insert into tf_perguntas (teste, texto, autor) values(?,?,?)");
mysqli_stmt_bind_param($squery,"iss", $_POST['idteste2'], $_POST['textoz'], $_POST['userr']);

if(mysqli_stmt_execute($squery)){
	echo "Pergunta inserida<br>";
	$upload=true;
}
else
	echo "Erro ao inserir a Pergunta<br>";
mysqli_stmt_close($squery);


$target_dir = "uploadteste/";
$target_file = $target_dir . basename($_FILES["imagempergunta"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imagempergunta"]["tmp_name"]);
    if($check !== false) {
        echo "é uma imagem - " . $check["mime"] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "Não é uma imagem válida.<br>";
        $uploadOk = 0;
    }
}

// Check file size
if ($_FILES["imagempergunta"]["size"] > 2000000) {
    echo "Ficheiro demasiado grande.<br>";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "bmp" ) {
    echo "Extensões permitidas: .JPG, .JPEG, .PNG, .BMP.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    header('Location: ProfPerguntas.php'."?ninsimg&idteste=".$idteste."&uusername=".$uusername."&tested=".$tested);
// if everything is ok, try to upload file
} else {
    if ($upload=true && $uploadOk=1) {
	$target_path="uploadteste/";
	$target_path .= mysqli_insert_id($conn);
	$target_path .= ".png";
	move_uploaded_file($_FILES['imagempergunta']['tmp_name'], $target_path);
    header('Location: ProfPerguntas.php'."?insimg&idteste=".$idteste."&uusername=".$uusername."&tested=".$tested);
} else {
        header('Location: ProfPerguntas.php'."?ninsimg&idteste=".$idteste."&uusername=".$uusername."&tested=".$tested);
    }
}



?>