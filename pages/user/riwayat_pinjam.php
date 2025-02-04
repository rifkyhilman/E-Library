<section class="container">
    <div class="nav-links">
        <h5>Riwayat Peminjaman Buku [<?php echo $data_agt[1]; ?>]</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Riwayat_pinjam</li>
            </ol>
        </nav>                          
    </div>
    <div class="box-page">
		<div class="box-body">
			<div class="table-responsive">
				<table id="Table1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Buku</th>
							<th>Tgl Pinjam</th>
							<th>Jatuh Tempo</th>
							<th>Tgl dikembalikan</th>
							<th>Denda</th>
						</tr>
					</thead>
				<tbody>

				<?php

                    // print_r($data_nama);
                    $sql=mysqli_query($koneksi,"SELECT tb_sirkulasi.id_buku, 
                    tb_buku.judul_buku, 
                    tb_anggota.id_anggota,
                    tb_sirkulasi.tgl_pinjam,
                    tb_sirkulasi.tgl_kembali,
                    tb_sirkulasi.tgl_dikembalikan,
                    if(datediff(now( ) , tb_sirkulasi.tgl_kembali)<=0,0,datediff(now( ) , tb_sirkulasi.tgl_kembali) ) telat_pengembalian FROM tb_sirkulasi 
                    JOIN tb_anggota ON tb_anggota.id_anggota=tb_sirkulasi.id_anggota 
                    JOIN tb_buku ON tb_buku.id_buku=tb_sirkulasi.id_buku WHERE tb_sirkulasi.status='KEM' AND tb_anggota.nama='$data_agt[1]'
                    Order By id_anggota");

                    // $data=mysqli_fetch_array($sql,MYSQLI_ASSOC);

                    // print_r($data);

                    $no =null;
                    $total_denda=null;
                    $tarif_denda=1000;

                        while ($data=mysqli_fetch_array($sql,MYSQLI_ASSOC)) {
                            $no++;
                            $total_denda=$total_denda+($data['telat_pengembalian']*$tarif_denda);
                            echo '<tr>
                                    <td>'.$no.'</td>
                                    <td>'.$data['judul_buku'].'</td>
                                    <td>'.date_format(new DateTime($data['tgl_pinjam']),'d-M-Y').'</td>
                                    <td>'.date_format(new DateTime($data['tgl_kembali']),'d-M-Y').'</td>
                                    <td>'.date_format(new DateTime($data['tgl_dikembalikan']),'d-M-Y').'</td>
                                    <td>Rp. '.number_format($data['telat_pengembalian']*$tarif_denda,0,',','.').'</td>
                                </tr>';
                        }
				    ?>
					</tbody>
				</table>
			</div>
		</div>
    </div>
</section>