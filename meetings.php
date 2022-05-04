<?php
$page="meetings";
include('menu/header.php');

ini_set('display_errors', 'On');
error_reporting(E_ALL);

if(!isset($_SESSION['category']) || $_SESSION['category']!='Masters')
{
    echo "<script> alert('You are not authorized to see this page!'); location.href='index.php'</script>";
}

$getAllMeetings=$sectionObj->getAllMeetings();
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
<h2 style="margin-left:5%">View All Meetings</h2>

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
            while($row=$getAllMeetings->fetch(PDO::FETCH_ASSOC))
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