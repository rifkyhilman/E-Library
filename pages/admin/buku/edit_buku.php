<?php
    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_buku WHERE id_buku='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<section class="container">
    <div class="nav-links">
        <h5>Ubah Data Buku</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/E-Library/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="?page=data_buku">Buku</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit_Buku</li>
            </ol>
        </nav>                          
    </div>
    <div class="box-page">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group inpt">
                    <label>Id Buku</label>
                    <input type='text' class="form-control" name="id_buku" value="<?php echo $data_cek['id_buku']; ?>"
                        readonly/>
                </div>
                <div class="form-group inpt">
                    <label>Judul Buku</label>
                    <input type='text' class="form-control" name="judul_buku" value="<?php echo $data_cek['judul_buku']; ?>"
                    />
                </div>
                <div class="form-group inpt">
                    <label>Deskripsi</label>
                    <textarea  type="text" name="deskripsi" class="form-control" rows="3" value="<?php echo $data_cek['deskripsi']; ?>"></textarea>
                </div>
                <div class="form-group inpt">
                    <label>Pengarang</label>
                    <input type='text' class="form-control" name="pengarang" value="<?php echo $data_cek['pengarang']; ?>"
                    />
                </div>
                <div class="form-group inpt">
                    <label>Penerbit</label>
                    <input class="form-control" name="penerbit" value="<?php echo $data_cek['penerbit']; ?>"
                    />
                </div>
                <div class="form-group inpt">
                    <label>Th Terbit</label>
                    <input class="form-control" name="th_terbit" value="<?php echo $data_cek['th_terbit']; ?>">
                </div>
                <div class="form-group inpt">
                    <label>Sampul Buku</label>
                    <input type="file" class="form-control" id="inputGroupFile04" name="uploaded_file" accept=".jpg, .jpeg, .png">
                </div>
            </div>
            <div class="box-footer btn-box">
                <div>
                    <input type="submit" name="Ubah" value="Ubah" class="btn btn-success">
                    <a href="?page=data_buku" class="btn btn-warning">Batal</a>
                </div>
            </div>
        </form>
    </div>
</section>


<?php

if (isset ($_POST['Ubah'])){
    
    $file_gambar = $_FILES["uploaded_file"]["name"];

    if($file_gambar !== ""){
        $sql_ubah = "UPDATE tb_buku SET
            judul_buku='".$_POST['judul_buku']."',
            deskripsi='".$_POST['deskripsi']."',
            gambar='".$_FILES["uploaded_file"]["name"]."',
            pengarang='".$_POST['pengarang']."',
            penerbit='".$_POST['penerbit']."',
            th_terbit='".$_POST['th_terbit']."'
            WHERE id_buku='".$_POST['id_buku']."'";
        $filename = $_FILES["uploaded_file"]["name"];
        $tempname = $_FILES["uploaded_file"]["tmp_name"];
        $folder = "images/buku/".$filename;
        move_uploaded_file($tempname, $folder);
            
        $query_ubah = mysqli_query($koneksi, $sql_ubah);

        if ($query_ubah) {
            echo "
                <script>
                Swal.fire({
                    title: 'Ubah Data Buku Berhasil',
                    text: '',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = '?page=data_buku';
                    }
                })</script>";
            }else{
                echo "<script>
                Swal.fire({
                    title: 'Ubah Data Buku Gagal',
                    text: '',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = '?page=data_buku';
                    }
                })</script>";
            }
    }else {
        $sql_ubah = "UPDATE tb_buku SET
            judul_buku='".$_POST['judul_buku']."',
            deskripsi='".$_POST['deskripsi']."',
            pengarang='".$_POST['pengarang']."',
            penerbit='".$_POST['penerbit']."',
            th_terbit='".$_POST['th_terbit']."'
            WHERE id_buku='".$_POST['id_buku']."'";

        $query_ubah = mysqli_query($koneksi, $sql_ubah);

        if ($query_ubah) {
            echo "
            <script>
            Swal.fire({
                title: 'Ubah Data Buku Berhasil',
                text: '',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = '?page=data_buku';
                }
            })</script>";
            }else{
            echo "<script>
            Swal.fire({
                title: 'Ubah Data Buku Gagal',
                text: '',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = '?page=data_buku';
                }
            })</script>";
        }
    };

}

?>