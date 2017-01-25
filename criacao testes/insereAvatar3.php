<?php
$uid = $_POST['iduse2'];

$target_dir = "uploadavatar/";
$target_file = $target_dir . basename($_FILES["imagempergunta"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imagempergunta"]["tmp_name"]);
    if($check !== false) {
        header("Location:AlunoPaginaPrincipal.php?sim");
        $uploadOk = 1;
    } else {
        header("Location:AlunoPaginaPrincipal.php?nao");
        $uploadOk = 0;
    }
}
/* Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.<br>";
    $uploadOk = 0;
}*/

// Check file size
if ($_FILES["imagempergunta"]["size"] > 2000000) {
    header("Location:AlunoPaginaPrincipal.php?nao");
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "bmp" ) {
    header("Location:AlunoPaginaPrincipal.php?nao");
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    header("Location:AlunoPaginaPrincipal.php?nao");
// if everything is ok, try to upload file
} else {
    if ($upload=true && $uploadOk=1) {
	$target_path="uploadavatar/";
	$target_path .= $uid;
	$target_path .= ".png";
	move_uploaded_file($_FILES['imagempergunta']['tmp_name'], $target_path);
} else {
        header("Location:AlunoPaginaPrincipal.php?nao");
    }
}

?>