<?php
  
$carikode = mysqli_query($koneksi,"SELECT id_buku FROM tb_buku order by id_buku desc");
$datakode = mysqli_fetch_array($carikode);
$kode = $datakode['id_buku'];
$urut = substr($kode, 1, 3);
$tambah = (int) $urut + 1;

if (strlen($tambah) == 1){
	$format = "B"."00".$tambah;
}else if (strlen($tambah) == 2){
 	$format = "B"."0".$tambah;
}else {
	$format = "B".$tambah;
}

?>

<section class="container">
    <div class="nav-links">
        <h5>Tambah Data Buku</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/E-Library/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="?page=data_buku">Buku</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah_Buku</li>
            </ol>
        </nav>                          
    </div>
    <div class="box-page">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group inpt">
                    <label>ID Buku</label>
                    <input type="text" name="id_buku" id="id_buku" class="form-control" value="<?php echo $format; ?>"
                    readonly/>
                </div>
                <div class="form-group inpt">
                    <label>Judul Buku</label>
                    <input type="text" name="judul_buku" id="judul_buku" class="form-control" placeholder="Judul Buku" required>
                </div>

                <div class="form-group inpt">
                    <label>Pengarang</label>
                    <input type="text" name="pengarang" id="pengarang" class="form-control" placeholder="Nama Pengarang" required>
                </div>

                <div class="form-group inpt">
                    <label>Penerbit</label>
                    <input type="text" name="penerbit" id="penerbiit" class="form-control" placeholder="Penerbit" required>
                </div>

                <div class="form-group inpt">
                    <label>Tahun Terbit</label>
                    <input type="number" name="th_terbit" id="th_terbit" class="form-control" placeholder="Tahun Terbit" required>
                </div>

                <div class="form-group inpt">
                    <label>Sampul Buku</label>
                    <input type="file" class="form-control" id="inputGroupFile04" name="uploaded_file" accept=".jpg, .jpeg, .png" required>
                </div>

            </div>
            
            <!-- /.box-body -->
            <div class="box-footer btn-box">
                <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
                <a href="?page=data_buku" class="btn btn-warning">Batal</a>
            </div>
        </form>
    </div>
</section>


<?php

    if (isset ($_POST['Simpan'])){
    
        $sql_simpan = "INSERT INTO tb_buku (id_buku,judul_buku,gambar,pengarang,penerbit,th_terbit) VALUES (
            '".$_POST['id_buku']."',
            '".$_POST['judul_buku']."',
            '".$_FILES["uploaded_file"]["name"]."',
            '".$_POST['pengarang']."',
            '".$_POST['penerbit']."',
            '".$_POST['th_terbit']."')";

        $filename = $_FILES["uploaded_file"]["name"];
        $tempname = $_FILES["uploaded_file"]["tmp_name"];
        $folder = "images/buku/".$filename;
        move_uploaded_file($tempname, $folder);
            
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

        if ($query_simpan){
            echo "<script>
            Swal.fire({
                title: 'Tambah Data Buku Berhasil',
                text: '',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = '?page=data_buku';
                }
            })</script>";
        }else {
            echo "<script>
            Swal.fire({
                title: 'Tambah Data Buku Gagal',
                text: '',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = '?page=add_buku';
                }
            })</script>";
        }
  }
    
?>