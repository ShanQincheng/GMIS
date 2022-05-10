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
        if($email=='nadineb2@utas.edu.au' and $password=='nadine')
        {
            $_SESSION['student_id']="625157";
            $_SESSION['given_name']="Nadine";
            $_SESSION['family_name']="Baadarani";
            $_SESSION['group_id']="23";
            $_SESSION['title']="Mrs";
            $_SESSION['campus']="Hobart";
            $_SESSION['phone']="0493423101";
            $_SESSION['email']="nadineb2@utas.edu.au";
            $_SESSION['category']="Masters";
            return 1;
        }
        elseif($email=='zhe4@utas.edu.au' and $password=='zhe4')
        {
            $_SESSION['student_id']="123456";
            $_SESSION['given_name']="Zhenglin";
            $_SESSION['family_name']="He";
            $_SESSION['group_id']="23";
            $_SESSION['title']="Mr";
            $_SESSION['campus']="Hobart";
            $_SESSION['phone']="0493423101";
            $_SESSION['email']="zhe4@utas.edu.au";
            $_SESSION['category']="Bachelors";
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
            $query="SELECT * from ".$dbname.".".$tbmeeting." where meeting_id LIKE '%".$searchText."%' "; 
        }
        elseif($operation=='groups')
        {
            $query="SELECT * from ".$dbname.".".$tbstudentGroup." where group_id LIKE '%".$searchText."%' "; 
        }
        elseif($operation=='classes')
        {
            $query="SELECT * from ".$dbname.".".$tbclass." where class_id LIKE '%".$searchText."%' "; 
        }
        elseif($operation=='students')
        {
            $query="SELECT * from ".$dbname.".".$tbstudent." where student_id LIKE '%".$searchText."%' OR given_name LIKE '%".$searchText."%' OR family_name LIKE '%".$searchText."%' "; 
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

    function viewClassesByStudent($student_id)
    {
        global $dbhost,$dbname,$dbuname,$dbpassword,$tbclass,$tbstudent;
        $conn=$this->dbConnect($dbhost,$dbuname,$dbpassword,$dbname);

        $query="SELECT A.*,B.given_name, B.family_name from ".$dbname.".".$tbclass." A, ".$dbname.".".$tbstudent." B where B.group_id=A.group_id and B.student_id=:studentId order by class_id ";
        // echo $query;exit;
        try
        {
            $viewClassesByStudent=$conn->prepare($query);
            $viewClassesByStudent->bindParam(":studentId",$student_id);
            $viewClassesByStudent->execute();
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit();
        }
        $conn=$this->dbDisconnect();
        return $viewClassesByStudent;
    }

    function getStudentDetails($student_id)
    {
        global $dbhost,$dbname,$dbuname,$dbpassword,$tbstudent;
        $conn=$this->dbConnect($dbhost,$dbuname,$dbpassword,$dbname);

        $query="SELECT given_name, family_name from ".$dbname.".".$tbstudent." where student_id=:studentId ";
        // echo $query;exit;
        try
        {
            $getStudentDetails=$conn->prepare($query);
            $getStudentDetails->bindParam(":studentId",$student_id);
            $getStudentDetails->execute();
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit();
        }
        $conn=$this->dbDisconnect();
        return $getStudentDetails;
    }

    function viewMeetingsByStudent($student_id)
    {
        global $dbhost,$dbname,$dbuname,$dbpassword,$tbmeeting,$tbstudent;
        $conn=$this->dbConnect($dbhost,$dbuname,$dbpassword,$dbname);

        $query="SELECT A.*,B.given_name, B.family_name from ".$dbname.".".$tbmeeting." A, ".$dbname.".".$tbstudent." B where B.group_id=A.group_id and B.student_id=:studentId order by meeting_id ";
        try
        {
            $viewMeetingsByStudent=$conn->prepare($query);
            $viewMeetingsByStudent->bindParam(":studentId",$student_id);
            $viewMeetingsByStudent->execute();
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit();
        }
        $conn=$this->dbDisconnect();
        return $viewMeetingsByStudent;
    }

    function viewStudentsbyGroup($group_id)
    {
        global $dbhost,$dbname,$dbuname,$dbpassword,$tbstudent;
        $conn=$this->dbConnect($dbhost,$dbuname,$dbpassword,$dbname);

        $query="SELECT * from ".$dbname.".".$tbstudent." where group_id=:groupId order by student_id ";
        try
        {
            $viewStudentsbyGroup=$conn->prepare($query);
            $viewStudentsbyGroup->bindParam(":groupId",$group_id);
            $viewStudentsbyGroup->execute();
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit();
        }
        $conn=$this->dbDisconnect();
        return $viewStudentsbyGroup;
    }

    function viewGroupsbyClass($class_id)
    {
        global $dbhost,$dbname,$dbuname,$dbpassword,$tbstudentGroup,$tbclass;
        $conn=$this->dbConnect($dbhost,$dbuname,$dbpassword,$dbname);

        $query="SELECT B.* from ".$dbname.".".$tbclass." A, ".$dbname.".".$tbstudentGroup." B where A.group_id=B.group_id and A.class_id=:classId order by A.group_id ";
        try
        {
            $viewGroupsbyClass=$conn->prepare($query);
            $viewGroupsbyClass->bindParam(":classId",$class_id);
            $viewGroupsbyClass->execute();
        }
        catch(PDOException $e)
        {
            print($e->getMessage());
            exit();
        }
        $conn=$this->dbDisconnect();
        return $viewGroupsbyClass;
    }
}

?>