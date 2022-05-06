<?php
$page="search";
include('menu/header.php');

ini_set('display_errors', 'On');
error_reporting(E_ALL);

if(!isset($_SESSION['category']))
{
    echo "<script> alert('You are not authorized to see this page!'); location.href='index.php'</script>";
}
if(isset($_POST['searchText'],$_POST['operation']))
{
    $search=$sectionObj->search($_POST['searchText'],$_POST['operation']);
}

?>

<div style="height: 10px;"></div>
<h2 style="margin-left:5%">Search</h2>
<style>
input[type=text],select {
  width: 15%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: black;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 10%;
}

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
<form name="search" method="post" action="search.php">
    <input type="text" style="margin-left:5%" placeholder="Enter Keyword to search.." name="searchText" <?php if(isset($_POST['searchText'])) echo "value='".$_POST['searchText']."'"; ?>required>
    <select name="operation" required>
        <?php
        $classes='';$groups='';$meetings='';$students='';
        if(isset($_POST['operation']) and $_POST['operation']=='classes') $classes='selected';
        if(isset($_POST['operation']) and $_POST['operation']=='groups') $groups='selected';
        if(isset($_POST['operation']) and $_POST['operation']=='meetings') $meetings='selected';
        if(isset($_POST['operation']) and $_POST['operation']=='students') $students='selected';
        ?>
        <option value="" >Select an operation..</option>
        <option value="classes" <?php echo $classes; ?>>Classes</option>
        <option value="groups" <?php echo $groups; ?>>Groups</option>
        <option value="meetings" <?php echo $meetings; ?>>Meetings</option>
        <option value="students" <?php echo $students; ?>>Students</option>
    </select>
    <button type="submit" name="submit" value="Submit">Submit</button>
</form>

<?php
if(isset($_POST['searchText'],$_POST['operation']))
{
    if($_POST['operation']=='classes')
    {
        ?>
        <h4 style="margin-left:5%">View Classes having search criteria: <?php echo $_POST['searchText']; ?></h4>

        <table>
            <thead>
                <tr>
                    <th>Class ID</th>
                    <th>Group ID</th>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Room</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row=$search->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "
                        <tr>
                        <td>".$row['class_id']."</td>
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
    }
    elseif($_POST['operation']=='groups')
    {
        ?>
        <h4 style="margin-left:5%">View Groups having search criteria: <?php echo $_POST['searchText']; ?></h4>

        <table>
            <thead>
                <tr>
                    <th>Group ID</th>
                    <th>Group Name</th>
                    <th>Students</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row=$search->fetch(PDO::FETCH_ASSOC))
                    {
                        $groupID = $row['group_id'];
                        echo "
                        <tr>
                        <td>".$row['group_id']."</td>
                        <td>".$row['group_name']."</td>
                        <td><a href='?viewAll=students&groupID=$groupID'>View All</a></td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
        <?php
    }
    elseif($_POST['operation']=='meetings')
    {
        ?>
        <h4 style="margin-left:5%">View Meetings having search criteria: <?php echo $_POST['searchText']; ?></h4>

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
                    while($row=$search->fetch(PDO::FETCH_ASSOC))
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
    }
    elseif($_POST['operation']=='students')
    {
        ?>
        <h4 style="margin-left:5%">View Students having search criteria: <?php echo $_POST['searchText']; ?></h4>

        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Given Name</th>
                    <th>Family Name</th>
                    <th>Group ID</th>
                    <th>Title</th>
                    <th>Campus</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Category</th>
                    <th>Classes</th>
                    <th>Meetings</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row=$search->fetch(PDO::FETCH_ASSOC))
                    {
                        $groupID = $row['group_id'];
                        echo "
                        <tr>
                        <td>".$row['student_id']."</td>
                        <td>".$row['given_name']."</td>
                        <td>".$row['family_name']."</td>
                        <td>".$row['group_id']."</td>
                        <td>".$row['title']."</td>
                        <td>".$row['campus']."</td>
                        <td><a href='tel:".$row['phone']."'>".$row['phone']."</a></td>
                        <td><a href='mailto:".$row['email']."'>".$row['email']."</a></td>
                        <td>".$row['category']."</td>
                        <td><a href='?viewAll=classes&groupID=$groupID'>View All</a></td>
                        <td><a href='?viewAll=meetings&groupID=$groupID'>View All</a></td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
        <?php
    }
}
?>

<?php
if(isset($_GET["viewAll"]) and $_GET["viewAll"] == "classes")
{
    $groupID = $_GET["groupID"];
    $allCalsses=$sectionObj->getAllClassByGroupID($groupID);

    echo "
                        <table>
                            <thead>
                            <tr>
                                <th>Class ID</th>
                                <th>Group ID</th>
                                <th>Day</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Room</th>
                            </tr>
                            </thead>
                            <tbody>";
    while($row=$allCalsses->fetch(PDO::FETCH_ASSOC))
    {
        echo "
                            <tr>
                            <td>".$row['class_id']."</td>
                            <td>".$row['group_id']."</td>
                            <td>".$row['day']."</td>
                            <td>".$row['start']."</td>
                            <td>".$row['end']."</td>
                            <td>".$row['room']."</td>
                            </tr>";
    }
    echo"
                        </tbody>
                    </table>";
}
?>

<?php
if(isset($_GET["viewAll"]) and $_GET["viewAll"] == "meetings")
{
    $groupID = $_GET["groupID"];
    $allMeetings=$sectionObj->getAllMeetingsByGroupID($groupID);

    echo "
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
            <tbody>";

    while($row=$allMeetings->fetch(PDO::FETCH_ASSOC))
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
           echo"  
            </tbody>
        </table>";
}
?>

<?php
if(isset($_GET["viewAll"]) and $_GET["viewAll"] == "students")
{
    $groupID = $_GET["groupID"];
    $allStudents=$sectionObj->getAllStudentsByGroupID($groupID);

    echo "
          <table>
            <thead>
                <tr>
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
            <tbody>";

    while($row=$allStudents->fetch(PDO::FETCH_ASSOC))
    {
        echo "
            <tr>
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
    echo"  
            </tbody>
        </table>";
}
?>

<?php
include('menu/footer.php');
?>
