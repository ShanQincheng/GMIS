<?php

class sectionClass
{
    function dbConnect($dbhost,$dbuname,$dbpassword,$dbname)
    {
        try
        {
            $conn=new PDO('mysql:host='.$dbhost.';dbname='.$dbname.';charset=utf8',$dbuname,$dbpassword);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit;
        }
        return $conn;
    }

    function dbDisconnect()
    {
        return $conn=NULL;
    }

    function isLoggedIn()
    {
        if(isset($_SESSION['student_id']))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    function login($email,$password)
    {
        global $dbhost,$dbname,$dbuname,$dbpassword,$tbuserAccess,$tbstudent;
        $conn=$this->dbConnect($dbhost,$dbuname,$dbpassword,$dbname);

        $password=md5($password);

        $query="SELECT B.* FROM ".$dbname.".".$tbuserAccess." A, ".$dbname.".".$tbstudent." B where A.student_id=B.student_id and A.email=:email and A.password=:password";  
        try
        {
            $login=$conn->prepare($query);
			$login->bindParam(":email",$email);
            $login->bindParam(":password",$password);
            $login->execute();
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit;
        }      
        $count = $login->rowCount();
        if($count==1)
        {
            $row=$login->fetch(PDO::FETCH_ASSOC);
            $_SESSION['student_id']=$row['student_id'];
            $_SESSION['given_name']=$row['given_name'];
            $_SESSION['family_name']=$row['family_name'];
            $_SESSION['group_id']=$row['group_id'];
            $_SESSION['title']=$row['title'];
            $_SESSION['campus']=$row['campus'];
            $_SESSION['phone']=$row['phone'];
            $_SESSION['email']=$row['email'];
            $_SESSION['photo']=$row['photo'];
            $_SESSION['category']=$row['category'];
            return 1;
        }
        else
        {
            return 0;
        }
    }

    function loginHardCode($email,$password) {
        $userCredentials = array(
            "nadineb2@utas.edu.au" => "8f5c853566391602f1a56b305e1d9cd5",
            "bachelor@utas.edu" => "c2b7dae3df98550763dfaa494e550aeb",
        );
        $password=md5($password);

        if (!array_key_exists($email, $userCredentials)) {
            return  0;
        }

        $correctPassword = $userCredentials[$email];
        if ($password !== $correctPassword) {
            return 0;
        }

        global $dbhost,$dbname,$dbuname,$dbpassword,$tbuserAccess,$tbstudent;
        $conn=$this->dbConnect($dbhost,$dbuname,$dbpassword,$dbname);


        $query="SELECT * FROM ".$dbname.".".$tbstudent." where email=:email";
        try
        {
            $login=$conn->prepare($query);
            $login->bindParam(":email",$email);
            $login->execute();
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit;
        }
        $count = $login->rowCount();
        if($count==1)
        {
            $row=$login->fetch(PDO::FETCH_ASSOC);
            $_SESSION['student_id']=$row['student_id'];
            $_SESSION['given_name']=$row['given_name'];
            $_SESSION['family_name']=$row['family_name'];
            $_SESSION['group_id']=$row['group_id'];
            $_SESSION['title']=$row['title'];
            $_SESSION['campus']=$row['campus'];
            $_SESSION['phone']=$row['phone'];
            $_SESSION['email']=$row['email'];
            $_SESSION['photo']=$row['photo'];
            $_SESSION['category']=$row['category'];
            return 1;
        }
        else
        {
            return 0;
        }

    }

    function getAllStudents()
    {
        global $dbhost,$dbname,$dbuname,$dbpassword,$tbstudent;
        $conn=$this->dbConnect($dbhost,$dbuname,$dbpassword,$dbname);

        $query="SELECT * from ".$dbname.".".$tbstudent." order by student_id ";
        try
        {
            $getAllStudents=$conn->prepare($query);
            $getAllStudents->execute();
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit();
        }
        $conn=$this->dbDisconnect();
        return $getAllStudents;
    }

    function getAllGroups()
    {
        global $dbhost,$dbname,$dbuname,$dbpassword,$tbstudentGroup,$tbstudent;
        $conn=$this->dbConnect($dbhost,$dbuname,$dbpassword,$dbname);

        $query="SELECT * from ".$dbname.".".$tbstudentGroup." order by group_id ";
        try
        {
            $getAllGroups=$conn->prepare($query);
            $getAllGroups->execute();
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit();
        }
        $conn=$this->dbDisconnect();
        return $getAllGroups;
    }

    function getAllClasses()
    {
        global $dbhost,$dbname,$dbuname,$dbpassword,$tbclass;
        $conn=$this->dbConnect($dbhost,$dbuname,$dbpassword,$dbname);

        $query="SELECT * from ".$dbname.".".$tbclass." order by class_id ";
        try
        {
            $getAllClasses=$conn->prepare($query);
            $getAllClasses->execute();
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit();
        }
        $conn=$this->dbDisconnect();
        return $getAllClasses;
    }

    function getAllMeetings()
    {
        global $dbhost,$dbname,$dbuname,$dbpassword,$tbmeeting;
        $conn=$this->dbConnect($dbhost,$dbuname,$dbpassword,$dbname);

        $query="SELECT * from ".$dbname.".".$tbmeeting." order by meeting_id ";
        try
        {
            $getAllMeetings=$conn->prepare($query);
            $getAllMeetings->execute();
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit();
        }
        $conn=$this->dbDisconnect();
        return $getAllMeetings;
    }

    function search($searchText,$operation)
    {
        global $dbhost,$dbname,$dbuname,$dbpassword,$tbclass,$tbmeeting,$tbstudent,$tbstudentGroup;
        $conn=$this->dbConnect($dbhost,$dbuname,$dbpassword,$dbname);

        if($operation=='meetings')
        {
            $query="SELECT * from ".$dbname.".".$tbmeeting." where meeting_id LIKE '%".$searchText."%' OR group_id LIKE '%".$searchText."%' OR day LIKE '%".$searchText."%' OR start LIKE '%".$searchText."%' OR end LIKE '%".$searchText."%' OR room LIKE '%".$searchText."%' "; 
        }
        elseif($operation=='groups')
        {
            $query="SELECT * from ".$dbname.".".$tbstudentGroup." where group_id LIKE '%".$searchText."%' OR group_name LIKE '%".$searchText."%' "; 
        }
        elseif($operation=='classes')
        {
            $query="SELECT * from ".$dbname.".".$tbclass." where class_id LIKE '%".$searchText."%' OR group_id LIKE '%".$searchText."%' OR day LIKE '%".$searchText."%' OR start LIKE '%".$searchText."%' OR end LIKE '%".$searchText."%' OR room LIKE '%".$searchText."%' "; 
        }
        elseif($operation=='students')
        {
            $query="SELECT * from ".$dbname.".".$tbstudent." where student_id LIKE '%".$searchText."%' OR given_name LIKE '%".$searchText."%' OR family_name LIKE '%".$searchText."%' OR group_id LIKE '%".$searchText."%' OR title LIKE '%".$searchText."%' OR campus LIKE '%".$searchText."%' OR phone LIKE '%".$searchText."%' OR email LIKE '%".$searchText."%' OR category LIKE '%".$searchText."%' "; 
        }

        try
        {
            $searchResult=$conn->prepare($query);
            $searchResult->execute();
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit();
        }
        $conn=$this->dbDisconnect();
        return $searchResult;
    }

    function getAllClassByStudent($studentID) {
        global $dbhost,$dbname,$dbuname,$dbpassword,$tbstudentClassGroup;
        $conn=$this->dbConnect($dbhost,$dbuname,$dbpassword,$dbname);

        $query="SELECT class_id from ".$dbname.".".$tbstudentClassGroup." where student_id = $studentID ";
        try
        {
            $allClasses=$conn->prepare($query);
            $allClasses->execute();
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit();
        }
        $this->dbDisconnect();
        return $allClasses;
    }

    function getAllClassByGroupID($groupID) {
        global $dbhost,$dbname,$dbuname,$dbpassword,$tbclass;
        $conn=$this->dbConnect($dbhost,$dbuname,$dbpassword,$dbname);

        $query="SELECT * from ".$dbname.".".$tbclass." where group_id = $groupID ";
        try
        {
            $allClasses=$conn->prepare($query);
            $allClasses->execute();
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit();
        }
        $this->dbDisconnect();
        return $allClasses;
    }

    function getAllMeetingsByClassAndGroup($classID, $groupID) {
        global $dbhost,$dbname,$dbuname,$dbpassword,$tbmeeting;
        $conn=$this->dbConnect($dbhost,$dbuname,$dbpassword,$dbname);

        $query="SELECT meeting_id from ".$dbname.".".$tbmeeting." where class_id = $classID and group_id = $groupID ";
        try
        {
            $allMeetings=$conn->prepare($query);
            $allMeetings->execute();
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit();
        }
        $this->dbDisconnect();
        return $allMeetings;
    }

    function getClassTime($classID) {
        global $dbhost,$dbname,$dbuname,$dbpassword,$tbclass;
        $conn=$this->dbConnect($dbhost,$dbuname,$dbpassword,$dbname);

        $query="SELECT day, start, end from ".$dbname.".".$tbclass." where class_id = $classID";
        try
        {
            $classTime=$conn->prepare($query);
            $classTime->execute();
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit();
        }
        $this->dbDisconnect();
        return $classTime;
    }

    function getMeetingTime($meetingID) {
        global $dbhost,$dbname,$dbuname,$dbpassword,$tbmeeting;
        $conn=$this->dbConnect($dbhost,$dbuname,$dbpassword,$dbname);

        $query="SELECT day, start, end from ".$dbname.".".$tbmeeting." where meeting_id = $meetingID";
        try
        {
            $meetingTime=$conn->prepare($query);
            $meetingTime->execute();
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit();
        }
        $this->dbDisconnect();
        return $meetingTime;
    }
}

?>