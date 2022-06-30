<?php

session_start();

require "php/functions/functions.php";

if (!isset($_SESSION["level"]) || !isset($_GET["total"])) {
    header("Location: login.php");
}

// var_dump($_GET["carts"]);
// die();
$carts = getCarts();

if (isset($_POST["submit_back"])) {
    if (clearCart($_POST) > 0) {
        header("Location: index.php");
    } else {
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style/index.css">


    <title>Gloria Store - Checkout</title>
</head>
<body>
    <div class="checkout col-md-6">
    <h2>Order Details</h2>
    <table class="table mt-4">
    <thead class="thead-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Product Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($carts as $cart): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $cart["product_name"] ?></td>
            <td><?= $cart["quantity"] ?></td>
            <td><?= $cart["price"] ?>K</td>
            
        </tr>
        <?php endforeach;
        ?>
        <tr>
        <td colspan="2"></td>
        <td>Total</td>
        <td>IDR <?= decryptTb($_GET["total"]) ?>K</td>
        </tr>
    </tbody>
    </table>
    <form action="" method="post">
        <input type="hidden" class="form-control" name="id_user" value="<?= $_SESSION["id"] ?>" required>
        <button href="index.php" class="back" name="submit_back" name="submit_back">Back</button>
    </form>
    <div class="w-100 mt-5">
    <p><strong>Thanks </strong>for take a look this far. also check my portfolio here's the link <a href="https://faishal.netlify.app" style="text-decoration: underline;">Faishal 2022</a></p>
    </div>
    </div>
</body>
</html>