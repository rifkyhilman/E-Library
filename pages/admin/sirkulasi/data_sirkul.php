<section class="container">
    <div class="nav-links">
        <h5>Data Sirkulasi</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sirkulasi</li>
            </ol>
        </nav>                          
    </div>
    <div class="box-page">
		<div class="box-header with-border">
			<a href="?page=add_sirkul" title="Tambah Data" class="btn btn-primary">
				<i class="fa-solid fa-plus"></i> Tambah Data</a>
		</div>
		<div class="box-body">
			<div class="table-responsive">
				<table id="Table1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>ID SKL</th>
							<th>Buku</th>
							<th>Peminjam</th>
							<th>Tgl Pinjam</th>
							<th>Jatuh Tempo</th>
							<th>Denda</th>
							<th>Kelola</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$no = 1;
						$sql = $koneksi->query("SELECT s.id_sk, b.judul_buku,
                            a.id_anggota,
                            a.nama,
                            s.tgl_pinjam, 
                            s.tgl_kembali
                            from tb_sirkulasi s inner join tb_buku b on s.id_buku=b.id_buku
                            inner join tb_anggota a on s.id_anggota=a.id_anggota where status='PIN' order by tgl_pinjam desc");
                                    while ($data = $sql->fetch_assoc()) {
						?>

							<tr>
								<td>
									<?php echo $no++; ?>
								</td>
								<td>
									<?php echo $data['id_sk']; ?>
								</td>
								<td>
									<?php echo $data['judul_buku']; ?>
								</td>
								<td>
									<?php echo $data['id_anggota']; ?>
									-
									<?php echo $data['nama']; ?>
								</td>
								<td>
									<?php $tgl = $data['tgl_pinjam'];
									echo date("d/M/Y", strtotime($tgl)) ?>
								</td>
								<td>
									<?php $tgl = $data['tgl_kembali'];
									echo date("d/M/Y", strtotime($tgl)) ?>
								</td>

								<?php

								$u_denda = 1000;

								$tgl1 = date("Y-m-d");
								$tgl2 = $data['tgl_kembali'];

								$pecah1 = explode("-", $tgl1);
								$date1 = $pecah1[2];
								$month1 = $pecah1[1];
								$year1 = $pecah1[0];

								$pecah2 = explode("-", $tgl2);
								$date2 = $pecah2[2];
								$month2 = $pecah2[1];
								$year2 =  $pecah2[0];

								$jd1 = GregorianToJD($month1, $date1, $year1);
								$jd2 = GregorianToJD($month2, $date2, $year2);

								$selisih = $jd1 - $jd2;
								$denda = $selisih * $u_denda;
								?>

								<td>
									<?php if ($selisih <= 0) { ?>
										<span class="label label-primary">Masa Peminjaman</span>
									<?php } elseif ($selisih > 0) { ?>
										<span class="label label-danger">
											Rp.
											<?= $denda ?>
										</span>
										<br> Terlambat :
										<?= $selisih ?>
										Hari
								</td>
							<?php } ?>

							<td>
								<a href="?page=panjang&kode=<?php echo $data['id_sk']; ?>" onclick="return confirm('Perpanjang Buku ?')" title="Perpanjang" class="btn btn-success">
									<i class="fa-solid fa-upload"></i>
								</a>
								<a href="?page=kembali&kode=<?php echo $data['id_sk']; ?>" onclick="return confirm('Kembalikan Buku Ini ?')" title="Kembalikan" class="btn btn-danger">
									<i class="fa-solid fa-download"></i>
							</td>
							</tr>
						<?php
						}
						?>
					</tbody>

				</table>
			</div>
		</div>
		<p> *Note
			<br> Masa peminjaman buku adalah <span style="color:red; font-weight:bold;">7 hari</span> dari tanggal peminjaman.
			<br> Jika buku dikembalikan lebih dari masa peminjaman, maka akan dikenakan <span style="color:red; font-weight:bold;">denda</span>
			<br> sebesar <span style="color:red; font-weight:bold;">Rp 1.000/hari</span>.
		</p>
	</div>
</section>