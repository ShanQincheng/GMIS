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
    $operation=$_POST['operation'];
    $searchText=$_POST['searchText'];
}
if(isset($_GET['searchTxt'],$_GET['search']))
{
    $search=$sectionObj->search($_GET['searchTxt'],$_GET['search']);
    $operation=$_GET['search'];
    $searchText=$_GET['searchTxt'];
}
?>

    <link rel="stylesheet" type="text/css" href="css/search-page.css?version=2">
<div class="visual-space"></div>
<h2 class="page-label">Search</h2>

<form class="page-label" name="search" method="post" action="search.php">
    <input id="search-input" class="search-input" type="text" placeholder="Enter Keyword to search.." name="searchText" <?php if(isset($_GET['searchTxt'])) echo "value='".$_GET['searchTxt']."'"; ?> <?php if(isset($_POST['searchText'])) echo "value='".$_POST['searchText']."'"; ?>required>
    <select name="operation" id="operation-select" required>
        <?php
        $classes='';$groups='';$meetings='';$students='';
        if(isset($_POST['operation']) and $_POST['operation']=='classes') $classes='selected';
        if(isset($_POST['operation']) and $_POST['operation']=='groups') $groups='selected';
        if(isset($_POST['operation']) and $_POST['operation']=='meetings') $meetings='selected';
        if(isset($_POST['operation']) and $_POST['operation']=='students') $students='selected';
        if(isset($_GET['search']) and $_GET['search']=='classes') $classes='selected';
        if(isset($_GET['search']) and $_GET['search']=='groups') $groups='selected';
        if(isset($_GET['search']) and $_GET['search']=='meetings') $meetings='selected';
        ?>
        <option value="" >Select an operation..</option>
        <option value="classes" <?php echo $classes; ?>>Classes</option>
        <option value="groups" <?php echo $groups; ?>>Groups</option>
        <option value="meetings" <?php echo $meetings; ?>>Meetings</option>
    </select>
    <button id="search-btn" type="submit" class="black-button" name="submit" value="Submit">Submit</button>
</form>

<?php
if(isset($_POST['searchText'],$_POST['operation']) || isset($_GET['search'],$_GET['searchTxt']))
{
    if($operation=='classes')
    {
        ?>
        <h4 class="page-label">View Classes having search criteria: <?php echo $searchText; ?></h4>

        <table>
            <thead>
                <tr>
                    <th>Class ID</th>
                    <th>Group ID</th>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Room</th>
                    <th>Actions</th>
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
                        <td><a class='dropdown-item' href='groups_by_class.php?id=".$row['class_id']."&searchText=".$searchText."'>View All Groups</a></td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
        <?php
    }
    elseif($operation=='groups')
    {
        ?>
        <h4 class="page-label">View Groups having search criteria: <?php echo $searchText; ?></h4>

        <table>
            <thead>
                <tr>
                    <th>Group ID</th>
                    <th>Group Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row=$search->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "
                        <tr>
                        <td>".$row['group_id']."</td>
                        <td>".$row['group_name']."</td>
                        <td><a class='dropdown-item' href='students_by_group.php?id=".$row['group_id']."&searchText=".$searchText."'>View All Students</a></td>
                        </tr>";
                    }
                ?>
            </tbody>
        </table>
        <?php
    }
    elseif($operation=='meetings')
    {
        ?>
        <h4 class="page-label">View Meetings having search criteria: <?php echo $searchText; ?></h4>

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
}
?>

<script type="text/javascript">
    let selectAttribute = document.getElementById('operation-select');
    let searchBtn = document.getElementById('search-btn');

    searchBtn.addEventListener('click', function () {
        if(selectAttribute.value == "classes")
        {
            let searchInput = document.getElementById('search-input');

            searchInput.setAttribute("pattern", "\\d{4,10}");
            searchInput.setAttribute("title", "Student Classes has to be at least 4 digits");
        } else {
            let searchInput = document.getElementById('search-input');
            searchInput.removeAttribute("pattern");
            searchInput.removeAttribute("title");
        }
    })
</script>


<?php
include('menu/footer.php');
?>