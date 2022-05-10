<?php
	include("dbConfig/config.php");
	include("dbConfig/functions.php");
    $sectionObj=new sectionClass();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Group Management Information System (GMIS)</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/table.css">
</head>

<body>
<!-- navbar -->
<nav id="header-nav-bar" class="navbar navbar-transpent fixed-top" >
    <!-- navbar left -->
    <div>
        <ul class="nav justify-content-end ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="nav-item">
                <div class="dropdown">
                    <img src="icon/mune.png" alt="mune bar" class="dropdown-toggle" role="button" id="menue-left" data-bs-toggle="dropdown" aria-expanded="false" width="auto" height="17">
                    <ul class="dropdown-menu dropdown-menu-dark  bg-black" aria-labelledby="menue-left">
                        <li><a class="dropdown-item" href="index.php" >Home</a></li>
                        <?php
                        if ($sectionObj->isLoggedIn()==1 and $_SESSION['category']=='Masters')
                        { ?>
                        <li><a class="dropdown-item" href="groups.php" <?php if($page=='groups') echo 'class="active"'; ?>>Groups</a></li>
                        <li><a class="dropdown-item" href="students.php" <?php if($page=='students') echo 'class="active"'; ?>>Students</a></li>
                        <li><a class="dropdown-item" href="classes.php" <?php if($page=='classes') echo 'class="active"'; ?>>Classes</a></li>
                        <li><a class="dropdown-item" href="meetings.php" <?php if($page=='meetings') echo 'class="active"'; ?> >Meetings</a></li>
                        <li><a class="dropdown-item" href="search.php" <?php if($page=='search') echo 'class="active"'; ?>>Search</a></li>
                        <li><a class="dropdown-item" href="search-student-privacy.php" <?php if($page=='search-student-privacy') echo 'class="active"'; ?>>Student Details Search</a></li>
                        <?php }
                        elseif($sectionObj->isLoggedIn()==1 and $_SESSION['category']=='Bachelors')
                         { ?> 
                        <li><a class="dropdown-item" href="search.php" <?php if($page=='search') echo 'class="active"'; ?>>Search</a></li>
                        <li><a class="dropdown-item" href="search-student-privacy.php" <?php if($page=='search-student-privacy') echo 'class="active"'; ?>>Student Details Search</a></li>
                        <?php }
                        ?>
                    </ul>&nbsp;
                </div>&nbsp;
            </li>
            <li class="nav-item">
                <a><img src="img/utas-logo.png" alt="this is a utas logo" width="auto" height="30" ></a>
            </li>
        </ul>
    </div>
    <!-- navbar right -->
    <div>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <div class="dropdown">
                    <img src="icon/user.png" alt="this is a user icon" class="dropdown-toggle" role="button" id="menue-right" data-bs-toggle="dropdown" aria-expanded="false" width="auto" height="17">
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end  bg-black" aria-labelledby="menue-right">
                      <?php
                        if($sectionObj->isLoggedIn()==1)
                        {
                      ?>
                        <li><a class="dropdown-item"><?php echo $_SESSION['given_name']." ".$_SESSION['family_name'];?></a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        <?php 
                        } 
                        else
                        { ?>
                        <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#hplogin" >Login</a></li>
                        <?php } ?>
                    </ul>
                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
            </li>
        </ul>
    </div>
</nav>



<br>
<br>

<!--login modal-->
<div class="modal" id="hplogin">
    <div class="modal-dialog modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <!-- Modal Body -->
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <!-- Form -->
                <form id="login-form" method="post" action="login.php">
                    <img src="img/login-welcome.png" alt="this is a login welcome picture" width="auto" height="70">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                        <label class="login-input-label" for="floatingInput">UTAS Email</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                        <label class="login-input-label" for="floatingPassword">Password</label>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-dark rounded-pill ">Login</button>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<div id="header-tail-space"></div>