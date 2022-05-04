<?php
$page="login";
include('menu/header.php');

ini_set('display_errors', 'On');
error_reporting(E_ALL);

session_destroy();

echo "<script> alert('You have been successfully logged Out!'); location.href='index.php'</script>";



?>




<?php
include('menu/footer.php');
?>