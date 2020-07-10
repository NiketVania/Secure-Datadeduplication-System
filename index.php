<?php
    session_start();

    // this code only works for google signin, if user register the token won't be generated 
    // and he stuck in infinite loop of login page

    // if(!isset($_SESSION['access_token']))
    // {
    //     header('location: login.php');
    //     exit();
    // }
    

    // verify user account
    if(isset($_REQUEST['email']))
    {
        $to_email = $_REQUEST['email'];
        $conn = mysqli_connect("localhost", "root", "");
        mysqli_select_db($conn, "securedatadeduplication");
        if(mysqli_query($conn,"update user_info set verified=1 where email='$to_email'"))
        {
            echo "Account verified.";
        }   
        else
            echo "Account verification failed.";
    }       
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <!-- scaling for smaller devices -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Index</title>

        <!-- Bootstrap 4 cdn -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- link of the css file for index page -->
        <link rel="stylesheet" type="text/css" href="index_design.css">

        <script>
            function openNav() {
              document.getElementById("mySidenav").style.width = "20%";
              document.getElementById("main").style.marginLeft = "20%";
            }

            function closeNav() {
              document.getElementById("mySidenav").style.width = "0";
              document.getElementById("main").style.marginLeft= "0";
            }

            // $(document).ready(function(){
            //     $("#hamburger").click(function(){
            //         $("#hamburger").hide();
            //     });
            // });
        </script>
    
    </head>

    <body>

        <!-- container class -->
        <!-- <div class="container" style="margin-top: 10px;"> -->

            <!-- verical navbar -->
           <!--  <nav class="navbar bg-dark navbar-dark" style="align-content: left; width: 25%;"> -->
               <!-- Links -->
              <!--   <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registration.php">Register</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul> -->
            <!-- </nav><br> -->
            <!-- end navbar -->


        <!-- Side navigation -->
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <a href="index.php" class="active" target="_self" style="color: white;">Home</a>
            <a href="profile.php" target="_self">Profile</a>
            <!-- <a href="login.php" target="_self">Login</a>
            <a href="registration.php" target="_self">Register</a> -->
            <a href="view.php" target="_self">Show Uploaded Files</a>
            <a href="logout.php" target="_self">Logout</a>
        </div>


        <div class="main" id="main">
            <span id="hamburger" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span><br>
            <h4>Welcome! <?php echo $_SESSION['username'] . ", " . $_SESSION['email']; ?> </h4><br>

            
            <!-- upload file -->
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label style="font-size: 18px">Upload File</label>
                <div class="form-inline" >
                    <input type="file" class="form-control col-md-5 col-offset-3" name="file"><br>
                    <button type="submit" style='margin-left: 10px;' class="btn btn-primary" name="upload">Upload</button>    
                </div>
            </form><br>
            

            <!-- Show uploaded files -->
            <form method="post" action="view.php">
                <button type="submit" class="btn btn-primary" name="showUploadedFiles">Show Uploaded Files</button>
            </form><br>


            <!-- logout button -->
            <form action="logout.php" method="post">
                <button type="submit" class="btn btn-primary" name="logout">Logout</button>
            </form><br>
        </div>
       <!--  </div> -->
        <!-- end container -->

    </body>
</html>
