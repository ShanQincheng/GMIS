<?php
$page="students";
include('menu/header.php');

ini_set('display_errors', 'On');
error_reporting(E_ALL);

if(!isset($_SESSION['category']) || $_SESSION['category']!='Masters')
{
    echo "<script> alert('You are not authorized to see this page!'); location.href='index.php'</script>";
}

$getAllStudents=$sectionObj->getAllStudents();
?>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 80%;
  margin-left:5%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<div style="height: 10px;"></div>
<h2 style="margin-left:5%">View All Students</h2>

<table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Student ID</th>
            <th>Given Name</th>
            <th>Family Name</th>
            <th>Group ID</th>
            <th>Title</th>
            <th>Campus</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Category</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while($row=$getAllStudents->fetch(PDO::FETCH_ASSOC))
            {
                echo "
                <tr>
                <td><img src='img/student_img/".$row['photo']."' style='width:30px'></td>
                <td>".$row['student_id']."</td>
                <td>".$row['given_name']."</td>
                <td>".$row['family_name']."</td>
                <td>".$row['group_id']."</td>
                <td>".$row['title']."</td>
                <td>".$row['campus']."</td>
                <td><a href='tel:".$row['phone']."'>".$row['phone']."</a></td>
                <td><a href='mailto:".$row['email']."'>".$row['email']."</a></td>
                <td>".$row['category']."</td>
                </tr>";
            }
        ?>
    </tbody>
</table>




<?php
include('menu/footer.php');
?>