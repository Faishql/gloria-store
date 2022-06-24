<?php

session_start();

require "php/functions/functions.php";

if (!isset($_SESSION["level"])) {
    header("Location: login.php");
}

$db = "products";
$id = $_GET["id_product"];
$product = read(" SELECT * FROM $db WHERE id = $id");

// print_r($_SESSION["cart"]["id"]);

if (isset($_POST["submit"])) {
    if (addCart($_POST) > 0) {
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
                width: 500px;
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
                left: -500px;
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
    <body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light custom-nav">
            <a class="navbar-brand" href="index.php">GLORIA STORE</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="index.php">HOME</a>
                    <a class="nav-item nav-link" href="about.html">ABOUT</a>
                    <a class="nav-item nav-link d-inline-flex align-items-center" data-toggle="modal" data-target="#exampleModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart4 mr-2" viewBox="0 0 16 16">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                        </svg>CART</a>
                        <a class="nav-item nav-link d-inline-flex align-items-center" href="logout.php" onclick=" return confirm('Logout?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-right mr-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                            </svg>Logout</a>
                    
                    <!-- <div class="dropdown">
                        <a class="" data-toggle="dropdown">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        </a>
                      <div class="dropdown-menu">
                            <a class="dropdown-item d-inline-flex align-items-center" href="logout.php" onclick=" return confirm('Logout?')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-right mr-2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                            </svg>Logout</a>
                      </div>
                    </div>     -->
                </div>
            </div>
        </nav>

        <div class="container">

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
                                <td>
                                    judul album 
                                </td>
                                <td>:</td>

                                <td>
                                    <?= $product[0]["product_name"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    harga 
                                </td>
                                <td>:</td>

                                <td>
                                    IDR <?= $product[0]["price"] ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    deskripsi  
                                </td>
                                <td>:</td>
                                <td>
                                    <?= $product[0]["product_desc"] ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="btn-wrapper d-flex align-items-center">

                        <button  data-toggle="modal" data-target="#exampleModalCenter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                            </svg>
                            &nbsp;add to cart
                        </button> 
                    </div>
                    
                </div>
            </div>

            <footer class="d-flex">
                <div class="col-md-5 d-flex flex-column p-0 wrapper">
                    <div class="col-md-5 contact">
                        <h3>GET IN TOUCH</h3>
                        <div class="row">
                            <p class="text-bold">faishql</p>
                            <p>088803186989</p>
                        </div>
                        <div class="row">
                            <p class="text-bold">faishql</p>
                            <p>088803186989</p>
                        </div>
                        <div class="row">
                            <p class="text-bold">email</p>
                            <p>click here</p>
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
                <div class="col-sm-7 yet"></div>
            </footer>

            <!-- Modal -->
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
                            <input type="hidden" name="product_id" class="form-control" value="<?= $product[0]["id"] ?>" required>
                            <label for="quantity">Quantity</label>
                            <div class="input-group mb-3">
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="quantity" aria-label="quantity" aria-describedby="button-addon2" required>
                            <!-- <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
                            </div> -->
                            </div>
                              
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                            <button class="add" type="submit" name="submit">
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

            <!-- Modal -->
            <div class="modal left fade" id="exampleModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" id="cart-header">
                            <h2>CART</h2>
                        </div>
                        <div class="modal-body">
                            <div class="product-preview">
                                <img src="" alt="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal -->
            <div class="modal left fade" id="mobile-nav" tabindex="" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header" id="cart-header">
                            <h2>CART</h2>
                        </div>
                        <div class="modal-body">
                            <div class="product-preview">
                                <img src="" alt="">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/prettier/standalone.js"></script>
        <script src="https://unpkg.com/@prettier/plugin-php/standalone.js"></script>
    
</body>
</html>