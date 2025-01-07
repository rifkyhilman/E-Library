<section class="container">
    <div class="nav-links">
        <h5>Katalog Buku</h5>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/E-library/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Katalog_buku</li>
            </ol>
        </nav>                          
    </div>
    <div class="box-page">
        <div class="input-group">
            <span class="input-group-text bg-transparent" id="basic-addon1">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Cari Judul Buku...">
        </div>
        <datalist id="datalistOptions">
            <?php
                $sql = $koneksi->query("SELECT * from tb_buku");
                while ($data= $sql->fetch_assoc()) {
            ?>
                <option value="<?php echo $data['judul_buku']; ?>">
            <?php 
                }
            ?>
        </datalist>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php
            $sql = $koneksi->query("SELECT * from tb_buku");
            while ($data= $sql->fetch_assoc()) {
        ?>
        <div class="col">
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="images/buku/<?php echo $data['gambar']; ?>" class="img-fluid rounded-start" alt="Sampul Buku">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $data['judul_buku']; ?></h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</section>