<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <link rel="icon" href="dist/img/logo.png">
	  <link rel="stylesheet" href="test.css">
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    rel="stylesheet"
    />
    <link
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
    rel="stylesheet"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login Siswa</title>
</head>

<body>
<div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-10">
        <div class="card border-light-subtle shadow-sm">
            <div class="d-flex align-items-center justify-content-center">
              <div class="col-12 col-lg-11 col-xl-10">
                <div class="card-body p-3 p-md-4 p-xl-5">
                  <div class="row">
                    <div class="col-12">
                      <div class="mb-5">
                        <div class="text-center mb-4">
                          <a href="#!">
                            <img src="dist/img/logo.png"" alt="BootstrapBrain Logo" width="80" height="80">
                          </a>
                        </div>
                        <h4 class="text-center"> LOGIN SISWA </h4>
                      </div>
                    </div>
                  </div>
              
                  <form action="#" method="post">
                    <div class="row gy-3 overflow-hidden">
                  
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="username" id="username"  placeholder="Username" required>
                                <label for="username" class="form-label">Username</label>
                            </div>
                        </div>
                  
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password" id="password"  placeholder="Password" required>
                                <label for="password" class="form-label">Password</label>
                            </div>
                        </div>
                
                      <div class="col-12">
                        <div class="d-grid">
                          <button class="btn btn-dark btn-lg" type="submit" name="btnLogin">Login</button>
                        </div>
                      </div>
                    </div>
                  </form>
                  <div class="row">
                    <div class="col-12">
                      <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center mt-5">
                        <p>
                            Belum Punya Akun ?
                            <a href="/perpustakaan/register.php" class="link-secondary text-decoration-none">Register</a>
                        </p>
                        <!-- <a href="#!" class="link-secondary text-decoration-none">Forgot password</a> -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>

    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
	  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  </body>

</html>


<?php
	include "../db/conn.php";


	if (isset($_POST['btnLogin'])) {  
		$username=mysqli_real_escape_string($koneksi,$_POST['username']);
		$password=mysqli_real_escape_string($koneksi,md5($_POST['password']));
		$sql_login = "SELECT * FROM tb_pengguna WHERE BINARY username='$username' AND password= '$password'";
		
		$query_login = mysqli_query($koneksi, $sql_login);
		// print_r($query_login);
		$data_login = mysqli_fetch_array($query_login,MYSQLI_BOTH);
		$jumlah_login = mysqli_num_rows($query_login);
        

		if ($jumlah_login == 1 ){
			session_start();
			$_SESSION["ses_id"]=$data_login["id_pengguna"];
			$_SESSION["ses_nama"]=$data_login["nama_pengguna"];
			$_SESSION["ses_username"]=$data_login["username"];
			$_SESSION["ses_password"]=$data_login["password"];
			$_SESSION["ses_level"]=$data_login["level"];

			echo "<script>
				Swal.fire({title: 'Login Berhasil',
					text: '',
					icon: 'success',
					confirmButtonText: 'OK'
				}).then((result) => {
					if (result.value) {
				       window.location = '/E-Library/';
					}
				})</script>";
			}else{
			echo "<script>
				Swal.fire({title: 'Login Gagal',
					text: '',
					icon: 'error',
					confirmButtonText: 'OK'
				}).then((result) => {
					if (result.value) {
					    window.location = 'auth/login.php';
					}
				})</script>";
			}
	}

?>
