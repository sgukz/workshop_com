<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand font-weight-bold" href="#">Roi-Et Hospital</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">
                        &nbsp;
                    </a>
                </li>
            </ul>
            <?php
                $active_com = "";
                $active_print = "";
                $color_com = "";
                $color_print = "";
                if(isset($_GET["page"])){
                    if($_GET["page"] === "showdata-computer"){
                        $active_com = "active";
                        $color_com = "text-warning";
                    }else if($_GET["page"] === "showdata-printer"){
                        $active_print = "active";
                        $color_print = "text-warning";
                    }
                }
            ?>
            <ul class="navbar-nav">
                <li class="nav-item <?=$active_com?>">
                    <a class="nav-link <?=$color_com?> font-weight-bold" href="?page=showdata-computer">
                        จัดการคอมพิวเตอร์
                    </a>
                </li>
                <li class="nav-item <?=$active_print?>">
                    <a class="nav-link <?=$color_print?> font-weight-bold" href="?page=showdata-printer">
                        จัดการปริ้นเตอร์
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light font-weight-bold" href="#">
                        <?=isset($_SESSION["user_login"])? $_SESSION["user_login"] : ""?>
                    </a>
                </li>
                <li class="nav-item <?=$active_print?>">
                    <a class="btn btn-danger btn-sm nav-link font-weight-bold" id="logout">
                        ออกจากระบบ
                    </a>
                </li>
            </ul>
        </div>
    </nav>