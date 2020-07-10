<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <title>Registration</title>
        
        <!-- Bootstrap 4 cdn -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    </head>
    <body>
        <div class="container" style="margin-top: 50px; background-color: #d1d1e0;">
            <div class="row justify-content-center">
                <div class="col-md-5 col-offset-3" align="center">
                    <form action="process.php" method="post">
                        <h2 style="margin-top: 10px;">Sign Up</h2><br><br>
                        <input type="text" class="form-control" name="rusername" value="" placeholder="Username" required><br>
                        <input type="email" class="form-control" name="remail" value="" placeholder="Email" required><br>
                        <input type="password" class="form-control" name="rpassword" value="" placeholder="Password" required><br>
                        <input type="number" class="form-control" name="rphone" value="" placeholder="Phone Number"><br> 
                        
                        <label>Designation: </label>
                        <input type="radio" id="student" name="designation" value="Student" required>
                        <label for="student">Student</label>
                        <input type="radio" id="faculty" name="designation" value="Faculty" required>
                        <label for="faculty">Faculty</label><br><br>
                        
                        <input type="submit"  class="btn btn-primary" name="register" value="Register"><br><br>
                    </form>

                    <a href="login.php">Already a user? Login Here!</a><br><br>
                </div>
            </div>
        </div>
    </body>
</html>
