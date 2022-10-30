<?php
require 'vendor/autoload.php';

// Initialize Guzzle HTTP Client integration with Dummy JSON
use GuzzleHttp\Client;

function getProducts()
{
    $token = 'b8f1173623791218a513a1e5b20bf5f8eda6169a6759752c5ff4feac0f0fd56df28e09e6172db19156fc676ec0fc5a151fc633581762c989bee2c38987c149e92440cfac925f6155d1e846248e4a7f89ea8559390e859166504334e46e32c40faebea8634479edda2f5baf586a1dfb5cd2f7f56b00e67218858a9759e1419977';
    $client = new Client([
        'base_uri' => 'http://localhost:1337/api/',
    ]);

    $headers = [
        'Authorization' => 'Bearer ' . $token,
        'Accept'        => 'application/json',
    ];

    $response = $client->request('GET', 'home?pagination[pageSize]=1', [
        'headers' => $headers
    ]);

    $body = $response->getBody();
    $products = json_decode($body);
    return $products;
}

$product = getProducts();
$products = $product->data;
$details = $products->attributes;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RedStore | Ecommerce Website Design</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    
    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="index.html"><img src="<?php echo $details->headerLogo; ?>" alt="logo" width="125px"></a>
                </div>
                <nav>
                    <ul id="MenuItems">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="products.html">Products</a></li>
                        <li><a href="">About</a></li>
                        <li><a href="">Contact</a></li>
                        <li><a href="account.html">Account</a></li>
                    </ul>
                </nav>
                <a href="cart.html"><img src="images/cart.png" width="30px" height="30px"></a>
                <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>
            <div class="row">
                <div class="col-2">
                    <h1><?php echo $details->heroSection->title; ?></h1>
                    <p><?php echo $details->heroSection->description; ?></p>
                    <a href="" class="btn"><?php echo $details->heroSection->buttonText; ?> &#8594;</a>
                </div>
                <div class="col-2">
                    <img src="images/image1.png">
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->

    <div class="categories">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <img src="images/category-1.jpg">
                </div>
                <div class="col-3">
                    <img src="images/category-2.jpg">
                </div>
                <div class="col-3">
                    <img src="images/category-3.jpg">
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Products -->

    <div class="small-container">
        <h2 class="title">Featured Products</h2>
        <div class="row">
            <?php
                foreach ($details->featuredProducts as $featured) { 
                    ?>
            <div class="col-4">
                <a href="product_details.html"><img src="<?php echo $featured->image; ?>"></a>
                <h4><?php echo $featured->name; ?></h4>
                <div class="rating">
                    <?php $stars = $featured->stars;
                    $i = 0;
                    while ($i < $stars) {
                        echo "<i class=\"fa fa-star\"></i>\n";
                        $i++;
                    } ?>
                    <i class="fa fa-star-o"></i>
                </div>
                <p><?php echo $featured->price; ?></p>
            </div>
            <?php } ?>
        </div>
        <h2 class="title">Latest Products</h2>
        <div class="row">
            <?php
                foreach ($details->latestProducts as $latest) { 
                    ?>
            <div class="col-4">
                <img src="<?php echo $latest->image; ?>">
                <h4><?php echo $latest->name; ?></h4>
                <div class="rating">
                    <?php $stars = $latest->stars;
                    $i = 0;
                    while ($i < $stars) {
                        echo "<i class=\"fa fa-star\"></i>\n";
                        $i++;
                    } ?>
                    <i class="fa fa-star-o"></i>
                </div>
                <p><?php echo $latest->price; ?></p>
            </div>
            <?php } ?>
        </div>
    </div>

    <!-- Offer -->
    <div class="offer">
        <div class="small-container">
            <div class="row">
                <div class="col-2">
                    <img src="images/exclusive.png" class="offer-img">
                </div>
                <div class="col-2">
                    <p>Exclusively Available on RedStore</p>
                    <h1>Smart Band 4</h1>
                    <small>The Mi Smart Band 4 fearures a 39.9%larger (than Mi Band 3) AMOLED color full-touch display
                        with adjustable brightness, so everything is clear as can be.<br></small>
                    <a href="products.html" class="btn">Buy Now &#8594;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonial -->
    <div class="testimonial">
        <div class="small-container">
            <div class="row">
                <?php
                    foreach ($details->testimonials as $testimonial) { 
                        ?>
                <div class="col-3">
                    <i class="fa fa-quote-left"></i>
                    <p><?php echo $testimonial->testimonial; ?></p>
                    <div class="rating">
                        <?php $stars = $testimonial->stars;
                        $i = 0;
                        while ($i < $stars) {
                            echo "<i class=\"fa fa-star\"></i>\n";
                            $i++;
                        } ?>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <img src="<?php echo $testimonial->picture; ?>">
                    <h3><?php echo $testimonial->name; ?></h3>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Brands -->

    <div class="brands">
        <div class="small-container">
            <div class="row">
                <div class="col-5">
                    <img src="images/logo-godrej.png">
                </div>
                <div class="col-5">
                    <img src="images/logo-oppo.png">
                </div>
                <div class="col-5">
                    <img src="images/logo-coca-cola.png">
                </div>
                <div class="col-5">
                    <img src="images/logo-paypal.png">
                </div>
                <div class="col-5">
                    <img src="images/logo-philips.png">
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>Download Our App</h3>
                    <p>Download App for Android and ios mobile phone.</p>
                    <div class="app-logo">
                        <img src="images/play-store.png">
                        <img src="images/app-store.png">
                    </div>
                </div>
                <div class="footer-col-2">
                    <img src="<?php echo $details->footerLogo; ?>">
                    <p><?php echo $details->footerSlogan; ?>
                    </p>
                </div>
                <div class="footer-col-3">
                    <h3>Useful Links</h3>
                    <ul>
                        <li>Coupons</li>
                        <li>Blog Post</li>
                        <li>Return Policy</li>
                        <li>Join Affiliate</li>
                    </ul>
                </div>
                <div class="footer-col-4">
                    <h3>Follow Us</h3>
                    <ul>
                        <li>Facebook</li>
                        <li>Twitter</li>
                        <li>Instagram</li>
                        <li>Youtube</li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="copyright">Copyright 2020 - Samwit Adhikary</p>
        </div>
    </div>

    <!-- javascript -->

    <script>
        var MenuItems = document.getElementById("MenuItems");
        MenuItems.style.maxHeight = "0px";
        function menutoggle() {
            if (MenuItems.style.maxHeight == "0px") {
                MenuItems.style.maxHeight = "200px"
            }
            else {
                MenuItems.style.maxHeight = "0px"
            }
        }
    </script>

</body>

</html>