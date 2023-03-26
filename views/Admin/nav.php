<?php
if (!isset($_SESSION["email"]) || $_SESSION["role"] != "admin") {
  header("Location: /login");
  die();
}
?>
<nav class="head-nav">
    <img src="<?php echo $_SESSION["proImage"]; ?>">
    <div class="name-sec">
        <p>Admin</p>
        <p class="name"><?php echo $_SESSION["name"] ?></p>
    </div>
    <a href="/logout"><img src="/assets/icons8-login-rounded-100.png"></a>

</nav>
<nav class="side-nav">
    <div class="logo-sec">
        <img src="/assets/logo.svg" alt="">
        <p>ELAVI BD</p>
    </div>
    <div class="menu-items">
        <a href="/"><p>Dashboard</p></a>
        <a href="/admin/catagories"><p>Catagories</p></a>
        <a href="/"><p>Products</p></a>
        <a href="/"><p>Users</p></a>
        <a href="/"><p>Orders</p></a>
    </div>
</nav>