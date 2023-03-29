<?php
include ROOT . "/db.php";
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
    <section class="sample-stores">
        <h1>Mobile Phones</h1>
        <p>Upgrade your life with latest smartphones</p>
        <div class="store-tab">
            <div class="item">
                <img src="/assets/Apple-iPhone-12-PNG-Photo.png" alt="">
                <div class="hidden-bg">
                    <button class="quick-view">Quick View</button>
                </div>
                <button class="add-card">Add To Cart</button>
                <div class="down-helo">
                    <p class="cat">Mobile Phones</p>
                    <div class="downer">
                        <p class="name">Iphone 12 max Pro</p>
                        <p class="price">122323/-</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="/assets/Apple-iPhone-12-PNG-Photo.png" alt="">
                <div class="hidden-bg">
                    <button class="quick-view">Quick View</button>
                </div>
                <button class="add-card">Add To Cart</button>
                <div class="down-helo">
                    <p class="cat">Mobile Phones</p>
                    <div class="downer">
                        <p class="name">Iphone 12 max Pro</p>
                        <p class="price">122323/-</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="/assets/Apple-iPhone-12-PNG-Photo.png" alt="">
                <div class="hidden-bg">
                    <button class="quick-view">Quick View</button>
                </div>
                <button class="add-card">Add To Cart</button>
                <div class="down-helo">
                    <p class="cat">Mobile Phones</p>
                    <div class="downer">
                        <p class="name">Iphone 12 max Pro</p>
                        <p class="price">122323/-</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="/assets/Apple-iPhone-12-PNG-Photo.png" alt="">
                <div class="hidden-bg">
                    <button class="quick-view">Quick View</button>
                </div>
                <button class="add-card">Add To Cart</button>
                <div class="down-helo">
                    <p class="cat">Mobile Phones</p>
                    <div class="downer">
                        <p class="name">Iphone 12 max Pro</p>
                        <p class="price">122323/-</p>
                    </div>
                </div>
            </div>

        </div>

        <button class="show-all">Show More</button>
    </section>
    <section class="sample-stores">
        <h1>Automobiles and cars</h1>
        Find the perfect car for your lifestyle and budget at our store</p>
        <div class="store-tab">
            <div class="item">
                <img src="/assets/Car-PNG-Picture.png" alt="">
                <div class="hidden-bg">
                    <button class="quick-view">Quick View</button>
                </div>
                <button class="add-card">Add To Cart</button>
                <div class="down-helo">
                    <p class="cat">Automobiles and Cars</p>
                    <div class="downer">
                        <p class="name">BMW ap001</p>
                        <p class="price">122323/-</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="/assets/Car-PNG-Picture.png" alt="">
                <div class="hidden-bg">
                    <button class="quick-view">Quick View</button>
                </div>
                <button class="add-card">Add To Cart</button>
                <div class="down-helo">
                    <p class="cat">Automobiles and Cars</p>
                    <div class="downer">
                        <p class="name">BMW ap001</p>
                        <p class="price">122323/-</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="/assets/Car-PNG-Picture.png" alt="">
                <div class="hidden-bg">
                    <button class="quick-view">Quick View</button>
                </div>
                <button class="add-card">Add To Cart</button>
                <div class="down-helo">
                    <p class="cat">Automobiles and Cars</p>
                    <div class="downer">
                        <p class="name">BMW ap001</p>
                        <p class="price">122323/-</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="/assets/Car-PNG-Picture.png" alt="">
                <div class="hidden-bg">
                    <button class="quick-view">Quick View</button>
                </div>
                <button class="add-card">Add To Cart</button>
                <div class="down-helo">
                    <p class="cat">Automobiles and Cars</p>
                    <div class="downer">
                        <p class="name">BMW ap001</p>
                        <p class="price">122323/-</p>
                    </div>
                </div>
            </div>

        </div>

        <button class="show-all">Show More</button>
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