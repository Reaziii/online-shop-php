<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"]) && isset($_FILES["ex-image"]) && !empty($_FILES["image"]["name"]) && isset($_POST["catid"]) && isset($_POST["description"])) {
        include ROOT . "/uploads.php";
        include ROOT . "/db.php";

        $name = $_POST["name"];
        $filename = upload($_FILES["image"]);
        $name = $_POST["name"];
        $description = $_POST["description"];
        $cat = $_POST["catid"];
        $price = $_POST["price"];
        $sql = "INSERT INTO products(name, image, description, catagory, price) VALUES ('$name','$filename','$description','$cat', $price)";
        if (mysqli_query($conn, $sql)) {
            $id = mysqli_insert_id($conn);

            $files = restructure_files_array($_FILES["ex-image"]);
            $i = 0;
            $f = true;
            foreach ($files as $file) {
                if ($i == 5) break;
                $i++;
                $filename = upload($file);
                $sql = "INSERT INTO productImages(productId, file_name) VALUES('$id','$filename')";
                if (mysqli_query($conn, $sql)) {
                } else echo '<script>alert("something went wrong")</script>';
            }
        } else echo '<script>alert("something went wrong")</script>';
    } else echo "hello world";
    if (isset($_POST["delete-product"])) {
        include ROOT . "/db.php";
        $id = $_POST["delete-product"];

        $sql = "DELETE FROM productImages WHERE productId=$id";
        if (mysqli_query($conn, $sql)) {
            $sql = "DELETE FROM products WHERE id=$id";
            try {
                mysqli_query($conn, $sql);
            } catch (Exception $err) {
                echo '<script>alert("Something went wrong")</script>';
            }
        } else {
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
            Add Products
        </h1>

        <form action method="post" class="create-catagory" enctype="multipart/form-data">
            <p class="input1-level">Product Name</p>
            <input name="name" type="text" class="input1">
            <p class="input1-level">Catagory</p>
            <select name="catid" class="form-select" aria-label="Default select example">
                <?php
                $sql = "SELECT * FROM catagories";
                $query = mysqli_query($conn, $sql);
                while ($cat = mysqli_fetch_array($query)) :
                ?>
                    <option value="<?php echo $cat["id"] ?>"><?php echo $cat["name"] ?></option>
                <?php endwhile; ?>
            </select>
            <p class="input1-level">Description</p>
            <input name="price" class="input1" type="float" step="0.01">
            <p class="input1-level">Description</p>
            <textarea name="description" class="input1-level"></textarea>
            <p class="input1-level">Thumbnail</p>
            <img style="display : none" id="show-thumb" class="thumbnail">
            <input name="image" type="file" class="form-control" id="thumbnail">
            <p class="input1-level">Addtional Images (mx : 5)</p>
            <div id="additional-images">
            </div>
            <input name="ex-image[]" type="file" class="form-control" id="ex-image" multiple>
            <button class="btn-1 create-button">Create</button>
        </form>
        <table class="table">
            <tr>
                <td>ID</td>
                <td>name</td>
                <td>Catagory</td>
                <td>Photo</td>
                <td>Action</td>
            </tr>

            <?php
            $sql = "SELECT * FROM products";
            $query = mysqli_query($conn, $sql);

            while ($product = mysqli_fetch_array($query)) :
            ?>
                <tr>
                    <td class="trx">
                        <p><?php echo $product["id"] ?></p>
                    </td>
                    <td class="trx">
                        <p><?php echo $product["name"] ?></p>
                    </td>
                    <td class="trx">
                        <p><?php
                            $catid = $product["catagory"];
                            $sql = "SELECT * FROM catagories WHERE id=$catid";
                            $q = mysqli_query($conn, $sql);
                            $q = mysqli_fetch_array($q);
                            echo $q["name"];
                            ?></p>
                    </td>
                    <td class="trx">
                        <p><img src="<?php echo $product["image"] ?>" alt=""></p>
                    </td>
                    <td class="trx">
                        <form action method="POST">
                            <input name="delete-product" hidden type="text" value="<?php echo $product["id"] ?>">
                            <button class="btn-1">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>

        </table>


    </div>
</body>
<script>
    $("#thumbnail")[0].onchange = (e) => {
        $("#show-thumb")[0].setAttribute("src", URL.createObjectURL(e.target.files[0]));
        $("#show-thumb")[0].style.display = "unset";
    }
    $("#ex-image")[0].onchange = (e) => {
        $("#additional-images")[0].innerHTML = "";
        for (let i = 0; i < e.target.files.length && i < 5; i++) {
            let node = document.createElement("img");
            node.setAttribute("src", URL.createObjectURL(e.target.files[i]));
            $("#additional-images")[0].appendChild(node);
        }
    }
</script>

</html>