<div class="header">
    <div class="logo-item">
        <a href="/">
            <img src="/assets/logo.svg" alt="">
        </a>
    </div>
    <div class="menu-items">
        <ul class="items">
            <li><a href="/">Home</a></li>
            <li><a href="/">About us</a></li>
            <li><button style="cursor : pointer;" id="catatories">Categories</button>
            </li>
            <li>
                <?php
                if (isset($_SESSION["name"])) {
                    $name = $_SESSION["name"];
                    $link = "/profile";
                    if($_SESSION["role"]=="admin") $link = "/admin";
                    echo "<a href='$link'>$name</a>";
                }
                else  echo "<a href='/login'>Login</a>";
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
            <li><a href="/">
                    <img src="/assets/shopping-bag.svg" alt="">
                    <p>(0)</p>
                </a>
            </li>
            
        </ul>
    </div>

    <div id="catagories-tab" class="catagories">
        <div class="c-item">
            <div class="icon">
                <img src="/assets/Apple-iPhone-12-PNG-Photo.png">
            </div>
            <p>Mobile phones</p>
        </div>
        <div class="c-item">
            <div class="icon">
                <img src="/assets/Car-PNG-Picture.png">
            </div>
            <p>Automobiles and cars</p>
        </div>
        <div class="c-item">
            <div class="icon">
                <img src="/assets/Home-Appliance-Background-PNG.png">
            </div>
            <p>Home applicances</p>
        </div>
        <div class="c-item">
            <div class="icon">
                <img src="/assets/Sofa-Transparent-Background.png">
            </div>
            <p>Furnitures</p>
        </div>
        <div class="c-item">
            <div class="icon">
                <img src="/assets/pngwing.com.png">
            </div>
            <p>Office equipments</p>
        </div>
    </div>
</div>


<script>
    $("#catatories")[0].addEventListener("click", () => {
        $("#catagories-tab")[0].classList.toggle("active");
    })
</script>