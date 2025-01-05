<section class="container">
    <div class="nav-links">
        <h5>Riwayat Pengembalian Buku</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Log Kembali</li>
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
							<th>Peminjam</th>
							<th>Tgl Di kembalikan</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							$sql = $koneksi->query("SELECT b.judul_buku, a.id_anggota, a.nama, s.tgl_kembali, s.tgl_dikembalikan
							from tb_sirkulasi s inner join tb_buku b on s.id_buku=b.id_buku
							inner join tb_anggota a on s.id_anggota=a.id_anggota where status='KEM' order by tgl_kembali asc");
							while ($data= $sql->fetch_assoc()) {
						?>
						<tr>
							<td>
								<?php echo $no++; ?>
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
								<?php  $tgl = $data['tgl_dikembalikan']; echo date("d/M/Y", strtotime($tgl))?>
							</td>
						</tr>
						<?php
                  }
                ?>
					</tbody>

				</table>
			</div>
		</div>
	</div>
</section>