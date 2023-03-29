<?php
include ROOT . "/db.php";
include ROOT . "/views/checkout/checkout.php";
$price = 0;
$items = array();
if (!isset($_SESSION["email"])) {
    header("Location: /login");
    die();
}
$userid = $_SESSION["userid"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete_from_cart"])) {
        $id = $_POST["delete_from_cart"];
        $sql = "DELETE FROM cart WHERE productId=$id LIMIT 1";
        echo mysqli_query($conn, $sql);
    }
    if (isset($_POST["delete_all"])) {
        removeItemFromCart($_POST["delete_all"], $conn);
    }
    if (isset($_POST["add_to_cart"])) {
        addToCart($_POST["add_to_cart"], $conn);
    }
    if (isset($_POST["checkout"]) && $_POST["checkout"] == "checkout") {

        $address = $_POST["address"];
        $name = $_POST["name"];
        $userid = $_SESSION["userid"];
        $phone = $_POST["phone"];
        $notes = $_POST["notes"];



        try {
            $uuid = uniqid();
            $sql = "INSERT INTO orders VALUES('$uuid','pending', '$address', '$userid','$phone','$name','$notes')";
            mysqli_query($conn, $sql);
            $sql = "SELECT * FROM cart WHERE userid=$userid";
            $cartitems = mysqli_query($conn, $sql);
            $totalPrice = 0;

            while ($cartItem = mysqli_fetch_array($cartitems)) {
                $productid = $cartItem["productId"];
                $sql = "SELECT * FROM products WHERE id=$productid";
                $product = mysqli_fetch_array(mysqli_query($conn, $sql));
                $totalPrice += $product["price"];
                $sql = "INSERT INTO orderedProducts VALUES('$uuid',$productid)";
                mysqli_query($conn, $sql);
            }
            echo $totalPrice;
            checkout(strval($totalPrice), $uuid, $conn);
        } catch (Exception $er) {
            echo $er;
        }
    }
}

$sql = "SELECT * FROM cart WHERE userid=$userid";
$cart_items = mysqli_query($conn, $sql);

$cnt = mysqli_num_rows($cart_items);
$items = array();
while ($item = mysqli_fetch_array($cart_items)) {
    $productid = $item["productId"];
    if (isset($items[$productid])) {
        $items[$productid]++;
    } else {
        $items[$productid] = 1;
    }
}
$userid = $_SESSION["userid"];
$user = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE id=$userid"));

?>

<html lang="en">



<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Basket</title>
    <?php include ROOT . "/views/links.php" ?>
    <link rel="stylesheet" href="/css/cart.css">
</head>

<body>
    <?php
    include ROOT . "/views/header.php";
    ?>
    <div class="cart">
        <div class="basket">
            <div class="basket-labels">
                <ul>
                    <li class="item item-heading">Item</li>
                    <li class="price">Price</li>
                    <li class="quantity">Quantity</li>
                    <li class="subtotal">Subtotal</li>
                </ul>
            </div>
            <?php


            foreach ($items as $idx => $total) :
                // $idx = $item["product"]
                $sql = "SELECT * FROM products WHERE id=$idx";
                $q = mysqli_query($conn, $sql);
                $product = mysqli_fetch_array($q);
                $price = $price + $product["price"] * $total;
            ?>
                <div class="basket-product">
                    <div class="item">
                        <div class="product-image">
                            <img src="<?php echo $product["image"] ?>" alt="Placholder Image 2" class="product-frame">
                        </div>
                        <div class="product-details">
                            <h1><strong><span class="item-quantity"><?php echo $items[$idx] ?></span> x </strong> <?php echo $product["name"] ?></h1>
                            <p>Product Code - <?php echo $idx ?></p>
                        </div>
                    </div>
                    <div class="price"><?php echo $product["price"] ?></div>
                    <div class="quantity">
                        <div class="btn-group que" role="group" aria-label="Basic outlined example">
                            <form id="submit" action method="post">
                                <input name="delete_from_cart" type="text" value="<?php echo $idx ?>" hidden>
                                <button type="submit" class="btn btn-outline-primary">-</button>
                            </form>
                            <p disabled type="button" class="btn btn-outline-primary"><?php echo $items[$idx] ?></p>
                            <form id="submit" action method="post">
                                <input name="add_to_cart" type="text" value="<?php echo $idx ?>" hidden>
                                <button type="submit" class="btn btn-outline-primary">+</button>
                            </form>
                        </div>
                    </div>
                    <div class="subtotal"><?php echo $product["price"] * $items[$idx] ?></div>
                    <form action method="post" class="remove">
                        <input value="<?php echo $idx ?>" hidden name="delete_all">
                        <button>Remove</button>
                    </form>
                </div>
            <?php endforeach ?>
        </div>
        <aside>
            <div class="summary">
                <div class="summary-total-items"><span class="total-items"></span> Items in your Bag</div>
                <div class="summary-subtotal">
                    <div class="subtotal-title">Subtotal</div>
                    <div class="subtotal-value final-value" id="basket-subtotal"><?php echo $price ?></div>
                    <div class="summary-promo hide">
                        <div class="promo-title">Promotion</div>
                        <div class="promo-value final-value" id="basket-promo"></div>
                    </div>
                </div>
                <form action method="post">
                    <div class="summary-delivery">
                        <input value="<?php echo $_SESSION["name"] ?>" placeholder="Full Name" name="name" class="summary-delivery-selection" />
                        <input value="<?php echo $user["phone"] ?>" placeholder="Phone number" name="phone" class="summary-delivery-selection" />
                        <input placeholder="Address" name="address" class="summary-delivery-selection" />
                        <textarea placeholder="Any notes" name="notes" style="height : 50px" name="delivery-collection" class="summary-delivery-selection"></textarea>
                        <input value="checkout" name="checkout" hidden />
                    </div>
                    <div class="summary-total">
                        <div class="total-title">Total</div>
                        <div class="total-value final-value" id="basket-total"><?php echo $price ?></div>
                    </div>
                    <div class="summary-checkout">
                        <button class="checkout-cta">Go to Secure Checkout</button>
                    </div>
                </form>
            </div>
        </aside>
    </div>
</body>

</html>