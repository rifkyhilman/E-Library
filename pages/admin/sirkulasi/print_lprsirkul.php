
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <title>Laporan Perpustakaan - Laporan Sirkulasi</title>
</head>

<body onload="window.print()" style="font-family: Quicksand, sans-serif;">
    <h3 class='text-center' style='font-family: Quicksand, sans-serif; margin-top: 30px;'>
        .:: Laporan Perpustakaan ::.
    </h3>
    <br></br>
    <h4 class='text-center'>Laporan Sirkulasi</h4>
    <?php
        include "db/conn.php";
    
        $sql=mysqli_query($koneksi,"SELECT tb_sirkulasi.id_buku, 
        tb_buku.judul_buku, 
        tb_anggota.id_anggota,
        tb_anggota.nama,
        tb_sirkulasi.id_sk,
        tb_sirkulasi.tgl_pinjam,
        tb_sirkulasi.tgl_kembali,
        tb_sirkulasi.tgl_dikembalikan,
            if(datediff(now( ) , tb_sirkulasi.tgl_kembali)<=0,0,datediff(now( ) , tb_sirkulasi.tgl_kembali) ) telat_pengembalian FROM tb_sirkulasi 
            JOIN tb_anggota ON tb_anggota.id_anggota=tb_sirkulasi.id_anggota 
            JOIN tb_buku ON tb_buku.id_buku=tb_sirkulasi.id_buku where tb_sirkulasi.status='KEM'
            Order By id_anggota");
        $no=null;
        $total_denda=null;
        $tarif_denda=1000;
    ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style="text-align: center;">No</th>
                <th style="text-align: center;">ID SKL</th>
                <th style="text-align: center;">Buku</th>
                <th style="text-align: center;">Peminjam</th>
                <th style="text-align: center;">Tgl Pinjam</th>
                <th style="text-align: center;">Jatuh Tempo</th>
                <th style="text-align: center;">Tgl dikembalikan</th>
                <th style="text-align: center;">Denda</th>
                <!--<th  style="text-align: center;">Denda</th>-->
            </tr>
            <?php
        // Eksekusi/Jalankan query dari variabel $query
        $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql
        

        if ($row > 0) { // Jika jumlah data lebih dari 0 (Berarti jika data ada)
            while ($data = mysqli_fetch_array($sql,MYSQLI_ASSOC)) { // Ambil semua data dari hasil eksekusi $sql
                $no++;
                $total_denda=$total_denda+($data['telat_pengembalian']*$tarif_denda);
                echo '<tr>
						<td>'.$no.'</td>
						<td>'.$data['id_sk'].'</td>
						<td>'.$data['judul_buku'].'</td>
						<td>'.$data['nama'].'</td>
						<td>'.date_format(new DateTime($data['tgl_pinjam']),'d/M/Y').'</td>
                        <td>'.date_format(new DateTime($data['tgl_kembali']),'d/M/Y').'</td>
						<td>'.date_format(new DateTime($data['tgl_dikembalikan']),'d/M/Y').'</td>
					
						<td>Rp. '.number_format($data['telat_pengembalian']*$tarif_denda,0,',','.').'</td>
						</tr>';
            }
        } else { // Jika data tidak ada
            echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
        }
        ?>
            <tr>
                    <th colspan="8" style="text-align:right; padding-right:1.5cm;">
					    Total Denda Rp. <?php echo number_format($total_denda,0,',','.');?>
					</th>
            </tr>
    </table>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</body>

</html>