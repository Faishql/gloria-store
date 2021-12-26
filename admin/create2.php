<?php

require '../php/functions/functions.php';

if ( isset( $_POST['submit'])) {
   
  if ( create($_POST) > 0) {
    echo "
      <script>
        alert('success');
      </script>
    ";
  } else {
    echo "
      <script>
        alert('failed');
      </script>
    ";
  }
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
  
  <div class="container create mt-5">
    <a href="index.php" class="btn btn-secondary float-right">Back</a>
    <div class="clear" style="clear: both;"></div>
        <div class="wrapper mt-3">
          <h1>ADD PRODUCT</h1>
          <hr>
            <form action="" method="post" enctype="multipart/form-data" class="mt-5" autocomplete="off">
                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="name" required>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" class="form-control" id="price" placeholder="price" required>
                </div>
                <div class="form-group">
                    <label for="image">Products Photo</label>
                    <input type="file" name="img" class="form-control" id="image" placeholder="image">
                </div>
                <div class="form-group">
                    <label for="desc">Desc</label>
                    <textarea type="text" name="desc" class="form-control" id="desc" placeholder="desc" required></textarea>
                </div>
                
                <button type="submit" name="submit" class="btn btn-secondary mt-5">SUBMIT</button>
            </form>
        </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>