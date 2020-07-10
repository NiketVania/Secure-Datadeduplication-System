<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Files</title>
    
    <!-- Bootstrap 4 cdn -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

    <div class="container" style="margin-top: 20px;">
        
        <!-- Show file data from table  -->   
        <?php
            $conn = mysqli_connect("localhost", "root", "");
            mysqli_select_db($conn, "securedatadeduplication");
            $owner = $_SESSION['username'];
            $file_display = "select fileowner, filename, extension, location from user_file_management where fileowner='$owner'";
            $result = mysqli_query($conn, $file_display);

            if (!$result) 
               echo "Something went wrong!";
                
            else
            { 
                if(mysqli_num_rows($result)>0)
                {
                    echo "<table class='table table-bordered table-hover'>";
                    echo "<thead class='thead-dark'><tr>
                        <th>Username</th>
                        <th>Filename</th>
                        <th>File Extension</th>
                        <th>File Location</th>
                        </tr></thead>" . "<br>";
                
                    while($row = mysqli_fetch_assoc($result)) 
                    {
                        echo "<tbody><tr>
                            <td>" . $row['fileowner'] . "</td>" .
                            "<td>" . $row['filename'] . "</td>" .
                            "<td>" . $row['extension'] . "</td>" .
                            "<td>" . $row['location'] . "</td>" .
                            "</tr></tbody>" . "<br>";
                    }
                    echo "</table>";
                }
            }
        ?>    
    </div>
    <!-- end Show file data from table  -->
</body>
</html>    
