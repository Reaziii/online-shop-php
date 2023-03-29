<?php
require_once __DIR__ . '/router.php';
require_once __DIR__. '/config.php';
get("/", "views/index.php");
get("/admin", "views/admin/index.php");
any("/admin/login", "views/admin/login.php");
any("/logout", "views/logout.php");
any("/login", "views/login.php");
any("/registration", "views/registration.php");
any("/admin", "views/admin/index.php");
any("/admin/catagories", "views/admin/catagories.php");
any("/admin/products", "views/admin/products.php");
any('/admin/orders', "views/Admin/orders.php");
any("/shop", "views/shop.php");
any("/cart", "views/cart.php");
any('/shop/$catid', "views/shop-catagory.php");
any("/checkout/success", "views/checkout/success.php");
any("/checkout/fail", "views/checkout/fail.php");
any("/checkout/cancel", "views/checkout/cancel.php");
any("/checkout/cancel", "views/checkout/cancel.php");
any('/product/$id', "views/product.php");




