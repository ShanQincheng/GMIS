<?php
$page="groups";
include('menu/header.php');

ini_set('display_errors', 'On');
error_reporting(E_ALL);

if(!isset($_SESSION['category']) || $_SESSION['category']!='Masters')
{
    echo "<script> alert('You are not authorized to see this page!'); location.href='index.php'</script>";
}

$getAllGroups=$sectionObj->getAllGroups();
?>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
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
<h2 style="margin-left:5%">View All Groups</h2>

<table>
    <thead>
        <tr>
            <th>Group ID</th>
            <th>Group Name</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while($row=$getAllGroups->fetch(PDO::FETCH_ASSOC))
            {
                echo "
                <tr>
                <td>".$row['group_id']."</td>
                <td>".$row['group_name']."</td>
                </tr>";
            }
        ?>
    </tbody>
</table>




<?php
include('menu/footer.php');
?>