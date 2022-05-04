<?php
$page="homepage";
include('menu/header.php');

ini_set('display_errors', 'On');
error_reporting(E_ALL);


?>
<style> 
    .container {
  position: relative;
  text-align: center;
}
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color:white;
}
</style>
<div class="container">
<img src="img/homepage_group3.jpeg" style="width:100%;height:50%" title="Home Page Image" alt="Home Page Image">
<?php
if(isset($_SESSION['student_id']))
{
    ?>
    <div class="centered"><h3><b>Welcome <?php echo $_SESSION['given_name']." ".$_SESSION['family_name'].", ".$_SESSION['category']." Student"; ?></b></h3></div>
    <?php
}
?>
</div>



<?php
include('menu/footer.php');
?>