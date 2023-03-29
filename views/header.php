<div class="header">
    <div class="logo-item">
        <a href="/">
            <img src="/assets/logo.svg" alt="">
        </a>
    </div>
    <div class="menu-items">
        <ul class="items">
            <li><a href="/">Home</a></li>
            <li><a href="/shop">Shop</a></li>
            <li><button style="cursor : pointer;" id="catatories">Categories</button>
            </li>
            <li>
                <?php
                if (isset($_SESSION["name"])) {
                    $name = $_SESSION["name"];
                    $link = "/profile";
                    if ($_SESSION["role"] == "admin") $link = "/admin";
                    echo "<a href='$link'>$name</a>";
                } else  echo "<a href='/login'>Login</a>";
                ?>

            </li>
        </ul>
        <ul class="account-items">
            <li><a href="/profile">
                    <img src="/assets/user.svg" alt="">
                </a></li>
            <!-- <li><a href="/">
                    <img src="/assets/icons8-login-rounded-100.png" alt="">
                </a>
            </li> -->
            <li><a href="/cart">
                    <img src="/assets/shopping-bag.svg" alt="">
                    <p>(<?php
                        $cnt = 0;
                        if (isset($_SESSION["userid"])) {
                            $userid = $_SESSION["userid"];
                            $sql = "SELECT * FROM cart WHERE userid=$userid";
                            $cnt = mysqli_num_rows(mysqli_query($conn, $sql));
                        }
                        echo $cnt;
                        ?>)</p>
                </a>
            </li>

        </ul>
    </div>

    <div id="catagories-tab" class="catagories">
        <?php
        $catagories = mysqli_query($conn, "SELECT * FROM catagories");
        while ($catagory = mysqli_fetch_array($catagories)) :

        ?>
            <div class="c-item">
                <div class="icon">
                    <img src="<?php echo $catagory["photo"] ?>">
                </div>
                <p><?php echo $catagory["name"] ?></p>
            </div>

        <?php endwhile; ?>
    </div>
</div>


<script>
    $("#catatories")[0].addEventListener("click", () => {
        $("#catagories-tab")[0].classList.toggle("active");
    })
</script>