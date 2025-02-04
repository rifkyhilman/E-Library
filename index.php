<?php
    include "db/conn.php";
    session_start();

    if (isset($_SESSION["ses_username"]) == "") {
        header("location: pages/auth/login.php");
    } else {
        $data_id = $_SESSION["ses_id"];
        $data_user = $_SESSION["ses_username"];
        $data_level = $_SESSION["ses_level"];

		$sql_getAgt = "SELECT id_anggota, nama, foto_profile FROM tb_anggota WHERE BINARY username='$data_user'";
		$query_getAgt = mysqli_query($koneksi, $sql_getAgt);
		$data_agt = mysqli_fetch_array($query_getAgt,MYSQLI_BOTH);
    }

?>

<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" href="images/anugrah-abadi.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>E-Library</title>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="index.php">
                        <img src="images/anugrah-abadi.png" class="logo-img" alt="">
                        <span>E-Library</span>
                    </a>
                </div>
                <ul class="sidebar-nav"> 
                    <?php
                        if ($data_level === "Admin") {
                    ?>
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
                                <a href="?page=lapor_sirkul" class="sidebar-subs">
                                    <i class="fa-solid fa-file pe-2"></i>
                                    Laporan Sirkulasi
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="pages/auth/logout.php" class="sidebar-link" aria-expanded="false"> 
                            <i class="fa-solid fa-power-off pe-2"></i>
                            Logout
                        </a>
                    </li>
                    <?php 
                        } else {
                    ?>
                    <li class="sidebar-header">
                        --- MENU ANGGOTA
                    </li>
                    <li class="sidebar-item">
                        <a href="/E-Library" class="sidebar-link">
                            <i class="fa-solid fa-gauge pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=katalog_buku" class="sidebar-link">
                            <i class="fa-solid fa-book pe-2"></i>
                            Katalog Buku
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=riwayat_pjm" class="sidebar-link">
                            <i class="fa-solid fa-timeline pe-2"></i>
                            Riwayat Pinjam
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="?page=profile&kode=<?php echo $data_agt[0] ?>" class="sidebar-link">
                            <i class="fa-solid fa-user pe-2"></i>
                            Data Pribadi
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="pages/auth/logout.php" class="sidebar-link" aria-expanded="false"> 
                            <i class="fa-solid fa-power-off pe-2"></i>
                            Logout
                        </a>
                    </li>
                    <?php
                        }
                    ?>
                    <!-- Menu Admin  -->
                    <!-- <li class="sidebar-header">
                        --- ADMIN MENU
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link" aria-expanded="false">
                            <i class="fa-solid fa-user-plus pe-2"></i>
                            Pengguna Sistem
                        </a>
                    </li> -->
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom navbar-main">
                <button class="btn" id="sidebar-toggle" type="button">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <p id="Date_Time"></p>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <?php 
                                if($data_level === "Anggota"&& $data_agt[2] !== ""){
                            ?>
                                <img src="images/profile/<?php echo $data_agt[2] ?>" class="avatar" alt="">        
                                <span class="profile-name">
                                    <?php echo $data_agt[1]; ?>
                                </span>
                            <?php
                                }elseif($data_level === "Admin")  { 
                            ?>
                                <img src="images/profile.png" class="avatar" alt="">
                                <span class="profile-name">
                                    <?php echo $data_user; ?>
                                </span>
                            <?php 
                                }else {
                            ?>
                                <img src="images/profile.png" class="avatar" alt="">
                                <span class="profile-name">
                                    <?php echo $data_agt[1]; ?>
                                </span>
                            <?php
                                };
                            ?>
                    
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <?php
                        $path = "images/";
                        $img404 = "404.png";

                        if (isset($_GET['page'])) {
                            $hal = $_GET['page'];

                            switch ($hal) {
                                case 'admin':
                                    include "pages/admin/dashboard.php";
                                    break;
                                case 'user':
                                    include "pages/user/dashboard.php";
                                    break;
                                case 'profile':
                                    include "pages/user/profile.php";
                                    break;
                                case 'katalog_buku':
                                    include "pages/user/katalog_buku.php";
                                    break;
                                case 'riwayat_pjm':
                                    include "pages/user/riwayat_pinjam.php";
                                    break;
                                case 'data_buku':
                                    include "pages/admin/buku/data_buku.php";
                                    break;
                                case 'add_buku':
                                    include "pages/admin/buku/add_buku.php";
                                    break;
                                case 'edit_buku':
                                    include "pages/admin/buku/edit_buku.php";
                                    break;
                                case 'del_buku':
                                    include "pages/admin/buku/del_buku.php";
                                    break;
                                case 'data_anggota':
                                    include "pages/admin/anggota/data_anggota.php";
                                    break;
                                case 'add_anggota':
                                    include "pages/admin/anggota/add_anggota.php";
                                    break;
                                case 'edit_anggota':
                                    include "pages/admin/anggota/edit_anggota.php";
                                    break;
                                case 'del_anggota':
                                    include "pages/admin/anggota/del_anggota.php";
                                    break;
                                case 'print_anggota':
                                    include "pages/admin/anggota/print_anggota.php";
                                    break;
                                case 'printall_anggota':
                                    include "pages/admin/anggota/printall_anggota.php";
                                    break;
                                case 'data_sirkul':
                                    include "pages/admin/sirkulasi/data_sirkul.php";
                                    break;
                                case 'add_sirkul':
                                    include "pages/admin/sirkulasi/add_sirkul.php";
                                    break;
                                case 'edit_sirkul':
                                    include "pages/admin/sirkulasi/edit_sirkul.php";
                                    break;
                                case 'del_sirkul':
                                    include "pages/admin/sirkulasi/del_sirkul.php";
                                    break;
                                case 'lapor_sirkul':
                                    include "pages/admin/sirkulasi/lapor_sirkul.php";
                                    break;
                                case 'print_lprsirkul':
                                    include "pages/admin/sirkulasi/print_lprsirkul.php";
                                    break;
                                case 'log_pinjam':
                                    include "pages/admin/log/log_pinjam.php";
                                    break;
                                case 'log_kembali':
                                    include "pages/admin/log/log_kembali.php";
                                    break;
                                default:
                                    echo '<center><br><br><br><br><br><br><br><br><br>
                                    <img src="'.$path.$img404.'" class="img-error">
                                    <h3> Halaman tidak ditemukan !</h3></center>
                                    <br><br><br><br><br><br><br><br><br>';
                                    break;
                            }
                        } else {
                            if ($data_level == "Admin") {
                                include "pages/admin/dashboard.php";
                            } elseif ($data_level == "Anggota") {
                                include "pages/user/dashboard.php";
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
                                    <strong>Perpustakaan Anugerah Abadi @2024</strong>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="./js/script.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        $(function() {
            $("#Table1").DataTable({
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                language: {
                    info: 'Halaman _PAGE_ dari _PAGES_',
                    infoEmpty: 'Halaman _PAGE_ dari _PAGES_',
                    emptyTable: 'Tidak ada data',
                    lengthMenu: '_MENU_',
                    search: 'Filter:    ',
                    zeroRecords: 'Tidak ada data'
                },
                layout: {
                    topStart: 'pageLength',
                    topEnd: 'search',
                    bottomStart: 'info',
                    bottomEnd: 'paging'
                }
            });
        });
	</script>
    <script type="text/javascript">
      document.getElementById("image").onchange = function(){
          document.getElementById("form").submit();
      };
    </script>
</body>

</html>