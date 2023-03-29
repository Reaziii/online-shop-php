<?php

include ROOT . "/db.php";
$sql = "SELECT * FROM catagories WHERE id=$catid";
$query = mysqli_query($conn, $sql);
$count = mysqli_num_rows($query);
if ($count == 0) {
    header("Location: /");
    die();
}
$cataogry = mysqli_fetch_array($query);
?>

<?php
include ROOT . "/db.php";
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["addtocart"])) {
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array();
        }
        array_push($_SESSION["cart"], $_POST["addtocart"]);
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
    <section class="sample-stores">
        <div style="justify-content: flex-start;" class="store-tab">
            <?php
            $sql = "SELECT * FROM products WHERE catagory=$catid";
            $query = mysqli_query($conn, $sql);

            while ($product = mysqli_fetch_array($query)) :
            ?>
                <form action method="POST" style="margin-right : 40px" class="item">
                    <img src="<?php echo $product["image"] ?>" alt="">
                    <div class="hidden-bg">
                        <button class="quick-view">Quick View</button>
                    </div>
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