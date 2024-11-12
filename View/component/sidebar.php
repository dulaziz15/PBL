<?php
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);

    $url = $uri_segments[3];
?>
<div class="sidebar">
            <div class="logo">
                <img src="../../src/img/logo.png" alt="">
            </div>
            <ul>
                <li>
                    <div class="menu <?= $url == 'dashboard' ? 'active' : '' ?>">
                        <div class="icon">
                            <i class="fa-solid fa-gauge"></i>
                        </div>
                        <a href="../../routes/route.php?page=dashboard">Dashboard</a>
                    </div>
                </li>
                <?php
                    if($_SESSION['user']['role'] == 1) {
                ?>
                <li>
                    <div class="title">
                        <span>Data Master</span>
                    </div>
                </li>
                <li>
                    <div class="menu <?= $url == 'user' ? 'active' : '' ?>">
                        <div class="icon">
                            <i class="fa-solid fa-gauge"></i>
                        </div>
                        <a href="../../routes/route.php?page=user&sub=manageuser">Data User</a>
                    </div>
                </li>
                <li>
                    <div class="menu <?= $url == 'mahasiswa' ? 'active' : '' ?>">
                        <div class="icon">
                            <i class="fa-solid fa-gauge"></i>
                        </div>
                        <a href="../../routes/route.php?page=mahasiswa&sub=managemahasiswa">Data Mahasiswa</a>
                    </div>
                </li>
                <li>
                    <div class="menu <?= $url == 'dokumen_ta' ? 'active' : '' ?>">
                        <div class="icon">
                            <i class="fa-solid fa-gauge"></i>
                        </div>
                        <a href="../../routes/route.php?page=tugasakhir&sub=manageTA">Data Dokumen TA</a>
                    </div>
                </li>
                <?php
                    } elseif($_SESSION['user']['role'] == 2) {
                ?>
                <li>
                    <div class="menu <?= $url == "biodata" ? 'active' : '' ?>">
                        <div class="icon">
                            <i class="fa-solid fa-gauge"></i>
                        </div>
                        <a href="../../routes/route.php?page=biodata&sub=managebiodata">biodata</a>
                    </div>
                </li>
                <?php
                    }
                ?>
            </ul>
            <a href="../../routes/route.php?page=logout" class="logout">
                <li class="logout-btn">
                    <div class="">Logout</div>
                </li>
            </a>
        </div>