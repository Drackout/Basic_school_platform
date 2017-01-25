<!DOCTYPE html>
<?php
    session_start();
?>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/page.css">
<link rel="stylesheet" type="text/css" href="css/menu.css">
<title>Logout~</title>
</head>
<body>


<div id="page-main-content">

<?php
if(isset($_SESSION["login"])) // user already logged in
{
    session_destroy();
    header("Location:index.php");
}
?>
</div>

</body>
</html>