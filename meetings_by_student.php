<?php
$page="meetings";
include('menu/header.php');

ini_set('display_errors', 'On');
error_reporting(E_ALL);


$viewMeetingsByStudent=$sectionObj->viewMeetingsByStudent($_GET['id']);
$getStudentDetails=$sectionObj->getStudentDetails($_GET['id']);
$row1=$getStudentDetails->fetch(PDO::FETCH_ASSOC);
?>

<div class="visual-space"></div>
<button type="submit" class="black-button"><a class="white-link" href="search-student-privacy.php?search=students&searchStudentID=<?php echo $_GET['searchStudentID']; ?>&searchStudentGN=<?php echo $_GET['searchStudentGN']; ?>&searchStudentFN=<?php echo $_GET['searchStudentFN']; ?>">Go back</a></button>
<h2 class="page-label">View All Meetings for Student:</h2>
<h4 class="page-label">ID: <?php echo $_GET['id']; ?></h4>
<h4 class="page-label">Name: <?php echo $row1['given_name']." ".$row1['family_name']; ?></h4>

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