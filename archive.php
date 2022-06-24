<?php for ($i = 0; $i < count($temp); $i++) : ?>
                                    <?php foreach ($temp[$i] as $new) :  ?>
                                        <div class="col-sm-5 text-center product-item">
                                            <img src="img/<?= $new['img'] ?>" alt="" />
                                            <div class="product-info">
                                                <div class="product-title">
                                                    <p class="name"><?= $new['product_name'] ?></p>
                                                    <p class="price"><?= $new['price'] ?></p>
                                                </div>

                                                <div class="buttons">
                                                    <a class="show-detail">show detail</a>
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
                                <?php endfor;?>