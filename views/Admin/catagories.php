<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"]) && $_FILES["file"]) {
        include ROOT . "/uploads.php";
        include ROOT . "/db.php";

        $name = $_POST["name"];
        $file = $_FILES["file"];
        $filename = upload($file);
        $sql = "INSERT INTO catagories (name, photo) VALUES ('$name','$filename')";
        try {
            mysqli_query($conn, $sql);
            echo '<script>alert("Catagories created successfully")</script>';
        } catch (Exception $err) {
            echo '<script>alert("Something went wrong")</script>';
        }
    }
    if (isset($_POST["delete-catagory"])) {
        include ROOT . "/db.php";
        $id = $_POST["delete-catagory"];
        $sql = "DELETE FROM catagories WHERE id=$id";
        try {
            mysqli_query($conn, $sql);
        } catch (Exception $err) {
            echo '<script>alert("Something went wrong")</script>';
        }
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
    <?php
    include ROOT . "/views/links.php";
    include ROOT . "/db.php";
    ?>
</head>

<body>
    <?php
    include ROOT . "/views/Admin/nav.php";
    ?>

    <div class="admin-dash">
        <h1 class="title">
            Add Catagories
        </h1>

        <form action method="post" class="create-catagory" enctype="multipart/form-data">
            <p class="input1-level">Catagory Name</p>
            <input name="name" type="text" class="input1">
            <p class="input1-level">Catagory Logo</p>
            <input name="file" type="file" class="form-control" id="inputGroupFile02">
            <button class="btn-1 create-button">Create</button>
        </form>

        <table class="table">
            <tr>
                <td>ID</td>
                <td>name</td>
                <td>Photo</td>
                <td>Action</td>
            </tr>

            <?php
            $sql = "SELECT * FROM catagories";
            $query = mysqli_query($conn, $sql);

            while ($catagory = mysqli_fetch_array($query)) :
            ?>
                <tr>
                    <td class="trx">
                        <p><?php echo $catagory["id"] ?></p>
                    </td>
                    <td class="trx">
                        <p><?php echo $catagory["name"] ?></p>
                    </td>
                    <td class="trx">
                        <p><img src="<?php echo $catagory["photo"] ?>" alt=""></p>
                    </td>
                    <td class="trx">
                        <form action method="POST">
                            <input name="delete-catagory" hidden type="text" value="<?php echo $catagory["id"] ?>">
                            <button class="btn-1">Delete</button>
                        </form>
                    </td>
                </tr>


            <?php endwhile; ?>

        </table>


    </div>
</body>

</html>