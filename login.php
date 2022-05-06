<?php
$page="login";
include('menu/header.php');

ini_set('display_errors', 'On');
error_reporting(E_ALL);

$email=$_POST['email'];
$password=$_POST['password'];
// echo "EMAIL:".$email."---- PASSWORD:".$password;

$login=$sectionObj->loginHardCode($email,$password);

if($login==1)
{
    echo "Welcome ".$_SESSION['given_name'];
    echo "<script> alert('You have been successfully logged In!'); location.href='index.php'</script>";
}
else
{
    echo "Account was not found! please try again!";
}

?>




<?php
include('menu/footer.php');
?>