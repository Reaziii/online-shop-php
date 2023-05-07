<?php
include ROOT . "/db.php";
include ROOT . "/views/checkout/checkout.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["addtocart"])) {
        addToCart($_POST["addtocart"], $conn);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include ROOT . "/views/links.php" ?>
</head>

<body>
    <?php include ROOT . "/views/header.php" ?>
    <section class="landing-page">
        <div class="owl-carousel owl-theme">
            <div style="background : black" class="item landing-items">
                <img style="width : 550px;bottom : 100px" src="/assets/pexels-albin-berlin-919073.jpg" alt="adsf">
                <h1>Buy your dreams with our cars!</h1>
                <p>Stay connected and stylish with our latest mobile phones - the perfect statement piece for modern living.</p>

                <button class="btn-1">Shop Collection</button>
            </div>
            <div style="background-image: linear-gradient(45deg,#1b2c30 0%,#000000 100%)" class="item landing-items">
                <img style="height : 500px;width : 550px" src="/assets/sofa.png" alt="adsf">
                <h1>Stylish furniture for every space!</h1>
                <p>Transform your space with our stylish and affordable furniture - make every room a reflection of you!</p>

                <button class="btn-1">Shop Collection</button>
            </div>
            <div style="background : black" class="item landing-items">
                <img style="width : 550px;bottom : 100px" src="/assets/hero__cj6i78tzkp8i_large_2x.jpg" alt="adsf">
                <h1>Get the latest mobile phones today!</h1>
                <p>Stay connected and stylish with our latest mobile phones - the perfect statement piece for modern living.</p>

                <button class="btn-1">Shop Collection</button>
            </div>

        </div>
    </section>

    <?php
    $catqueries = mysqli_query($conn, "SELECT * FROM catagories");
    while ($catagory = mysqli_fetch_array($catqueries)) :
        $catid = $catagory["id"];
    ?>
        <section class="sample-stores">
            <h1><?php echo $catagory["name"] ?></h1>

            <div class="store-tab">

                <?php
                $products = mysqli_query($conn, "SELECT * FROM products WHERE catagory=$catid LIMIT 4");
                while ($product = mysqli_fetch_array($products)) :
                ?>
                    <form action method="POST" class="item">
                        <input name="addtocart" value="<?php echo $product["id"] ?>" hidden>
                        <img src="<?php echo $product["image"] ?>" alt="">
                        <div class="hidden-bg">
                            <button class="quick-view">Quick View</button>
                        </div>
                        <button class="add-card">Add To Cart</button>
                        <div class="down-helo">
                            <p class="cat"><?php echo $catagory["name"] ?></p>
                            <div class="downer">
                                <p class="name"><?php echo $product["name"] ?></p>
                                <p class="price"><?php echo $product["price"] ?>/-</p>
                            </div>
                        </div>
                    </form>
                <?php endwhile; ?>
            </div>
            <a href="/shop/<?php echo $catagory["id"] ?>">
                <button class="show-all">Show More</button>
            </a>

        </section>
    <?php endwhile; ?>

    <?php include ROOT . "/views/footer.php" ?>



</body>
<script src="/js/jquery.min.js"></script>
<script src="/carousel/owl.carousel.min.js"></script>
<script>
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        items: 1,
        loop: true,
        margin: 0,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: false,
    });
    $('.owl-dots').hide()
</script>

</html>