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

<body class="shop-page">
    <?php include ROOT . "/views/header.php" ?>
    <section class="sample-stores">
        <div style="justify-content: flex-start;margin-top : 0" class="store-tab">
            <?php
            $sql = "SELECT * FROM products";
            $query = mysqli_query($conn, $sql);

            while ($product = mysqli_fetch_array($query)) :
            ?>
                <form action method="POST" style="margin-right : 40px;margin-bottom : 10px" class="item">
                    <img src="<?php echo $product["image"] ?>" alt="">
                    <a href="/product/<?php echo $product["id"] ?>" class="hidden-bg">
                        <button class="quick-view">Quick View</button>
                    </a>
                    <input type="text" name="addtocart" value="<?php echo $product["id"] ?>" hidden>
                    <button type="submit" class="add-card">Add To Cart</button>
                    <div class="down-helo">
                        <p class="cat"><?php
                                        $catid = $product["catagory"];
                                        $sql = "SELECT * FROM catagories WHERE id=$catid";
                                        $q = mysqli_query($conn, $sql);
                                        $q = mysqli_fetch_array($q);
                                        echo $q["name"];
                                        ?></p>
                        <div class="downer">
                            <p class="name"><?php echo $product["name"] ?></p>
                            <p class="price"><?php echo $product["price"] ?>/-</p>
                        </div>
                    </div>
                </form>
            <?php endwhile; ?>

        </div>
    </section>
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