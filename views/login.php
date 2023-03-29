<?php
$email = "";
$password = "";
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    header("Location: /profile");
    die();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["password"])) {
    include ROOT . "/db.php";
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password = md5($password);
    $sql = "SELECT * FROM users WHERE email='$email' and password='$password'";
    $query = mysqli_query($conn, $sql);
    $user = mysqli_fetch_array($query);
    $count = mysqli_num_rows($query);
    if ($count == 0) {
        echo '<script>alert("Incorrect information")</script>';
    } else {
        $_SESSION["email"] = $email;
        $_SESSION["name"] = $user["name"];
        $_SESSION["role"] = $user["role"];
        $_SESSION["proImage"] = $user["proImage"];
        $_SESSION["userid"] = $user["id"];
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
    <?php include ROOT . "/views/links.php";
    ?>

</head>
<!DOCTYPE html>
<html>


<body>
    <?php include ROOT . "/views/header.php" ?>
    <form action method="POST" class="login-box">
        <h3>Welcome Back!</h3>
        <p class="input1-level">Email</p>
        <input name="email" value="<?php echo $email ?>" type="text" class="input1">
        <p class="input1-level">Password</p>
        <input type="password" name="password" class="input1">
        <button class="btn-1">Login</button>
        <a href="/registration">Create New Account</a>
    </form>
</body>

</html>