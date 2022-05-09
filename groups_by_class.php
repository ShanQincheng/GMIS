<?php
$page="groups";
include('menu/header.php');

ini_set('display_errors', 'On');
error_reporting(E_ALL);


$viewGroupsbyClass=$sectionObj->viewGroupsbyClass($_GET['id']);
?>

<div class="visual-space"></div>
<a href="search.php?search=classes&searchTxt=<?php echo $_GET['searchText']; ?>">Go back</a>
<h2 class="page-label">View All Groups for Class <?php echo $_GET['id']; ?></h2>


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