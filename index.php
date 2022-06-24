<?php

session_start();

require "php/functions/functions.php";

if (!isset($_SESSION["level"])) {
    header("Location: login.php");
}

// var_dump($_SESSION['level']);die;

$products = read(" SELECT * FROM products ");
$newArrivals = read(" SELECT * FROM products ORDER BY created DESC LIMIT 4");

$temp = [];

for ($i = 0; $i <= count($newArrivals); $i++) {
    if ($i % 2 === 0) {
        $temp[] = [array_slice($newArrivals, $i, 2)];
    }
}

// print_r($temp);

// array_shift($temp);

// var_dump($temp[1]);die;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />

        <!-- CSS Link -->
        <link rel="stylesheet" href="style/index.css" />
        

        <title>Gloria Store</title>

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
            <section class="hero">
                <div class="hero-img"></div>
            </section>
            <section class="new-arrivals">
                <div class="new-arrivals-header">
                    <h2>new-arrivals</h2>
                </div>
                <div id="carouselExampleControls" class="carousel slide carousel-custom" data-ride="carousel">
                    <div class="carousel-inner">
                        
                        <?php for ($i = 0; $i < 2; $i++): ?>
                        
                            <div class="carousel-item">
                                <div class="row justify-content-center m-0">
                                <?php for ($j = 0; $j < 2; $j++): ?>
                                    <?php foreach ($temp[$i] as $new): ?> 

                                        <div class="col-md-5 text-center product-item">
                                                <img src="img/<?= $new[$j]["img"] ?>" alt="" />
                                                <div class="product-info">
                                                    <div class="product-title">
                                                        <p class="name"><?= $new[$j]["product_name"] ?></p>
                                                        <p class="price"><?= $new[$j]["price"] ?></p>
                                                    </div>

                                                    <div class="buttons">
                                                        <a href="detail.php?id_product=<?= $new[$j]["id"] ?>" class="show-detail">show detail</a>
                                                        <a class="cart"
                                                            ><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M14.4004 7.20023C14.4004 6.98805 14.3162 6.78456 14.1661 6.63453C14.0161 6.4845 13.8126 6.40021 13.6004 6.40021C13.3882 6.40021 13.1847 6.4845 13.0347 6.63453C12.8847 6.78456 12.8004 6.98805 12.8004 7.20023V9.60031H10.4003C10.1881 9.60031 9.98465 9.68459 9.83462 9.83463C9.68458 9.98466 9.6003 10.1882 9.6003 10.4003C9.6003 10.6125 9.68458 10.816 9.83462 10.966C9.98465 11.1161 10.1881 11.2004 10.4003 11.2004H12.8004V13.6004C12.8004 13.8126 12.8847 14.0161 13.0347 14.1661C13.1847 14.3162 13.3882 14.4005 13.6004 14.4005C13.8126 14.4005 14.0161 14.3162 14.1661 14.1661C14.3162 14.0161 14.4004 13.8126 14.4004 13.6004V11.2004H16.8005C17.0127 11.2004 17.2162 11.1161 17.3662 10.966C17.5163 10.816 17.6005 10.6125 17.6005 10.4003C17.6005 10.1882 17.5163 9.98466 17.3662 9.83463C17.2162 9.68459 17.0127 9.60031 16.8005 9.60031H14.4004V7.20023Z"
                                                                    fill="white"
                                                                />
                                                                <path
                                                                    d="M0.800025 0C0.587845 0 0.384356 0.084288 0.234322 0.234322C0.0842881 0.384356 0 0.587845 0 0.800025C0 1.0122 0.0842881 1.21569 0.234322 1.36573C0.384356 1.51576 0.587845 1.60005 0.800025 1.60005H2.57608L3.2177 4.17133L5.61457 16.9477C5.64889 17.1311 5.74619 17.2966 5.88964 17.4158C6.03309 17.535 6.21368 17.6004 6.4002 17.6005H8.00025C7.15153 17.6005 6.33757 17.9377 5.73744 18.5378C5.1373 19.138 4.80015 19.9519 4.80015 20.8006C4.80015 21.6494 5.1373 22.4633 5.73744 23.0635C6.33757 23.6636 7.15153 24.0007 8.00025 24.0007C8.84897 24.0007 9.66292 23.6636 10.2631 23.0635C10.8632 22.4633 11.2003 21.6494 11.2003 20.8006C11.2003 19.9519 10.8632 19.138 10.2631 18.5378C9.66292 17.9377 8.84897 17.6005 8.00025 17.6005H19.2006C18.3519 17.6005 17.5379 17.9377 16.9378 18.5378C16.3376 19.138 16.0005 19.9519 16.0005 20.8006C16.0005 21.6494 16.3376 22.4633 16.9378 23.0635C17.5379 23.6636 18.3519 24.0007 19.2006 24.0007C20.0493 24.0007 20.8633 23.6636 21.4634 23.0635C22.0635 22.4633 22.4007 21.6494 22.4007 20.8006C22.4007 19.9519 22.0635 19.138 21.4634 18.5378C20.8633 17.9377 20.0493 17.6005 19.2006 17.6005H20.8006C20.9872 17.6004 21.1678 17.535 21.3112 17.4158C21.4547 17.2966 21.5519 17.1311 21.5863 16.9477L23.9863 4.14733C24.008 4.03186 24.0039 3.91306 23.9744 3.79935C23.9449 3.68564 23.8908 3.57981 23.8158 3.48939C23.7408 3.39898 23.6468 3.32618 23.5405 3.27618C23.4342 3.22618 23.3182 3.20021 23.2007 3.2001H4.62414L3.97612 0.606419C3.93294 0.433268 3.8331 0.279527 3.69248 0.169645C3.55187 0.0597629 3.37855 4.92999e-05 3.2001 0H0.800025ZM7.06422 16.0005L4.96335 4.80015H22.2375L20.1366 16.0005H7.06422ZM9.6003 20.8006C9.6003 21.225 9.43172 21.632 9.13165 21.932C8.83159 22.2321 8.42461 22.4007 8.00025 22.4007C7.57589 22.4007 7.16891 22.2321 6.86884 21.932C6.56877 21.632 6.4002 21.225 6.4002 20.8006C6.4002 20.3763 6.56877 19.9693 6.86884 19.6692C7.16891 19.3692 7.57589 19.2006 8.00025 19.2006C8.42461 19.2006 8.83159 19.3692 9.13165 19.6692C9.43172 19.9693 9.6003 20.3763 9.6003 20.8006ZM20.8006 20.8006C20.8006 21.225 20.6321 21.632 20.332 21.932C20.0319 22.2321 19.625 22.4007 19.2006 22.4007C18.7762 22.4007 18.3693 22.2321 18.0692 21.932C17.7691 21.632 17.6005 21.225 17.6005 20.8006C17.6005 20.3763 17.7691 19.9693 18.0692 19.6692C18.3693 19.3692 18.7762 19.2006 19.2006 19.2006C19.625 19.2006 20.0319 19.3692 20.332 19.6692C20.6321 19.9693 20.8006 20.3763 20.8006 20.8006Z"
                                                                    fill="white"
                                                                />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                        <!-- <hr style="width: 2px; background-color: black; height: 100%;"></hr> -->
                                    <?php endforeach; ?>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            

                        <?php endfor; ?>
                    </div>
                    <a class="carousel-control-prev col-md-1" href="#carouselExampleControls" role="button" data-slide="prev">
                        <svg width="30" height="32" viewBox="0 0 30 32" fill="none" xmlns="http://www.w3.org/2000/svg" style="transform: rotate(180deg)">
                            <path d="M11.8376 27.8463L21.4388 18.208H-1.90735e-06V13.7177H21.4388L11.8376 4.07944L15 0.904846L30 15.9629L15 31.0209L11.8376 27.8463Z" fill="#3A3A3A" />
                        </svg>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next col-md-1" href="#carouselExampleControls" role="button" data-slide="next">
                        <svg width="30" height="32" viewBox="0 0 30 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.8376 27.8463L21.4388 18.208H-1.90735e-06V13.7177H21.4388L11.8376 4.07944L15 0.904846L30 15.9629L15 31.0209L11.8376 27.8463Z" fill="#3A3A3A" />
                        </svg>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </section>
            <section class="about row">
                <div class="col-md-6 about-img">
                    <img src="img/about-img2.jpg" alt="" />
                </div>
                <div class="col-md-6 about-text">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque elit dui, turpis. Sed posuere dignissim risus in sollicitudin. Duis fringilla purus leo, ac fermentum nulla molestie id. Nullam sed dolor consectetur.</p>
                    <div class="button-about">
                        <a class="read-more" href="#"
                            >our story &nbsp;
                            <svg width="43" height="14" viewBox="0 0 43 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 7H41M41 7L33.0085 1M41 7L33.0085 13" stroke="white" stroke-width="2" />
                            </svg>
                        </a>
                    </div>
                </div>
            </section>
            <section class="collections">
                <div class="collections-header">
                    <h2>collection</h2>
                </div>
                <div class="collections-filters">
                    <p>short by : -</p>
                    <p>category : -</p>
                </div>
                <div class="collections-products d-inline-flex flex-wrap justify-content-start align-items-center w-100">
                        <?php foreach ($products as $product): ?>
                            <div class="product-item col-md-4">
                                <img src="img/<?= $product["img"] ?>" alt="" />
                                <div class="product-info">
                                    <div class="product-title">
                                        <p class="name"><?= $product["product_name"] ?></p>
                                        <p class="price">IDR&nbsp;<?= $product["price"] ?>K</p>
                                    </div>
                                    <div class="buttons">
                                    <a href="detail.php?id_product=<?= $product["id"] ?>" class="show-detail">show detail</a>
                                        <a class="cart"
                                            ><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M14.4004 7.20023C14.4004 6.98805 14.3162 6.78456 14.1661 6.63453C14.0161 6.4845 13.8126 6.40021 13.6004 6.40021C13.3882 6.40021 13.1847 6.4845 13.0347 6.63453C12.8847 6.78456 12.8004 6.98805 12.8004 7.20023V9.60031H10.4003C10.1881 9.60031 9.98465 9.68459 9.83462 9.83463C9.68458 9.98466 9.6003 10.1882 9.6003 10.4003C9.6003 10.6125 9.68458 10.816 9.83462 10.966C9.98465 11.1161 10.1881 11.2004 10.4003 11.2004H12.8004V13.6004C12.8004 13.8126 12.8847 14.0161 13.0347 14.1661C13.1847 14.3162 13.3882 14.4005 13.6004 14.4005C13.8126 14.4005 14.0161 14.3162 14.1661 14.1661C14.3162 14.0161 14.4004 13.8126 14.4004 13.6004V11.2004H16.8005C17.0127 11.2004 17.2162 11.1161 17.3662 10.966C17.5163 10.816 17.6005 10.6125 17.6005 10.4003C17.6005 10.1882 17.5163 9.98466 17.3662 9.83463C17.2162 9.68459 17.0127 9.60031 16.8005 9.60031H14.4004V7.20023Z"
                                                    fill="white"
                                                />
                                                <path
                                                    d="M0.800025 0C0.587845 0 0.384356 0.084288 0.234322 0.234322C0.0842881 0.384356 0 0.587845 0 0.800025C0 1.0122 0.0842881 1.21569 0.234322 1.36573C0.384356 1.51576 0.587845 1.60005 0.800025 1.60005H2.57608L3.2177 4.17133L5.61457 16.9477C5.64889 17.1311 5.74619 17.2966 5.88964 17.4158C6.03309 17.535 6.21368 17.6004 6.4002 17.6005H8.00025C7.15153 17.6005 6.33757 17.9377 5.73744 18.5378C5.1373 19.138 4.80015 19.9519 4.80015 20.8006C4.80015 21.6494 5.1373 22.4633 5.73744 23.0635C6.33757 23.6636 7.15153 24.0007 8.00025 24.0007C8.84897 24.0007 9.66292 23.6636 10.2631 23.0635C10.8632 22.4633 11.2003 21.6494 11.2003 20.8006C11.2003 19.9519 10.8632 19.138 10.2631 18.5378C9.66292 17.9377 8.84897 17.6005 8.00025 17.6005H19.2006C18.3519 17.6005 17.5379 17.9377 16.9378 18.5378C16.3376 19.138 16.0005 19.9519 16.0005 20.8006C16.0005 21.6494 16.3376 22.4633 16.9378 23.0635C17.5379 23.6636 18.3519 24.0007 19.2006 24.0007C20.0493 24.0007 20.8633 23.6636 21.4634 23.0635C22.0635 22.4633 22.4007 21.6494 22.4007 20.8006C22.4007 19.9519 22.0635 19.138 21.4634 18.5378C20.8633 17.9377 20.0493 17.6005 19.2006 17.6005H20.8006C20.9872 17.6004 21.1678 17.535 21.3112 17.4158C21.4547 17.2966 21.5519 17.1311 21.5863 16.9477L23.9863 4.14733C24.008 4.03186 24.0039 3.91306 23.9744 3.79935C23.9449 3.68564 23.8908 3.57981 23.8158 3.48939C23.7408 3.39898 23.6468 3.32618 23.5405 3.27618C23.4342 3.22618 23.3182 3.20021 23.2007 3.2001H4.62414L3.97612 0.606419C3.93294 0.433268 3.8331 0.279527 3.69248 0.169645C3.55187 0.0597629 3.37855 4.92999e-05 3.2001 0H0.800025ZM7.06422 16.0005L4.96335 4.80015H22.2375L20.1366 16.0005H7.06422ZM9.6003 20.8006C9.6003 21.225 9.43172 21.632 9.13165 21.932C8.83159 22.2321 8.42461 22.4007 8.00025 22.4007C7.57589 22.4007 7.16891 22.2321 6.86884 21.932C6.56877 21.632 6.4002 21.225 6.4002 20.8006C6.4002 20.3763 6.56877 19.9693 6.86884 19.6692C7.16891 19.3692 7.57589 19.2006 8.00025 19.2006C8.42461 19.2006 8.83159 19.3692 9.13165 19.6692C9.43172 19.9693 9.6003 20.3763 9.6003 20.8006ZM20.8006 20.8006C20.8006 21.225 20.6321 21.632 20.332 21.932C20.0319 22.2321 19.625 22.4007 19.2006 22.4007C18.7762 22.4007 18.3693 22.2321 18.0692 21.932C17.7691 21.632 17.6005 21.225 17.6005 20.8006C17.6005 20.3763 17.7691 19.9693 18.0692 19.6692C18.3693 19.3692 18.7762 19.2006 19.2006 19.2006C19.625 19.2006 20.0319 19.3692 20.332 19.6692C20.6321 19.9693 20.8006 20.3763 20.8006 20.8006Z"
                                                    fill="white"
                                                />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                </div>
                <!-- <div class="collections-add">
                    <a href="create.php" class="nav-item nav-link text-center py-3 inline-flex align-items-center"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAVRJREFUSEu9lW1RAzEURU+VAAqgCkACKAAHUCWAAkAB4AAUAA6KEpgzk9dJ0t2klG3fTH7sJrn3fd7M2LHNdozPJgRXwClwkpY+fab1Ary2nGwRnAO3wGEnyiWwACRbszGCO+A6nf4G/H5LXvvbaM6AG+AgnfOMRIUNEeTgXvC7ZZIYqXafSFfnawLT8px255nHvV4woo906CJPV01gPg15zPOfBDIUeUQixlF4lB+0Wx4Acz5W2BaBmOHgKoqc4BG4bHgvQI8gongCdLiYA3v7GGjlvkcQtRBLnIJg6HL86xU5z0SBM7qRECclmDJFXyErey1yDFnRx1Xye0Vutmnex/8ZtGKO9i4VRpGLnYOjgE0mdgGUk5hXv98rufYR0oGQlTUlrQet9tKiCxx6PxaFOZfoTw9ODiaRSxlQSjT73LkRdBB4SE17crDV/iaP/lbAcekXtcVYGaT13/YAAAAASUVORK5CYII="/>&nbsp;add products</a>
                </div> -->
            </section>
            <footer class="d-flex">
                <div class="col-md-5 d-flex flex-column p-0 wrapper">
                    <div class="col-md-5 contact">
                        <h3>GET IN TOUCH</h3>
                        <div class="row">
                            <p class="text-bold">Whatsapp</p>
                            <p>088803186989</p>
                        </div>
                        <div class="row">
                            <p class="text-bold">Instagram</p>
                            <p>088803186989</p>
                        </div>
                        <div class="row">
                            <p class="text-bold">email</p>
                            <p>faishalmoch70@gmail.com</p>
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
        </div>


        

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script>
            // (function ($) {
            //     $(document).ready(function () {
            //         // hide .navbar first
            //         $(".navbar").hide();

            //         // fade in .navbar
            //         $(function () {
            //             $(window).scroll(function () {
            //                 // set distance user needs to scroll before we start fadeIn
            //                 if ($(this).scrollTop() > 100) {
            //                     $(".navbar").fadeIn();
            //                 } else {
            //                     $(".navbar").fadeOut();
            //                 }
            //             });
            //         });
            //     });
            // })(jQuery);
            
            $(".carousel-item:first-child").one().addClass("active");
        </script>

    </body>
</html>
