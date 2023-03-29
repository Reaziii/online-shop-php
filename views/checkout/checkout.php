<?php
function checkout($pp, $id, $conn)
{
    $post_data = array();
    $post_data['store_id'] = strval(STORE_ID);
    $post_data['store_passwd'] = strval(STORE_PASS);
    $post_data['total_amount'] = 100;
    $post_data['currency'] = "BDT";
    $post_data['tran_id'] = "$id";
    $post_data['success_url'] = HOME_URL . "/checkout/success";
    $post_data['fail_url'] =  HOME_URL . "/checkout/fail";
    $post_data['cancel_url'] =  HOME_URL . "/checkout/cancel";
    $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";
    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $direct_api_url);
    curl_setopt($handle, CURLOPT_TIMEOUT, 30);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($handle, CURLOPT_POST, 1);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC
    $content = curl_exec($handle);
    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    if ($code == 200 && !(curl_errno($handle))) {
        curl_close($handle);
        $sslcommerzResponse = $content;
    } else {
        curl_close($handle);
        echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
        exit;
    }
    $sslcz = json_decode($sslcommerzResponse, true);
    if (isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL'] != "") {
        $sessionString = strval(json_encode($_SESSION));
        mysqli_query($conn, "INSERT INTO orderSession VALUES('$id', '$sessionString')");
        $rul = $sslcz['GatewayPageURL'];
        header("Location: $rul");
        exit;
    } else {
        echo "JSON Data parsing error!";
    }
}


function addToCart($productid, $conn)
{
    if (!isset($_SESSION["email"])) return false;
    $email = $_SESSION["email"];
    echo $email;
    $sql = "SELECT * FROM users WHERE email='$email'";
    $user = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($user);
    $id = $user["id"];
    $sql = "INSERT INTO cart(productId, userid) VALUES('$productid','$id')";
    return mysqli_query($conn, $sql);
}


function removeFromCart($productId, $conn)
{
    $sql = "DELETE FROM cart WHERE productId=$productId LIMIT 1";
    return mysqli_query($conn, $sql);
}

function removeItemFromCart($product, $conn)
{
    $userid = $_SESSION["userid"];
    $sql = "DELETE FROM cart WHERE productId=$product";
    return mysqli_query($conn, $sql);
}
