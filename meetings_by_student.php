<?php
$page="meetings";
include('menu/header.php');

ini_set('display_errors', 'On');
error_reporting(E_ALL);


$viewMeetingsByStudent=$sectionObj->viewMeetingsByStudent($_GET['id']);
$viewMeetingsByStudent1=$sectionObj->viewMeetingsByStudent($_GET['id']);
$row1=$viewMeetingsByStudent1->fetch(PDO::FETCH_ASSOC);
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
<a href="search.php?search=students&searchTxt=<?php echo $_GET['searchText']; ?>">Go back</a>
<h2 style="margin-left:5%">View All Meetings for Student:</h2>
<h4 style="margin-left:5%">ID: <?php echo $_GET['id']; ?></h4>
<h4 style="margin-left:5%">Name: <?php echo $row1['given_name']." ".$row1['family_name']; ?></h4>

<table>
    <thead>
        <tr>
            <th>Meeting ID</th>
            <th>Group ID</th>
            <th>Day</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Room</th>
        </tr>
    </thead>
    <tbody>
        <?php
            while($row=$viewMeetingsByStudent->fetch(PDO::FETCH_ASSOC))
            {
                echo "
                <tr>
                <td>".$row['meeting_id']."</td>
                <td>".$row['group_id']."</td>
                <td>".$row['day']."</td>
                <td>".$row['start']."</td>
                <td>".$row['end']."</td>
                <td>".$row['room']."</td>
                </tr>";
            }
        ?>
    </tbody>
</table>




<?php
include('menu/footer.php');
?>