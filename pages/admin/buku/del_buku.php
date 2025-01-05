<?php
if(isset($_GET['kode'])){
    $sql_hapus = "DELETE FROM tb_buku WHERE id_buku='".$_GET['kode']."'";
    $query_hapus = mysqli_query($koneksi, $sql_hapus);

    if ($query_hapus) {
        echo "<script>
        Swal.fire({
            title: 'Hapus Data Buku Berhasil',
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
            title: 'Hapus Data Buku Gagal',
            text: '',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = '?page=data_buku';
            }
        })</script>";
    }
}

?>