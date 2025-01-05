<?php
    if(isset($_GET['kode'])){
        $sql_hapus = "DELETE FROM tb_anggota WHERE id_anggota='".$_GET['kode']."'";
        $query_hapus = mysqli_query($koneksi, $sql_hapus);

        if ($query_hapus) {
            echo "<script>
            Swal.fire({
                title: 'Hapus Data Anggota Berhasil',
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
                title: 'Hapus Data Anggota Gagal',
                text: '',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = '?page=data_anggota';
                }
            })</script>";
        }
    }
?>