<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "");

    // if ($conn) {
    //     echo "Not connected.";
    // }

    if (isset($_POST['register'])) 
    {
        $username = test_input($_POST['rusername']); 
        $useremail = test_input($_POST['remail']);
        $password = $_POST['rpassword'];
        $phone = $_POST['rphone'];
        $designation = $_POST['designation'];
        $uploadquota = 0;
        $verify_email = 0;

        // we can also use this to hash and dehash passwords
        // $input = "test123";
        // $hashpasswd = password_hash($input, PASSWORD_DEFAULT);
        // password_verify($input, $hashpasswd); this will give boolean result
        $password = md5($password); // md5 hash of password

        // quota limit according to user type
        if ($designation === "Student") 
            $uploadquota = 100;
        else
            $uploadquota = 200;

    
        mysqli_select_db($conn, "securedatadeduplication");
        $insert_sql = "insert into user_info(username, email, password, phone_number, designation, verified, upload_quota_MB) values('$username','$useremail', '$password', $phone, '$designation', $verify_email, $uploadquota);";
        if (!(mysqli_query($conn,$insert_sql)))
            echo "insert failed";
        else
        {    
            echo "data inserted.";
            // send mail and verify account   
            echo "<br>Verify your account by email sent to your email id.";
            $to_email = $useremail; $_SESSION['toemail'] = $to_email; $_SESSION['username'] = $username;
            $from_email = "ssecuredatadeduplication@gmail.com";
            $subject = "Activation link For SDD webapplication.";
            $message = "Please, <a href='http://localhost/SecureDataDeduplication/index.php?email=$to_email'>Click Here</a> to verify your account.";
            $headers = "From:".$from_email;
            mail($to_email,$subject,$message,$headers);
            // header("location:index.php");
        } 
    }

    // sanitizes user inputs
    function test_input($data)
    {
        $data = trim($data); // removes whitespace and other predefined characters from both sides of a string
        $data = stripslashes($data); // removes backslashes from input
        $data = htmlspecialchars($data); // special characters to HTML entities
        return $data;
    }

    if (isset($_POST['login'])) 
    {
        $username = '';
        $useremail = $_POST['email'];
        $userpassword = $_POST['password'];
        $userpassword = md5($userpassword);
        // $flag = 0;

        $_SESSION['email'] = $useremail;
        $_SESSION['password'] = $userpassword;
        // $_SESSION['simpleFlag'] = $flag;
        
        mysqli_select_db($conn, "securedatadeduplication");
        $login_sql = "select * from user_info where email='$useremail' and password='$userpassword'";
        $result = mysqli_query($conn, $login_sql);

        if(!$result)
        {
            echo "Login failed! Invalid details entered.";
        }

        // fetch username and email from database    
        else
        {
            if(mysqli_num_rows($result)>0)
            {
                while ($row = mysqli_fetch_assoc($result)) 
                {
                    $username = $row['username'];
                    // $useremail = $row['email'];
                }
                $_SESSION['username'] = $username;
            }
            header('location:index.php');
        }
    }
?>
