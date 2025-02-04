<?php
	$sql = $koneksi->query("SELECT count(id_buku) as buku from tb_buku");
	while ($data= $sql->fetch_assoc()) {
	
		$buku=$data['buku'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(id_anggota) as agt from tb_anggota");
	while ($data= $sql->fetch_assoc()) {
	
		$agt=$data['agt'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(id_sk) as pin from tb_sirkulasi where status='PIN'");
	while ($data= $sql->fetch_assoc()) {
	
		$pinjam=$data['pin'];
	}
?>

<?php
	$sql = $koneksi->query("SELECT count(id_sk) as kem from tb_sirkulasi where status='KEM'");
	while ($data= $sql->fetch_assoc()) {
	
		$kem=$data['kem'];
	}
?>

<section class="container">
    <div class="nav-links">
        <h5>Dashboard Admin</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>                          
    </div>
    <div class="row">
        <div class="col-12 col-md-6 d-flex">
            <div class="card flex-fill border-0 illustration">
                <div class="card-body p-0 d-flex flex-fill">
                    <div class="row g-0 w-100">
                        <div class="col-6">
                            <div class="p-3 m-1">
                                <h4>Selamat Datang, 
                                    <span>
                                        <?php echo $data_user; ?>
                                    </span>
                                </h4>
                                <p class="mb-0">Dashboard Admin</p>
                            </div>
                        </div>
                        <div class="col-6 align-self-end text-end">
                            <img src="images/admin.png" class="img-fluid illustration-img-admin"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 d-flex">
            <div class="card flex-fill border-0 illustration">
                <div class="card-body p-0 d-flex flex-fill">
                    <div class="row g-0 w-100">
                        <div class="col-6">
                            <div class="p-3 m-1">
                                <h4>Jumlah Buku</h4>
                                <p class="mb-2">Buku yang tersedia pada perpustaka saat ini:
                                    <b>
                                        <?= $buku; ?>
                                    </b>
                                    Buku
                                </p>
                                <a href="?page=data_buku" class="small-box-footer">info lebih lanjut
                                    <i class="fa-regular fa-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-6 align-self-end text-end">
                            <img src="images/buku.png" class="img-fluid illustration-img"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 d-flex">
            <div class="card flex-fill border-0 illustration">
                <div class="card-body p-0 d-flex flex-fill">
                    <div class="row g-0 w-100">
                        <div class="col-6">
                            <div class="p-3 m-1">
                                <h4>Jumlah Anggota</h4>
                                <p class="mb-2">Anggota yang terdaftar pada perpustaka saat ini:
                                    <b>
                                        <?= $agt; ?>
                                    </b>
                                    Anggota
                                </p>
                                <a href="?page=data_anggota" class="small-box-footer">info lebih lanjut
                                    <i class="fa-regular fa-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-6 align-self-end text-end">
                            <img src="images/anggota.png" class="img-fluid illustration-img"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 d-flex">
            <div class="card flex-fill border-0 illustration">
                <div class="card-body p-0 d-flex flex-fill">
                    <div class="row g-0 w-100">
                        <div class="col-6">
                            <div class="p-3 m-1">
                                <h4>Peminjaman Buku</h4>
                                <p class="mb-2">Anggota yang meminjam buku pada perpustaka saat ini:
                                    <b>
                                        <?= $pinjam; ?>
                                    </b>
                                    Anggota
                                </p>
                                <a href="?page=log_pinjam" class="small-box-footer">info lebih lanjut
                                    <i class="fa-regular fa-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-6 align-self-end text-end">
                            <img src="images/buku_pinjam.png" class="img-fluid illustration-img"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 d-flex">
            <div class="card flex-fill border-0 illustration">
                <div class="card-body p-0 d-flex flex-fill">
                    <div class="row g-0 w-100">
                        <div class="col-6">
                            <div class="p-3 m-1">
                                <h4>Pengembalian Buku</h4>
                                <p class="mb-2">Anggota yang mengembalikan buku pada perpustaka saat ini:
                                    <b>
                                        <?= $kem; ?>
                                    </b>
                                    Anggota
                                </p>
                                <a href="?page=log_kembali" class="small-box-footer">info lebih lanjut
                                    <i class="fa-regular fa-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-6 align-self-end text-end">
                            <img src="images/buku_kembali.jpg" class="img-fluid illustration-img"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
