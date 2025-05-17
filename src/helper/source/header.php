<header>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="./">
                <img src="helper/img/logo.png" alt="Logo" srcset="" width="43px">
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="toggler-icon top-bar"></span>
                <span class="toggler-icon middle-bar"></span>
                <span class="toggler-icon bottom-bar"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link link" aria-current="page" href="./"><img src="helper/icon/house.png" class="img-nav-link" /> หน้าหลัก</a>
                    <a class="nav-link link" href="list-item"><img src="helper/icon/costing.png" class="img-nav-link" /> ทะเบียนครุภัณฑ์</a>
                    <a class="nav-link link" href="report_repair"><img src="helper/icon/repair-tools.png" class="img-nav-link" /> แจ้งซ่อมครุภัณฑ์</a>

                    <?php
                    if (isset($_SESSION['role'])) {
                        include_once 'helper/server/data_user.php';
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['role']) && $_SESSION['role'] == '2') {
                        include 'helper/server/status.php'; ?>
                        <div class="notification">
                            <a class="nav-link link" href="dashboard_repair"><img src="helper/icon/danger.png" class="img-nav-link" /> รายการซ่อม</a>
                            <?php if ($total5 != 0) { ?>
                                <span class="badge notification-badge"><?php echo $total5; ?></span>
                            <?php
                            }
                            ?>
                        </div>
                    <?php } ?>
                    <a class="nav-link link" href="status_repair"><img src="helper/icon/check-list.png" class="img-nav-link" /> สถานะการซ่อม</a>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == '4') { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="helper/icon/data-complexity.png" class="img-nav-link" /> จัดการฐานข้อมูล
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link dropdown-margin link" href="m_user"><img src="helper/icon/add-user.png" class="img-nav-link" /> ผู้ใช้</a></li>

                                <li><a class="nav-link dropdown-margin link" href="m_institute"><img src="helper/icon/enterprise.png" class="img-nav-link" /> หน่วยงาน</a></li>
                            </ul>
                        </li>
                    <?php
                    }
                    ?>

                </div>
            </div>
            <?php
            if (isset($_SESSION['role'])) {
                if (isset($data_user['profile_pic']) && !empty($data_user['profile_pic'])) { ?>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link link" aria-current="page" href="profile">
                                <div class="profile">
                                    <img src="<?php echo 'helper/data/profile/' . $data_user['profile_pic'] ?>" alt="Profile" srcset="">
                                    <span><?php echo $data_user['name'] ?> </span>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link link" aria-current="page" href="profile">
                                <span><?php echo $data_user['name'] ?></span><img src="helper/icon/none-profile.svg" alt="user" srcset="" width="45px">
                            </a>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link link" href="login"><i class="fa-solid fa-right-to-bracket"></i> ล็อคอิน</a>
                    </div>
                </div>
            <?php
            }
            ?>


        </div>
    </nav>
</header>