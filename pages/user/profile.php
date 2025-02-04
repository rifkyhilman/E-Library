<?php
    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_anggota WHERE  id_anggota='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>
<section class="container">
    <div class="nav-links">
        <h5>Biodata Pribadi [<?php echo $data_agt[1]; ?>]</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/E-library/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>                          
    </div>
    <div class="box-page">        
        <form action="" class="form-img" id="form" method="post" enctype="multipart/form-data">
            <div class="upload">
                    <?php 
                        if($data_cek[7] !== ""){
                    ?>
                        <img src="images/profile/<?php echo $data_cek[7] ?>" width=125 height=125 alt="foto_profile">
                    <?php
                        } else  { 
                    ?>
                        <img src="images/profile.png" width=125 height=125 alt="foto_profile">
                    <?php 
                        };
                    ?>
                <div class="round">
                    <input type="file" name="uploaded_file" id="image" accept=".jpg, .jpeg, .png">
                    <i class = "fa-solid fa-camera" style = "color: #fff;"></i>
                </div>
            </div>
        </form>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group inpt">
                    <label>Id anggota</label>
                    <input type='text' class="form-control" name="id_anggota" value="<?php echo $data_cek['id_anggota']; ?>"
                        readonly/>
                </div>
                <div class="form-group inpt">
                    <label>NIS</label>
                    <input type='number' class="form-control" name="nis" value="<?php echo $data_cek['nis']; ?>"
                    />
                </div>
                <div class="form-group inpt">
                    <label>Nama</label>
                    <input type='text' class="form-control" name="nama" value="<?php echo $data_cek['nama']; ?>"
                    />
                </div>
                <div class="form-group inpt">
                    <label>Jenis Kelamin</label>
                    <select name="jekel" id="jekel" class="form-control" required>
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
                <div class="form-group inpt">
                    <label>Kelas</label>
                    <input type='text' class="form-control" name="kelas" value="<?php echo $data_cek['kelas']; ?>"
                    />
                </div>
                <div class="form-group inpt">
                    <label>No HP</label>
                    <input type='number' class="form-control" name="no_hp" value="<?php echo $data_cek['no_hp']; ?>"
                    />
                </div>
            </div>
            <div class="box-footer btn-box">
                <div>
                    <input type="submit" name="Ubah" value="Ubah" class="btn btn-success">
                    <a href="/E-Library" class="btn btn-warning">Batal</a>
                </div>
                <div>
                    <a href="?page=print_anggota&kode=<?php echo $data_cek['id_anggota'] ?>" title="print" 	 class="btn btn-primary">
                       Cetak Kartu Anggota
                    </a>
                </div>
            </div>
        </form>
    </div> 
</section>


<?php

if (isset ($_POST['Ubah'])){
    $sql_ubah = "UPDATE tb_anggota SET
		nis='".$_POST['nis']."',
		nama='".$_POST['nama']."',
		jekel='".$_POST['jekel']."',
		kelas='".$_POST['kelas']."',
        no_hp='".$_POST['no_hp']."'
        WHERE id_anggota='".$_POST['id_anggota']."'";

    $query_ubah = mysqli_query($koneksi, $sql_ubah);

    if ($query_ubah) {
        echo "<script>
        Swal.fire({
            title: 'Ubah Data Diri Berhasil',
            text: '',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = '/E-Library';
            }
        })</script>";
    }else{
        echo "<script>
        Swal.fire({
            title: 'Ubah Data Diri Gagal',
            text: '',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = '?page=profile';
            }
        })</script>";
    }
}

if (isset($_FILES["uploaded_file"]["name"])){ 

    $sql_ubah = "UPDATE tb_anggota SET foto_profile='".$_FILES["uploaded_file"]["name"]."' WHERE id_anggota='".$_GET['kode']."'";

    $filename = $_FILES["uploaded_file"]["name"];
    $tempname = $_FILES["uploaded_file"]["tmp_name"];
    $folder = "images/profile/".$filename;
    move_uploaded_file($tempname, $folder);

    $query_ubah = mysqli_query($koneksi, $sql_ubah);


    if ($query_ubah) {
        echo "<script>
        Swal.fire({
            title: 'Ubah Foto Profile Berhasil',
            text: '',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = '/E-Library';
            }
        })</script>";
    }else{
        echo "<script>
        Swal.fire({
            title: 'Ubah Foto Gagal',
            text: '',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = '?page=profile';
            }
        })</script>";
    }
}

?>