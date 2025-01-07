<section class="container">
    <div class="nav-links">
        <h5>Data Anggota</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/E-library/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Anggota</li>
            </ol>
        </nav>                          
    </div>
    <div class="box-page">
		<div class="box-header with-border">
			<a href="?page=add_anggota" title="Tambah Data" class="btn btn-primary">
				<i class="fa-solid fa-plus"></i> Tambah Data</a>
			<a href="?page=printall_anggota" title="Print" class="btn btn-success" stlye="color : green;">
				<i class="fa-solid fa-print"></i> Print</a>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div class="table-responsive">
				<table id="Table1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Id Anggota</th>
							<th>Nama</th>
							<th>JK</th>
							<th>Kelas</th>
							<th>No HP</th>
							<th>Kelola</th>
						</tr>
					</thead>
					<tbody class="table_content">
						<?php
							$no = 1;
							$sql = $koneksi->query("SELECT * from tb_anggota");
							while ($data= $sql->fetch_assoc()) {
						?>
						<tr>
							<td>
								<?php echo $no++; ?>
							</td>
							<td>
								<?php echo $data['id_anggota']; ?>
							</td>
							<td>
								<?php echo $data['nama']; ?>
							</td>
							<td>
								<?php echo $data['jekel']; ?>
							</td>
							<td>
								<?php echo $data['kelas']; ?>
							</td>
							<td>
								<?php echo $data['no_hp']; ?>
							</td>

							<td>
								<a href="?page=edit_anggota&kode=<?php echo $data['id_anggota']; ?>" title="Ubah Data"
								 class="btn btn-success">
									<i class="fa-solid fa-pen-to-square"></i>
								</a>

								<a href="?page=del_anggota&kode=<?php echo $data['id_anggota']; ?>" onclick="return confirm('Yakin Hapus Data Ini ?')"
								 title="Hapus" class="btn btn-danger">
									<i class="fa-solid fa-trash"></i>
				 				 </a>

								<a href="?page=print_anggota&kode=<?php echo $data['id_anggota'] ?>" title="print" 	 class="btn btn-primary">
									<i class="fa-solid fa-print"></i>
								</a>
				
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