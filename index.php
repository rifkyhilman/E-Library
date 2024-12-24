<?php
    //KONEKSI DB
    include "db/conn.php";

    //Mulai Sesion
    session_start();
    if (isset($_SESSION["ses_username"]) == "") {
        header("location: auth/login.php");
    } else {
        $data_id = $_SESSION["ses_id"];
        $data_nama = $_SESSION["ses_nama"];
        $data_user = $_SESSION["ses_username"];
        $data_level = $_SESSION["ses_level"];
    }

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Library</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="index.php">
                        <img src="images/logo-smait.png" class="logo-img" alt="">
                        <span>E-Library</span>
                    </a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        --- MENU ADMIN
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=admin" class="sidebar-link">
                            <i class="fa-solid fa-gauge pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-solid fa-folder pe-2"></i>
                            Kelola Data
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="?page=data_buku" class="sidebar-subs">
                                    <i class="fa-solid fa-book pe-2"></i>
                                    Data Buku</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="?page=data_anggota" class="sidebar-subs">
                                    <i class="fa-solid fa-users pe-2"></i>
                                    Data Anggota</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=data_sirkul" class="sidebar-link" aria-expanded="false">
                            <i class="fa-solid fa-repeat pe-2"></i>
                            Sirkulasi
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#posts" data-bs-toggle="collapse"
                            aria-expanded="false">
                            <i class="fa-solid fa-arrow-down-up-across-line pe-2"></i>
                            Log Data
                        </a>
                        <ul id="posts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="?page=log_pinjam" class="sidebar-subs">
                                    <i class="fa-solid fa-arrow-up pe-2"></i>
                                    Peminjaman
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="?page=log_kembali" class="sidebar-subs">
                                    <i class="fa-solid fa-arrow-down pe-2"></i>
                                    Pengembalian
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-print pe-2"></i>
                            Laporan
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-subs">
                                    <i class="fa-solid fa-file pe-2"></i>
                                    Laporan Sirkulasi
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-header">
                        --- ADMIN MENU
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link" aria-expanded="false">
                            <i class="fa-solid fa-user-plus pe-2"></i>
                            Pengguna Sistem
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="images/profile.jpg" class="avatar" alt="">
                                <span class="profile-name">
        							<?php echo $data_nama; ?>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="auth/logout.php" onclick="return confirm('Anda yakin keluar dari aplikasi ?')" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <?php
                        if (isset($_GET['page'])) {
                            $hal = $_GET['page'];

                            switch ($hal) {
                                case 'admin':
                                    include "pages/admin/dashboard.php";
                                    break;
                                case 'data_buku':
                                    include "pages/admin/buku/data_buku.php";
                                    break;
                                case 'data_anggota':
                                    include "pages/admin/anggota/data_anggota.php";
                                    break;
                                case 'data_sirkul':
                                    include "pages/admin/sirkulasi/data_sirkul.php";
                                    break;
                                case 'log_pinjam':
                                    include "pages/admin/log/log_pinjam.php";
                                    break;
                                case 'log_kembali':
                                    include "pages/admin/log/log_kembali.php";
                                    break;
                                default:
                                    echo "<center><br><br><br><br><br><br><br><br><br>
                                    <h1> Halaman tidak ditemukan !</h1></center>";
                                    break;
                            }
                        } else {
                            // Auto Halaman Home Pengguna
                            if ($data_level == "Administrator") {
                                include "pages/admin/dashboard.php";
                            } elseif ($data_level == "Petugas") {
                                include "home/petugas.php";
                            }
                        }
				    ?>
                </div>
            </main>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    <strong>@2024</strong>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>