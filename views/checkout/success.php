<?php
include ROOT . "/db.php";
$val_id = urlencode($_POST['val_id']);
$store_id = urlencode(STORE_ID);
$store_passwd = urlencode(STORE_PASS);
$requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=" . $val_id . "&store_id=" . $store_id . "&store_passwd=" . $store_passwd . "&v=1&format=json");
$handle = curl_init();
curl_setopt($handle, CURLOPT_URL, $requested_url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC
$result = curl_exec($handle);
$code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
if ($code == 200 && !(curl_errno($handle))) {
    $result = json_decode($result);
    $tran_id = $result->tran_id;
    $sessionString = mysqli_query($conn, "SELECT * FROM orderSession WHERE orderId='$tran_id'");
    $sessionString = mysqli_fetch_array($sessionString);
    $_SESSION = json_decode($sessionString["session"], true);
    $order = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM orders WHERE turn_id='$tran_id'"));
    $orderedProducts = mysqli_query($conn, "SELECT * FROM orderedProducts WHERE orderid='$tran_id'");
    $sql = "DELETE FROM orderSession WHERE orderid='$tran_id'";
    mysqli_query($conn, $sql);

    while ($product = mysqli_fetch_array($orderedProducts)) {
        $userid = $order["userid"];
        $productid = $product["productId"];
        mysqli_query($conn, "DELETE FROM cart WHERE userid=$userid and productId=$productid LIMIT 1");
    }
} else {
    echo "Failed to connect with SSLCOMMERZ";
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
    <div class="payment-done">
        <h1>Payment Recieved</h1>
        <p>Track my <a href="/myorders">orders</a></p>
    </div>


</body>

</html>