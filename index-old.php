<!DOCTYPE html>
<html>
<head>
    <title>Group Management Information System (GMIS)</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
<!-- navbar -->
<nav class="navbar navbar-transpent fixed-top" >
    <!-- navbar left -->
    <div>
        <ul class="nav justify-content-end ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <li class="nav-item">
                <div class="dropdown">
                    <img src="icon/mune.png" alt="mune bar" class="dropdown-toggle" role="button" id="menue-left" data-bs-toggle="dropdown" aria-expanded="false" width="auto" height="17">
                    <ul class="dropdown-menu dropdown-menu-dark  bg-transparent" aria-labelledby="menue-left">
                        <li><a class="dropdown-item" href="index.html">Home</a></li>
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
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end  bg-transparent" aria-labelledby="menue-right">
                        <li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#hplogin" >Login</a></li>
                    </ul>
                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
            </li>
        </ul>
    </div>
</nav>

<div class="container-fluid p-0">
    <!--background-->
    <div id="homepage-bg-box">
        <img src="img/homepage.jpg"
             id="homepage-bg-img"
             class="img-fluid"
             alt="homepage background" />
    </div>

    <!--About description-->
    <div class="">
        <div class="row">
            <div id="about-us" class="col-10 offset-1">
                <br>
                <br>
                <h3>About us</h3>
                <br>
                <p>GMIS is to provide a method for students to see when, and where, all their out-of-class group project meetings are. It will also allow them to see when group members might be available for an ad hoc meeting. A student will be able to add themselves to a group and enter the group meeting time for each unit. Students will enter their basic information and a photo or picture and either add their group or select from already added groups. </p>
                <br><hr/><br>
            </div>
        </div>
    </div>
</div>

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
                <form id="login-form">
                    <img src="img/login-welcome.png" alt="this is a login welcome picture" width="auto" height="70">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label class="login-input-label" for="floatingInput">UTAS Email</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
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
</body>
</html>