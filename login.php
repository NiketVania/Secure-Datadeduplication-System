<?php
    require_once 'config.php';

    if(isset($_SESSION['access_token']))
    {
        header('location: index.php');
        exit();
    }

    $loginURL = $gClient->createAuthUrl();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <title>Login</title>
        
        <!-- Bootstrap 4 cdn -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
    </head>
    <body>
        <div class="container" style="margin-top: 100px; background-color: #d1d1e0;">
            <div class="row justify-content-center">
                <div class="col-md-5 col-offset-3" align="center">
                    <form action="process.php" method="post">
                        <h2 style="margin-top: 10px;">Login</h2><br><br>
                        <input type="email" class="form-control" name="email" value="" placeholder="Email" required><br>
                        <input type="password" class="form-control" name="password" value="" placeholder="Password" required><br>
                        <input type="submit"  class="btn btn-primary" name="login" value="Log In"><br><br>
                    </form>

                    <p>-------------------- OR ----------------------</p>
                    <input type="button" class="btn btn-danger" name="loginWithGoogle" onclick="window.location='<?php echo $loginURL; ?>'" value="Log In With Google"><br><br>    

                    <a href="registration.php">New user? Register Here!</a><br><br>
                </div>
            </div>
        </div>
    </body>
</html>
