<?php
include ROOT . "/db.php";
$sql = "SELECT * FROM orders";
if (isset($_GET["status"])) {
    $status = $_GET["status"];
    $sql = "SELECT * FROM orders WHERE status='$status'";
}
if (isset($_POST["changestatus"])) {
    $status = $_POST["changestatus"];
    $orderid = $_POST["orderid"];

    mysqli_query($conn, "UPDATE orders SET status='$status' WHERE turn_id='$orderid'");
}

$orders_query = mysqli_query($conn, $sql);
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
    <?php include ROOT . "/views/Admin/nav.php" ?>
    <div class="admin-dash">
        <h1 class="title">Orders</h1>
        <div class="btn-group">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Status
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="?">All</a></li>
                <li><a class="dropdown-item" href="?status=pending">Pending</a></li>
                <li><a class="dropdown-item" href="?status=shipped">Shipped</a></li>
                <li><a class="dropdown-item" href="?status=cancel">Canceled</a></li>
            </ul>
        </div>
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
                            <form id="<?php echo $orderid ?>" action method="post">
                                <input name="orderid" hidden value="<?php echo $orderid ?>">
                                <input type="text" hidden name="changestatus" value="<?php echo $order["status"] ?>">

                            </form>
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $order["status"] ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a form="<?php echo $orderid ?>" class="dropdown-item pending ">Pending</a></li>
                                    <li><a form="<?php echo $orderid ?>" class="dropdown-item shipped">Shipped</a></li>
                                    <li><a form="<?php echo $orderid ?>" class="dropdown-item cancel">Cancel</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>

    </div>
</body>

<script>
    $('.pending').map((i, item) => {
        item.addEventListener("click", () => {
            let id = item.getAttribute("form");
            let value = document.getElementById(id).elements['changestatus'].value = "pending";
            document.getElementById(id).submit();
        })
    })
    $('.shipped').map((i, item) => {
        item.addEventListener("click", () => {
            let id = item.getAttribute("form");
            let value = document.getElementById(id).elements['changestatus'].value = "shipped";
            document.getElementById(id).submit();

        })
    })
    $('.cancel').map((i, item) => {
        item.addEventListener("click", () => {
            let id = item.getAttribute("form");
            let value = document.getElementById(id).elements['changestatus'].value = "cancel";
            document.getElementById(id).submit();

        })
    })
</script>

</html>