<?php
require_once __DIR__ . '/router.php';

get("/", "views/index.php");
get("/admin", "views/admin/index.php");
any("/admin/login", "views/admin/login.php");
any("/logout", "views/logout.php");
any("/login","views/login.php");
any("/registration","views/registration.php");
any("/admin","views/admin/index.php");
any("/admin/catagories","views/admin/catagories.php");



