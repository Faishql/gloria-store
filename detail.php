<?php

session_start();

require "php/functions/functions.php";
require_once "Flasher.php";

$id = decryptTb($_GET["id_product"]);
$product = read(" SELECT * FROM products WHERE id = $id");

if (isset($_SESSION["level"])) {
    $id_user = $_SESSION["id"];

    if (isset($_POST["submit_cart"])) {
        if (addCart($_POST) === "too much") {
            $_POST = [];
            Flasher::setFlash("item in cart is", "too much", "warning");
        } elseif (addCart($_POST) > 0) {
            $_POST = [];
            Flasher::setFlash("item added", "successfully", "secondary");
        } else {
            $_POST = [];
            Flasher::setFlash("Item failed", "to add", "danger");
        }
    }

    if (isset($_POST["delete-cart"])) {
        if (delCart($_POST) > 0) {
            Flasher::setFlash("Item berhasil", "dihapus", "secondary");
        } else {
            Flasher::setFlash("Item gagal", "dihapus", "danger");
        }
        $_POST = [];
    }

    $carts = getCarts();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />

        <!-- CSS Link -->
        <link rel="stylesheet" href="style/index.css" />

        <style>
            .modal.left .modal-dialog {
                position:fixed;
                right: 0;
                margin: auto;
                width: 80%;
                height: 100%;
                /* -webkit-transform: translate3d(0%, 0, 0);
                -ms-transform: translate3d(0%, 0, 0);
                -o-transform: translate3d(0%, 0, 0); */
                transform: translate3d(0%, 0, 0);
            }

            .modal.left .modal-content {
                height: 100%;
                overflow-y: auto;
            }

            .modal.right .modal-body {
                padding: 15px 15px 80px;
            }

            .modal.right.fade .modal-dialog {
                left: -80%;
                /* -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
                -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
                -o-transition: opacity 0.3s linear, left 0.3s ease-out; */
                transition: opacity 0.3s linear, left 0.3s ease-out;
            }

            .modal.right.fade.show .modal-dialog {
                right: 0;
            }

            /* ----- MODAL STYLE ----- */
            .modal-content {
                border-radius: 0;
                border: none;
            }
            .modal-open{
                overflow:auto;
                padding-right:0 !important;
            }
            /* nav { 
                overflow:auto;
                padding-right:0 !important;
                margin: 0 auto !important;
            } */
        </style>
        

        <title>Gloria Store</title>
    </head>
    <body style="margin: 0 !important;">
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light custom-nav" style="margin: 0 !important;">
        <a class="navbar-brand" href="index.php">GLORIA STORE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                    <a class="nav-item nav-link" href="index.php">HOME</a>
                    <!-- <a class="nav-item nav-link" href="about.php">ABOUT</a> -->
                    <?php if (isset($_SESSION["level"])): ?>
                    <a class="nav-item nav-link d-inline-flex align-items-center" data-toggle="modal" href="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart4 mr-2" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                        </svg>
                        CART
                    </a>

                    <a class="nav-item nav-link d-inline-flex align-items-center" href="logout.php" onclick=" return confirm('Logout?')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-right mr-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                        </svg>
                        Logout
                    </a>

                    
                    
                    <?php endif; ?>
                    <?php if (!isset($_SESSION["level"])): ?>

                    <a class="nav-item nav-link d-inline-flex align-items-center" href="login.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-in-right mr-2" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                        Login
                    </a>
                    <?php endif; ?>

            </div>
        </div>
    </nav>

        <div class="container">

        <div class="sticky-top px-0 flasher-main" >
                <?php Flasher::flash(); ?>
            </div>

            <div class="detail d-flex w-100">
                <div class="detail-image d-flex justify-content-center align-items-center">
                    <img src="img/<?= $product[0]["img"] ?>" alt="" srcset="">
                </div>
                <div class="detail-info position-relative d-flex flex-column justify-content-start align-items-center">
                <div class="detail-info-header">
                    <h2>info produk</h2>
                </div>    
                <table>
                        <tbody>
                            <tr>
                                <td class="pr-0">
                                    <p>Product Name </p>
                                </td>
                                <td class="px-0"><p>:</p></td>

                                <td>
                                    <p><?= $product[0]["product_name"] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="pr-0">
                                    <p>Price </p>
                                </td>
                                <td class="px-0"><p>:</p></td>

                                <td>
                                    <p>IDR <?= $product[0]["price"] ?></p>
                                </td>
                            </tr>
                            <tr class="borderless">
                                <td colspan="3" style="padding-bottom: 0;">
                                    <p>Product Description  :</p>
                                </td>
                                
                            </tr>
                            <tr class="borderless">
                                <td colspan="3" class="py-0">
                                    <p class="desc-text" style=""><?= $product[0]["product_desc"] ?>
                                    <br><br>
                                    Photo by <a class="external-link" target="_blank" href="https://unsplash.com/@laurachouette?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Laura Chouette</a> on <a class="external-link" target="_blank" href="https://unsplash.com/@laurachouette?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a>
  
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="btn-wrapper d-flex align-items-center">
                    <?php if (isset($_SESSION["level"])): ?>
                        <button class="cart" data-toggle="modal" data-target="#exampleModalCenter" data-id-product="<?= $product[0]["id"] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                            </svg>
                            &nbsp;add to cart
                        </button> 

                    <?php endif; ?>
                    <?php if (!isset($_SESSION["level"])): ?>
                        <a class="cart" href="login.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                            </svg>
                            &nbsp;add to cart
                        </a> 
                    <?php endif; ?>
                    </div>
                    
                </div>
            </div>

            <footer class="d-flex">
                <div class="col-md-5 d-flex flex-column p-0 wrapper">
                    <div class="col-md-5 contact">
                        <h3>CONTACT</h3>
                        <div class="row">
                            <p class="text-bold">Whatsapp</p>
                            <p>088803186989</p>
                        </div>
                        <div class="row">
                            <p class="text-bold">Instagram</p>
                            <a href="https://www.instagram.com/faishql/" class="external-link" target="_blank">@faishql</a>
                        </div>
                        <div class="row">
                            <p class="text-bold">email</p>
                            <p style="text-transform: lowercase;">faishalmoch70@gmail.com</p>
                        </div>
                    </div>
                    <div class="col-md-5 find-us">
                        <h3>FIND US</h3>
                        <div class="row">
                            <p class="">gloria store</p>
                        </div>
                        <div class="row">
                            <p class="addres">GLANGGANG ST, PAKISAJI, MALANG EAST JAVA, INDONESIA</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-7 copyright">
                    <h2>GLORIA STORE</h2>

                    <p><a href="https://faishal.netlify.app" class="external-link" target="_blank">©Faishal 2022</a></p>
                </div>
            </footer>

            <!-- Modal -->
            <?php if (isset($_SESSION["level"])): ?>
                <div class="modal left fade cart-sidebar" id="exampleModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content cart-sidebar">
                        <div class="modal-header" id="cart-header">
                            <h2>CART</h2>
                        </div> 
                        <div class="modal-body " id="cart-modal-body">
                            <div class="cart-wrapper w-100">
                                <div class="position-relative w-100" style="padding-bottom: 120px;">
                                    <?php
                                    $total = 0;
                                    if (isset($carts)) { ?>

                                        <?php foreach ($carts as $cart): ?>
                                            <div class="product-cart d-inline-flex w-100">
                                                <img src="img/<?= $cart["img"] ?>" alt="" srcset="">
                                                <div class="cart-info">
                                                    <h4><?= $cart["product_name"] ?></h4>
                                                    <div class="d-inline-flex justify-content-between w-100">
                                                    <p>IDR <?= $cart["price"] ?> K</p>
                                                    <p>X<?= $cart["quantity"] ?></p>
                                                </div>
                                                <form action="" method="post">
                                                    <input type="hidden" name="id_cart" value="<?= $cart["id_cart"] ?>">
                                                <button class="delete-cart" name="delete-cart" onclick="return confirm('delete?')"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg></button>
                                                </form>
                                                </div>
                                            </div>
                                            <?php $total += $cart["price"] * $cart["quantity"]; ?>
                                            

                                        <?php endforeach; ?>
                                    <?php }
                                    ?>
                                    <div class="checkout-btn-wrapper position-fixed py-3 w-100">
                                        <div class="d-inline-flex justify-content-between w-100">
                                            
                                            <p>Total</p>
                                            <p><?php echo isset($total) ? "IDR " . $total . "K" : "empty"; ?></p>
                                        </div>
                                        <?php if (isset($carts)): ?>
                                        <a href="checkout.php?total=<?= isset($total) ? encryptTb($total) : "empty" ?>" class="checkout-btn" >checkout</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close<button>
                        </div> -->
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">ADD TO CART</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="" action="" method="post">
                            <input type="hidden" class="form-control" name="id_user" value="<?= $_SESSION["id"] ?>" required>
                            <input type="hidden" id="id_product" name="id_product" class="form-control" value="" required>
                            <label for="quantity">Quantity</label>
                            <div class="input-group mb-3">
                            <input type="number" class="form-control" name="quantity" placeholder="quantity" aria-label="quantity" aria-describedby="button-addon2"  min="1" max="20"required>
                            </div>

                              
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                            <button class="add" type="submit" name="submit_cart">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                                </svg>
                                &nbsp;add 
                            </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>

    
</body>
</html>