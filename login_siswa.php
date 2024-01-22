<?php session_start();
if (empty($_SESSION['username']) && empty($_SESSION['siswa']) && empty($_SESSION['guru'])) {
	if (isset($_POST['masuk'])) {
		include "koneksi.php";
		$nisn = $_POST['nisn'];
	
		$query = mysqli_query($koneksi, "SELECT * from tb_siswa where nisn = '$nisn' ");
		$data = mysqli_fetch_assoc($query);
		$row = mysqli_num_rows($query);

		if ($row) {
			$_SESSION['id'] = $data['id'];
			$_SESSION['siswa'] = $data['nama'];
			header("Location: beranda.php");
		} else {
			$err = true;
		}
	}

?>

<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/buat_admin.css">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">

    <title>LOGIN - CBT</title>
</head>
<body>
<div class="container">
	<h2 align="center">Login Siswa</h2>
	<hr class="bg-dark">
	<?php if (isset($err)): ?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
  			<strong>NISN Tidak terdaftar !</strong> Silahkan Cek kembali
 			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
   				<span aria-hidden="true">&times;</span>
  			</button>
		</div>
	<?php endif ?>
	
	<form method="post">
		<div class="input-group">
			<div class="input-group-text"><i class="fas fa-chalkboard-teacher"></i></div>
			<input type="number" name="nisn" id="nisn" placeholder="Masukan nisn" required class="form-control" autocomplete="off">
		</div>
		<br>
		<input type="submit" name="masuk" value="masuk" class="btn btn-primary btn-sm form-control">
	</form>
	<a href="index.php">Kembali</a>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    	<script src="jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

<?php 
}else{
	header("Location: beranda.php");
} ?>
