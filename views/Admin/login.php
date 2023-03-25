<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap v5.2 Design Login Forms</title>
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/views/links.php" ?>
</head>

<body>
    <div class="vh-100 d-flex justify-content-center align-items-center ">
        <div class="col-md-5 p-5 shadow-sm border rounded-5 border-primary bg-white">
            <h2 class="text-center mb-4 text-primary">Login Form</h2>
            <form method="POST" action>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control border border-primary" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control border border-primary" id="exampleInputPassword1">
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_SESSION["admin-email"])) {
    header("Location: /admin");
    die();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        include $_SERVER["DOCUMENT_ROOT"] . "/db.php";
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password = md5($password);
        $sql = "SELECT * FROM administrator WHERE email='$email' and password='$password'";
        $query = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($query);
        if ($count < 1) {
            echo '<script>alert("email or password is incorrect")</script>';
        } else {
            $user = mysqli_fetch_array($query);
            $_SESSION["admin-email"] = $email;
            $_SESSION["admin-name"] = $user["name"];
            $_SESSION["admin-image"] = $user["proImage"];
            header("Location: /admin");
            die();
        }
    }
}
