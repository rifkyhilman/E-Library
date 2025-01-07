<?php
	include "../../db/conn.php";
    
    $carikode = mysqli_query($koneksi,"SELECT id_anggota FROM tb_anggota order by id_anggota desc");
    $datakode = mysqli_fetch_array($carikode);
    $kode = $datakode['id_anggota'];
    $urut = substr($kode, 1, 3);
    $tambah = (int) $urut + 1;
    $kode_unik= strlen($tambah);

    if ($kode_unik === 1){
        $format = "A00{$tambah}";
    }elseif ($kode_unik === 2){
        $format = "A0{$tambah}";
    }else {
        $format = "A{$tambah}";
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../images/logo-smait.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>

    <link rel="stylesheet" href="../../css/auth.css">
    <title>Daftar Anggota</title>
</head>

<body>

    <!-- blue circle background -->
    <!-- <div class="d-none d-md-block ball register bg-primary bg-gradient position-absolute rounded-circle"></div> -->

    <!-- Register Section -->
    <section class="container register__form active">
        <div class="row vh-100 w-100 align-self-center">
            <div class="d-none d-lg-block col-lg-6 col-xl-6 p-5">
                <div class="row vh-100 p-5">
                    <div class="col align-self-center p-5 text-center">
                        <img src="../../images/anugrah-abadi.png" class="bounce img-signup" alt="">
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-6 px-5">
                <div class="row vh-100">
                    <div class="col align-self-center p-5 w-100">
                        <h3 class="fw-bolder">DAFTAR ANGGOTA</h3>
                        <p class="fw-lighter fs-6">Sudah Punya Akun ? <span id="signIn" role="button" class="text-primary"><a href="login.php" class="link_a">Login</a></span></p>
                        <!-- form register section -->
                        <form action="#" method="post" class="mt-5">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3" placeholder="Nama" Required>
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3" placeholder="Username" Required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="d-flex position-relative">
                                    <input type="password" name="password" class="form-control text-indent auth__password shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3">
                                    <span class="password__icon text-primary fs-4 fw-bold bi bi-eye-slash"></span>
                                </div>
                            </div>
                            <div class="col text-center">
                                <button type="submit" name="btnRegister" class="btn btn-outline-dark btn-lg rounded-pill mt-4 w-100">Daftar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="../../js/auth.js"></script>
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>

 <?php

    if (isset ($_POST['btnRegister'])){
    
        $sql_simpan = "INSERT INTO tb_anggota (id_anggota,nama,jekel,kelas,no_hp) 
            VALUES (
                '".$format."',
                '".$_POST['nama']."',
                '".null."',
                '".null."',
                '".null."' )";

        $sql_simpan2 = "INSERT INTO tb_pengguna (nama_pengguna, username, password, level) 
            VALUES (
                '".$_POST['nama']."',
                '".$_POST['username']."',
                '".md5($_POST['password'])."',
                '"."Anggota"."')";

            
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        $query_simpan2 = mysqli_query($koneksi, $sql_simpan2);


        if ($query_simpan && $query_simpan2){
            echo "<script>
                Swal.fire({title: 'Daftar Akun Berhasil',
                    text: '',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                    window.location = 'login.php';
                    }
                }) 
                </script>";
        }else{
            echo "<script>
                Swal.fire({title: 'Daftar AKun Gagal !',
                    text: '',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                    window.location = 'register.php';
                    }
                })</script>";        
        }
    }

 ?>