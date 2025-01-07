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
        <form action="" method="POST">
            <div class="input-group">
                <span class="input-group-text bg-transparent" id="basic-addon1">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input class="form-control" name="search" placeholder="Cari Judul Buku..." required>
                <button type="submit" name="btnSearch" hidden></button>
            </div>
        </form>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php
            if (isset($_POST['btnSearch'])) {  
                $filter_value= $_POST['search'];

                $query="SELECT * FROM tb_buku WHERE judul_buku LIKE '%$filter_value%'";
                $query_run = mysqli_query($koneksi, $query);

                if(mysqli_num_rows($query_run) > 0){
                    foreach($query_run as $data_buku){?>
                        <div class="col">
                            <div class="card">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="images/buku/<?php echo $data_buku['gambar']; ?>" class="img-fluid rounded-start" alt="Sampul Buku">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $data_buku['judul_buku']; ?></h5>
                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php  
                    }
                }else {
                    print_r("DATA Kaga ada di database");
                }
            } else {
                $sql = $koneksi->query("SELECT * from tb_buku");         
                while ($data = $sql->fetch_assoc()) { ?>        
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
            }
            ?>
    </div>
</section>