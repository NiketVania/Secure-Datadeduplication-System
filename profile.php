<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    
    <!-- scaling for smaller devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap 4 cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

    <div class="container" style="margin-top: 20px;">
        
        <?php
            $conn = mysqli_connect("localhost", "root", "");
            mysqli_select_db($conn, "securedatadeduplication");
            $username = $_SESSION['username'];
            $profile = "select email, phone_number, designation, verified from user_info where username='$username'";
            $result = mysqli_query($conn, $profile);

            if (!$result) 
               echo "Something went wrong!";
                
            else
            { 
                if(mysqli_num_rows($result) > 0)
                {
                    echo "<div class='card'>";
                    echo "<center><img src='user1.png' width='250px' height='250px' alt='Image not found'></center>";
                    echo "<div class='card-body'>
                            <h4 class='card-title'>Username: $username</h4>
                            <table class='table table-bordered table-hover'>
                                <thead class='thead-light'><tr>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Designation</th>
                                    <th>Verify</th>
                                </tr></thead> ";
                
                    while($row = mysqli_fetch_assoc($result)) 
                    {
                        echo "<tbody><tr>
                                <td>" . $row['email'] . "</td>
                                <td>" . $row['phone_number'] . "</td>
                                <td>" . $row['designation'] . "</td>
                                <td>" . $row['verified'] . "</td>
                            </tr></tbody></table>";
                        echo "</div>";
                    }
                    echo "</div>"; // <div class='card'> end
                }
            }
        ?>    
    </div>
    <!-- end Show file data from table  -->
</body>
</html>    
