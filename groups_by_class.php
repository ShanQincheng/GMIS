<?php
$page="groups";
include('menu/header.php');

ini_set('display_errors', 'On');
error_reporting(E_ALL);


$viewGroupsbyClass=$sectionObj->viewGroupsbyClass($_GET['id']);
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
<a href="search.php?search=classes&searchTxt=<?php echo $_GET['searchText']; ?>">Go back</a>
<h2 style="margin-left:5%">View All Groups for Class <?php echo $_GET['id']; ?></h2>


<table>
    <thead>
        <tr>
            <th>Group ID</th>
            <th>Group Name</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while($row=$viewGroupsbyClass->fetch(PDO::FETCH_ASSOC))
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