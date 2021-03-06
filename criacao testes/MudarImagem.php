<?php
$target_dir = "uploadavatar/";
$target_file = $target_dir . basename($_FILES["imagempergunta"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["imagempergunta"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".<br><br>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br><br>";
        $uploadOk = 0;
    }
}
// Check file size
if ($_FILES["imagempergunta"]["size"] > 500000) {
    echo "Sorry, your file is too large.<br><br>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br><br>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.<br><br>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["imagempergunta"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["imagempergunta"]["name"]). " has been uploaded.<br><br>";
    } else {
        echo "Sorry, there was an error uploading your file.<br><br>";
    }
}
?>




