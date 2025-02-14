<section class="container">
    <div class="nav-links">
        <h5> Daftar Status Buku </h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/E-Library">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Buku_Terpinjam</li>
            </ol>
        </nav>                          
    </div>
    <div class="box-page">
        <div class="box-header text-center mb-5 pb-5 font-bold border-bottom border-5">
            <h3 class="fw-bold">Buku Tersedia</h3>
        </div>
		<div class="box-body">
			<div class="table-responsive">
				<table id="Table1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Id Buku</th>
							<th>Judul Buku</th>
							<th>Pengarang</th>
							<th>Penerbit</th>
							<th>Tahun</th>
							<th>Jumlah Buku</th>
						</tr>
					</thead>
					<tbody class="table_content">
						<?php
							$no = 1;
							$sql = $koneksi->query("SELECT * from tb_buku");
							while ($data= $sql->fetch_assoc()) {
						?>
						<tr>
							<td class="text-center">
								<?php echo $no++; ?>
							</td>
							<td>
								<?php echo $data['id_buku']; ?>
							</td>
							<td>
								<?php echo $data['judul_buku']; ?>
							</td>
							<td>
								<?php echo $data['pengarang']; ?>
							</td>
							<td>
								<?php echo $data['penerbit']; ?>
							</td>
							<td>
								<?php echo $data['th_terbit']; ?>
							</td>
							<td class="text-center">
								<?php echo $data['buku_tersedia']; ?>
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
    <div class="box-page">
        <div class="box-header text-center mb-5 pb-5 font-bold border-bottom border-5">
            <h3 class="fw-bold">Buku Terpinjam</h3>
        </div>
		<div class="box-body">
			<div class="table-responsive">
				<table id="Table1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Id Buku</th>
							<th>Judul Buku</th>
							<th>Pengarang</th>
							<th>Penerbit</th>
							<th>Tahun</th>
							<th>tgl-pinjam</th>
							<th>tgl-kembali</th>
						</tr>
					</thead>
					<tbody class="table_content">
						<?php
							$no = 1;
							$sql = $koneksi->query(
                                "SELECT b.id_buku, b.judul_buku, b.pengarang, b.penerbit, b.th_terbit, s.tgl_pinjam, s.tgl_kembali 
                                FROM tb_buku b  JOIN tb_sirkulasi s ON b.id_buku = s.id_buku
                                WHERE s.status = 'PIN'");
                                
							while ($data= $sql->fetch_assoc()) {
						?>
						<tr>
							<td class="text-center">
								<?php echo $no++; ?>
							</td>
							<td>
								<?php echo $data['id_buku']; ?>
							</td>
							<td>
								<?php echo $data['judul_buku']; ?>
							</td>
							<td>
								<?php echo $data['pengarang']; ?>
							</td>
							<td>
								<?php echo $data['penerbit']; ?>
							</td>
							<td>
								<?php echo $data['th_terbit']; ?>
							</td>
                            <td>
								<?php echo $data['tgl_pinjam']; ?>
							</td>
                            <td>
								<?php echo $data['tgl_kembali']; ?>
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