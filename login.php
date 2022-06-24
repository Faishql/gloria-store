<?php

session_start();
require "php/functions/functions.php";

if (isset($_COOKIE["key"]) && isset($_COOKIE["key_name"])) {
    $key = $_COOKIE["key"];
    $key_name = $_COOKIE["key_name"];

    $result = mysqli_query($conn, " SELECT * FROM user WHERE id = '$key'");
    $row = mysqli_fetch_assoc($result);

    if (hash("whirlpool", $row["username"]) === $key_name) {
        $_SESSION["level"] = $row["level"];
    } else {
        echo "
    <script>
      alert('error');
    </script>
    ";
    }
}

if (isset($_SESSION["level"])) {
    if ($_SESSION["level"] == "user") {
        header("Location: index.php");
        exit();
    } elseif ($_SESSION["level"] == "admin") {
        header("Location: admin/index.php");
        exit();
    }
}

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, " SELECT * FROM user WHERE username = '$username'");
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) === 1) {
        if (password_verify($password, $row["password"])) {
            if (isset($_POST["remember"])) {
                setcookie("key", $row["id"], time() + 3600);
                setcookie("key_name", hash("whirlpool", $row["username"]), time() + 3600);
            }
            $_SESSION["level"] = $row["level"];

            if ($_SESSION["level"] === "user") {
                header("Location: index.php");
                exit();
            } elseif ($_SESSION["level"] === "admin") {
                header("Location: admin/index.php");
                exit();
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
    
    <title>GLORIA STORE - LOGIN</title>
  </head>
  <body>
  <div class="login">
          <h1>LOGIN</h1>
          <hr>
          <?php if (isset($error)): ?>
            <p style="color: red; font-style: italic;">username / password is wrong</p>
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
                
                <div class="input-group">
                    <div class="input-group-prepend d-flex justify-content-center align-items-center">
                        <input type="checkbox" name="remember" id="remember" aria-label="Checkbox for following text input">&nbsp;&nbsp;
                        <label for="remember" class="m-0">Remember Me</label>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-secondary mt-5">LOGIN</button>
            </form>
            <p class="mt-4 mb-0 text-center">
              Dont have account yet? <a href="register.php">register</a>
            </p>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>