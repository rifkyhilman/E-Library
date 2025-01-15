<?php
  
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

<section class="container">
    <div class="nav-links">
        <h5>Tambah Data Anggota</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/E-library/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="?page=data_anggota">Anggota</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah_Anggota</li>
            </ol>
        </nav>                          
    </div>
    <div class="box-page">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group inpt">
                    <label>ID anggota</label>
                    <input type="text" name="id_anggota" id="id_anggota" class="form-control" value="<?php echo $format; ?>"
                        readonly/>
                </div>

                <div class="form-group inpt">
                    <label>NIS</label>
                    <input type="number" name="nis" id="nis" class="form-control" placeholder="Nomor Induk Siswa">
                </div>

                <div class="form-group inpt">
                    <label>Nama Anggota</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Anggota">
                </div>

                <div class="form-group inpt">
                    <label>Jenis Kelamin</label>
                    <select name="jekel" id="jekel" class="form-control" required>
                        <option>-- Pilih --</option>
                        <option>Laki-laki</option>
                        <option>Perempuan</option>
                    </select>
                </div>

                <div class="form-group inpt">
                    <label>Kelas</label>
                    <input type="text" name="kelas" id="kelas" class="form-control" placeholder="Kelas">
                </div>

                <div class="form-group inpt">
                    <label>No HP</label>
                    <input type="number" name="no_hp" id="no_hp" class="form-control" placeholder="No HP">
                </div>

            </div>
            <div class="box-footer btn-box">
                <div>
                    <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
                    <a href="?page=data_anggota" class="btn btn-warning">Batal</a>
                </div>
            </div>
        </form>
    </div>
</section>

<?php
    if (isset ($_POST['Simpan'])){
    
        $sql_simpan = "INSERT INTO tb_anggota (id_anggota,nis,nama,jekel,kelas,no_hp) VALUES (
            '".$_POST['id_anggota']."',
            '".$_POST['nis']."',
            '".$_POST['nama']."',
            '".$_POST['jekel']."',
            '".$_POST['kelas']."',
            '".$_POST['no_hp']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

        if ($query_simpan){
            echo "<script>
            Swal.fire({
                title: 'Tambah Data Anggota Berhasil',
                text: '',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = '?page=data_anggota';
                }
            })</script>";
        }else{
            echo "<script>
            Swal.fire({
                title: 'Tambah Data Anggota Gagal',
                text: '',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = '?page=add_anggota';
                }
            })</script>";
        }
  }
    
?>