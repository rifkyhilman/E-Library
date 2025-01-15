
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="assets_style/assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets_style/assets/bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets_style/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css>">
    <title><?= $title_web;?></title>
		<style>
	
			.card-agt {
				padding: 50px;
				border: 2px solid black;
			}

			page[size="A4"] {
				background: white;
				width: 21cm;
				height: 29.7cm;
				display: block;
				margin: 0 auto;
				margin-bottom: 0.5pc;
				box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
				padding-left:2.54cm;
				padding-right:2.54cm;
				padding-top:1.54cm;
				padding-bottom:1.54cm;
			}
			@media print {
				body, page[size="A4"] {
					margin: 0;
					box-shadow: 0;
				}
			}
		</style>
</head>
<body>
    <div class="container">
        <br/> 
        <div class="center">
            Preview HTML to DOC [ size paper A4 ]
        </div>
        <div class="right"> 
        <button type="button" class="btn btn-success btn-md" onclick="printDiv('printableArea')">
            <i class="fa fa-print"> </i> Print File
        </button>
        </div>
    </div>
    <br/>
    <div id="printableArea">
        <page size="A4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3 class='text-center' style='font-family: Quicksand, sans-serif; margin-top: 30px;'>
                        .:: Laporan Perpustakaan ::.
                    </h3>
                    <h4 class='text-center'>Laporan Sirkulasi</h4>
                    <br></br>
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
                </div>
            </div>
        </page>
    </div>

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