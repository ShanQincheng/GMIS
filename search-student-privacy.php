<?php
$page="search-student-privacy";
include('menu/header.php');

ini_set('display_errors', 'On');
error_reporting(E_ALL);

if(!isset($_SESSION['category']))
{
    echo "<script> alert('You are not authorized to see this page!'); location.href='index.php'</script>";
}
if(isset($_POST['searchStudentID'],$_POST['searchStudentGN'],$_POST['searchStudentFN']))
{
    $search=$sectionObj->searchStudent($_POST['searchStudentID'],$_POST['searchStudentGN'],$_POST['searchStudentFN']);

    $searchStudentID=$_POST['searchStudentID'];
    $searchStudentGN=$_POST['searchStudentGN'];
    $searchStudentFN=$_POST['searchStudentFN'];
}
if(isset($_GET['searchStudentID'],$_GET['searchStudentGN'],$_GET['searchStudentFN']))
{
    $search=$sectionObj->searchStudent($_GET['searchStudentID'],$_GET['searchStudentGN'],$_GET['searchStudentFN']);

    $searchStudentID=$_GET['searchStudentID'];
    $searchStudentGN=$_GET['searchStudentGN'];
    $searchStudentFN=$_GET['searchStudentFN'];
}

?>

    <link rel="stylesheet" type="text/css" href="css/search-page.css?version=2">
    <div class="visual-space"></div>
    <h2 class="page-label">Search</h2>

    <form name="search" method="post" action="search-student-privacy.php">
        <input class="search-input" type="text" placeholder="Student ID" name="searchStudentID"
            <?php if(isset($_GET['searchStudentID']))
                echo "value='".$_GET['searchStudentID']."'";
            ?>
            <?php if(isset($_POST['searchStudentID']))
                echo "value='".$_POST['searchStudentID']."'";
            ?>required>
        <input class="search-input" type="text" placeholder="Given Name" name="searchStudentGN"
            <?php if(isset($_GET['searchStudentGN']))
                echo "value='".$_GET['searchStudentGN']."'";
            ?>
            <?php if(isset($_POST['searchStudentGN']))
                echo "value='".$_POST['searchStudentGN']."'";
            ?>required>
        <input class="search-input" type="text" placeholder="Family Name" name="searchStudentFN"
            <?php if(isset($_GET['searchStudentFN']))
                echo "value='".$_GET['searchStudentFN']."'";
            ?> <?php if(isset($_POST['searchStudentFN']))
                echo "value='".$_POST['searchStudentFN']."'";
            ?>required>
        <button type="submit" class="black-button" name="submit" value="Submit">Submit</button>
    </form>

<?php
if(isset($_POST['searchStudentID'],$_POST['searchStudentGN'],$_POST['searchStudentFN']))
{
    ?>
    <h4 class="page-label">View Students having search criteria:
        <?php echo "StudentID: " .$searchStudentID.
                    " Given Name: " .$searchStudentGN.
                    " Family Name: " .$searchStudentFN; ?>
    </h4>

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
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while($row=$search->fetch(PDO::FETCH_ASSOC))
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
                    <td>
                        <a class='dropdown-item' 
                            href='classes_by_student.php?
                            id=".$row['student_id'].
                            "&searchStudentID=".$searchStudentID.
                            "&searchStudentGN=".$searchStudentGN.
                            "&searchStudentFN=".$searchStudentFN."'
                        >View All Classes</a>
                        <a class='dropdown-item' 
                            href='meetings_by_student.php?
                            id=".$row['student_id'].
                            "&searchStudentID=".$searchStudentID.
                            "&searchStudentGN=".$searchStudentGN.
                            "&searchStudentFN=".$searchStudentFN."'
                        >View All Meetings</a>
                    </td>
                    </tr>";
        }
        ?>
        </tbody>
    </table>
    <?php
}
?>


<?php
include('menu/footer.php');
?>