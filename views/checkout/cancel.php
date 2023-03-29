<?php

include ROOT . "/db.php";
$tran_id = $_POST["tran_id"];

try {
    $sessionString = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM orderSession WHERE orderid='$tran_id'"));
    $sessionString = $sessionString["session"];
    $_SESSION = json_decode($sessionString, true);
    mysqli_query($conn, "DELETE FROM orderSession WHERE orderid='$tran_id'");
    mysqli_query($conn, "DELETE FROM orderedProducts WHERE orderid='$tran_id'");
    mysqli_query($conn, "DELETE FROM orders WHERE turn_id='$tran_id'");
    header("Location: /cart");
} catch (Exception $err) {
    echo $err;
}
