<?php

session_start();

if ( isset($_SESSION['level'])) {
  
  if ( $_SESSION['level'] === 'user') {
    header('Location: index.php');
    exit;
  } else if ( $_SESSION['level'] === 'admin') {
    header('Location: admin/index.php');
    exit;
  } 
  
}

require 'php/functions/functions.php';

if ( isset($_POST['submit'])) {

  $username = $_POST['username'];
  $password = $_POST['password'];
  $password2 = $_POST['password2'];

  $result = mysqli_query( $conn, " SELECT * FROM user WHERE username = '$username'");

  if ( !$fetch = mysqli_fetch_assoc($result)) {
      
    if ( $password === $password2) {

        $password = password_hash( $password, PASSWORD_DEFAULT);

        mysqli_query( $conn, "INSERT INTO user VALUES( '', '$username', '$password', 'user', NOW())");
        
        if ( mysqli_affected_rows($conn) > 0 ) {
          echo "
            <script>
              alert('success');
            </script>
          ";
          header('Location: login.php');
        }
        
    }
  }

    $error = true;

}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style/index.css">
    
    <title>Hello, world!</title>
  </head>
  <body>
  <div class="login">
          <h1>REGISTER</h1>
          <hr>
          <?php if ( isset($error) ) : ?>
            <p style="color: red; font-style: italic;">username is already user / password is wrong</p>
          <?php endif; ?>
            <form action="" method="post" class="mt-5">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="username">
                </div>
                <div class="form-group">
                    <label for="password">Password</label> 
                    <input type="password" name="password" class="form-control" id="password" placeholder="password">
                </div>
                <div class="form-group">
                    <label for="password2">Password</label> 
                    <input type="password" name="password2" class="form-control" id="password2" placeholder="password">
                </div>
                <button type="submit" name="submit" class="btn btn-secondary mt-5">REGISTER</button>
            </form>

      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>