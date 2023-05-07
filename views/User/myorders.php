<?php
include ROOT . "/db.php";
$userid = $_SESSION["userid"];
$orders_query = mysqli_query($conn, "SELECT * FROM orders WHERE userid=$userid");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include ROOT . '/views/links.php' ?>

</head>

<body>
    <?php include ROOT . "/views/header.php" ?>
    <div class="myorders">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Products</th>
                    <th scope="col">Notes</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>

                <?php
                while ($order = mysqli_fetch_array($orders_query)) :
                ?>
                    <tr>
                        <th scope="row"><?php echo $order["turn_id"] ?></th>
                        <td><?php echo $order["name"] ?></td>
                        <td><?php echo $order["phone"] ?></td>
                        <td><?php echo $order["address"] ?></td>
                        <td>
                            <?php
                            $orderid = $order["turn_id"];
                            $sql = "SELECT * FROM orderedProducts WHERE orderid='$orderid'";
                            $product_query = mysqli_query($conn, $sql);
                            while ($product = mysqli_fetch_array($product_query)) :
                            ?>
                                <?php
                                $proid = $product["productId"];
                                $product = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM products WHERE id=$proid"));
                                ?>
                                <a href="/product/<?php echo $proid ?>"><?php echo $product["name"] ?></a><br />
                            <?php endwhile; ?>
                        </td>
                        <td><?php echo $order["notes"] ?></td>
                        <td>
                            <?php echo $order["status"] ?>

                        </td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
    <?php include ROOT . "/views/footer.php" ?>
</body>

</html>