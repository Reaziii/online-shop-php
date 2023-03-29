<?php
include ROOT . "/db.php";
include ROOT . "/views/checkout/checkout.php";

$product = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM products WHERE id=$id"));
if(isset($_POST["amount"])){
    $total = $_POST["amount"];

    while($total--){
        addToCart($id, $conn);
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
    <?php include ROOT . "/views/links.php"; ?>

</head>
<?php
$images = mysqli_query($conn, "SELECT * FROM productImages WHERE productId=$id");
$imgs = array();
while ($res = mysqli_fetch_array($images)) {
    $idx = $res['id'];
    $file_name = $res['file_name'];
    array_push($imgs, array('id' => $idx, 'file_name' => $file_name));
}
$images = mysqli_query($conn, "SELECT * FROM productImages WHERE productId=$id");
$imgs = array(array('id' => 1, 'file_name' => $product['image']));
$i = 1;
while ($res = mysqli_fetch_array($images)) {
    $i++;
    array_push($imgs, array('id' => $i, 'file_name' => $res['file_name']));
}
?>

<body>
    <?php include ROOT . "/views/header.php" ?>
    <div class="product-page">
        <div class="image">
            <div class="show-img">
                <img id="show-image" src="<?php echo $product["image"] ?>" alt="">
            </div>
            <div class="short-images">
                <?php
                foreach ($imgs as $img) :
                ?>
                    <div class="short-image"><img src="<?php echo $img["file_name"] ?>" alt=""></div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="details-cart">
            <h3><?php echo $product["name"] ?></h3>
            <p>&#2547;<?php echo $product["price"] ?></p>
            <div class="quantity">
                <button id="negetive">-</button>
                <button id="quantity">1</button>
                <button id="positive">+</button>
            </div>
            <div class="desc"><?php echo $product["description"] ?></div>
            <form action method="post">
                <input id="amount" name="amount" hidden value="1" type="number">
                <button class="add-to-cart">Add To Cart</button>
            </form>
        </div>
    </div>
</body>

<script>
    let images = <?php echo json_encode($imgs, true) ?>;
    $('.short-image').map((i, item) => {
        item.addEventListener("click", () => {
            $("#show-image")[0].setAttribute("src", images[i].file_name);
        })
    })
    $("#positive")[0].addEventListener("click", () => {
        let value = Number($("#amount")[0].value);
        value = Number(value) + 1;
        $("#amount")[0].value = value;
        $("#quantity")[0].innerText = value;
    })
    $("#negetive")[0].addEventListener("click", () => {
        let value = $("#amount")[0].value;
        value = Number(value) - 1;
        if (value === 0) value = 1;
        $("#amount")[0].value = Number(value);
        $("#quantity")[0].innerText = value;
    })
</script>


</html>