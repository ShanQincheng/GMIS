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

<div class="visual-space"></div>
<h2 class="page-label">View All Meetings</h2>

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