<?php
$email = "";
$password = "";
$phone = "";
$name = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include $_SERVER["DOCUMENT_ROOT"] . "/db.php";
    if (!isset($_POST["email"]) || !isset($_POST["password"]) || !isset($_POST["name"]) || !isset($_POST["phone"])) {
        echo '<script>alert("Please fillup all the fields")</script>';
    } else {
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $name = $_POST["name"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM users WHERE email='$email'or  phone='$phone'";
        $query = mysqli_query($conn, $sql);
        $cnt = mysqli_num_rows($query);
        if ($cnt > 0) {
            echo '<script>alert("Email or phone number already exist")</script>';
        } else {
            $password = md5($password);
            $sql = "SELECT * FROM users WHERE role='admin'";
            $cnt = mysqli_num_rows(mysqli_query($conn, $sql));
            $sql = "INSERT INTO users (email, password, name, phone) VALUES('$email','$password','$name','$phone')";
            if ($cnt == 0) {
                $sql = "INSERT INTO users (email, password, name, phone, role) VALUES('$email','$password','$name','$phone','admin')";
            }
            try {
                mysqli_query($conn, $sql);
                $_SESSION["email"] = $email;
                $_SESSION["name"] = $name;
                if ($cnt == 0) {
                    $_SESSION["role"] = "admin";
                } else $_SESSION["role"] = "member";
            } catch (Exception $e) {
                echo '<script>alert("Something went wrong")</script>';
                echo $e;
            }
        }
    }
}
if (isset($_SESSION["email"])) {
    header("Location: /profile");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/views/links.php";
    ?>

</head>
<!DOCTYPE html>
<html>


<body>
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/views/header.php" ?>
    <form action method="POST" class="login-box registration">
        <h3>Join Now!</h3>
        <p class="input1-level">Full name</p>
        <input name="name" value="<?php echo $name ?>" type="text" class="input1">
        <p class="input1-level">Phone Number</p>
        <input name="phone" value="<?php echo $phone ?>" type="text" class="input1">
        <p class="input1-level">Email</p>
        <input name="email" value="<?php echo $email ?>" type="text" class="input1">
        <p class="input1-level">Password</p>
        <input type="password" name="password" class="input1">
        <button class="btn-1">Register</button>
        <a href="/login">Already Have Account</a>
    </form>
</body>

</html>