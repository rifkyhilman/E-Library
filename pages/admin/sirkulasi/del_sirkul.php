<?php
    if(isset($_GET['kode'])){

        $dateNow = date('Y-m-d');

        $sql_ubah = "UPDATE tb_sirkulasi s JOIN tb_buku b ON s.id_buku = b.id_buku SET s.status='KEM', b.buku_tersedia= b.buku_tersedia+1, s.tgl_dikembalikan = '$dateNow' WHERE s.id_sk='".$_GET['kode']."'";

        $query_ubah = mysqli_query($koneksi, $sql_ubah);


        if ($query_ubah) {
            echo "<script>
            Swal.fire({
                title: 'Kembalikan Buku Berhasil',
                text: '',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = '?page=data_sirkul';
                }
            })</script>";
        }else{
            echo "<script>
            Swal.fire({
                title: 'Kembalikan Buku Gagal',
                text: '',
                icon: 'error',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = '?page=data_sirkul';
                }
            })</script>";
        }
	}
?>