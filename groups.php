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

<div class="visual-space"></div>
<h2 class="page-label">View All Groups</h2>

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