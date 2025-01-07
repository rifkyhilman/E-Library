<section class="container">
    <div class="nav-links">
        <h5>Data Buku</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Buku</li>
            </ol>
        </nav>                          
    </div>
    <div class="box-page">
		<div class="box-header with-border">
			<a href="?page=add_buku" title="Tambah Data" class="btn btn-primary">
			<i class="fa-solid fa-plus"></i> Tambah Buku</a>
		</div>
		<!-- /.box-header -->
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
							<th>Kelola</th>
						</tr>
					</thead>
					<tbody class="table_content">
						<?php
							$no = 1;
							$sql = $koneksi->query("SELECT * from tb_buku");
							while ($data= $sql->fetch_assoc()) {
						?>
						<tr>
							<td>
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
								<a href="?page=edit_buku&kode=<?php echo $data['id_buku']; ?>" title="Ubah"
								 class="btn btn-success">
								<i class="fa-solid fa-pen-to-square"></i>
								</a>
								<a href="?page=del_buku&kode=<?php echo $data['id_buku']; ?>" onclick="return confirm('Yakin Hapus Data Ini ?')"
								 title="Hapus" class="btn btn-danger">
								<i class="fa-solid fa-trash"></i>
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