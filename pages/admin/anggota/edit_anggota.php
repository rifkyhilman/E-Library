<?php
    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_anggota WHERE id_anggota='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>
<section class="container">
    <div class="nav-links">
        <h5>Ubah Data Anggota</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/E-library/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="?page=data_anggota">Anggota</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ubah_Anggota</li>
            </ol>
        </nav>                          
    </div>
    <div class="box-page">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="box-body">

                <div class="form-group">
                    <label>Id anggota</label>
                    <input type='text' class="form-control inpt" name="id_anggota" value="<?php echo $data_cek['id_anggota']; ?>"
                        readonly/>
                </div>

                <div class="form-group">
                    <label>Nama</label>
                    <input type='text' class="form-control inpt" name="nama" value="<?php echo $data_cek['nama']; ?>"
                    />
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jekel" id="jekel" class="form-control inpt" required>
                        <option value="">-- Pilih --</option>
                        <?php
                        //cek data yg dipilih sebelumnya
                        if ($data_cek['jekel'] == "Laki-laki") echo "<option value='Laki-laki' selected>Laki-laki</option>";
                        else echo "<option value='Laki-laki'>Laki-laki</option>";
                        
                        if ($data_cek['jekel'] == "Perempuan") echo "<option value='Perempuan' selected>Perempuan</option>";
                        else echo "<option value='Perempuan'>Perempuan</option>";
                    ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Kelas</label>
                    <input type='text' class="form-control inpt" name="kelas" value="<?php echo $data_cek['kelas']; ?>"
                    />
                </div>

                <div class="form-group">
                    <label>No HP</label>
                    <input type='number' class="form-control inpt" name="no_hp" value="<?php echo $data_cek['no_hp']; ?>"
                    />
                </div>

            </div>
            <div class="box-footer btn-box">
                <input type="submit" name="Ubah" value="Ubah" class="btn btn-success">
                <a href="?page=data_anggota" class="btn btn-warning">Batal</a>
            </div>
        </form>
    </div>
</section>


<?php

if (isset ($_POST['Ubah'])){
    //mulai proses ubah
    $sql_ubah = "UPDATE tb_anggota SET
		nama='".$_POST['nama']."',
		jekel='".$_POST['jekel']."',
		kelas='".$_POST['kelas']."',
        no_hp='".$_POST['no_hp']."'
        WHERE id_anggota='".$_POST['id_anggota']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);

    if ($query_ubah) {
        echo "<script>
        Swal.fire({
            title: 'Ubah Data Anggota Berhasil',
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
            title: 'Ubah Data Anggota Gagal',
            text: '',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = '?page=edit_anggota';
            }
        })</script>";
    }
}

?>