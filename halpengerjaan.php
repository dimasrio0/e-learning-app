<?php
session_start();
if (isset($_SESSION['mapel'])) {
	include 'koneksi.php';
	$que = mysqli_query($koneksi, "SELECT waktu FROM tb_ujian");
	$fet = mysqli_fetch_assoc($que);
	$waktuUjian = $fet['waktu'] / 60;

	$resu = mysqli_query($koneksi, "SELECT * FROM tb_soal where id_mapel = '" . $_SESSION['mapel'] . "' and Tingkat = '" . $_SESSION['tingkat'] . "' ");
	$jml_soal = mysqli_num_rows($resu);

	$jmlperhalaman5 = 1;
	$jmldata5 = $jml_soal;
	$jmlhalaman5 = ceil($jmldata5 / $jmlperhalaman5);
	$halaktif5 = (isset($_GET['page'])) ? $_GET['page'] : 1;;
	$start5 = ($jmlperhalaman5 * $halaktif5) - $jmlperhalaman5;

	$result = mysqli_query($koneksi, "SELECT * FROM tb_soal where id_mapel = '" . $_SESSION['mapel'] . "' and Tingkat = '" . $_SESSION['tingkat'] . "' LIMIT $start5, $jmlperhalaman5");
	$no = $start5;
	$i = $start5;
	$z = 1;
	if (empty($_POST['ragu-ragu'])) {
		$_POST['ragu-ragu'] = null;
	}
	// Timer
	$menit = $waktuUjian;
	$detik = 0;

	if (isset($_POST['prev']) || isset($_POST['next']) || isset($_POST['link'])) {
		$_SESSION['menit'] = $_POST['menit'];
		$_SESSION['detik'] = $_POST['detik'];
	}

	if (isset($_SESSION['menit']) && isset($_SESSION['detik'])) {
		$menit = $_SESSION['menit'];
		$detik = $_SESSION['detik'] - 1;

		if ($_SESSION['menit'] == 0 && $_SESSION['detik'] == 0) {
			unset($_SESSION['menit']);
			unset($_SESSION['detik']);
		}
	}
?>

	<!DOCTYPE html>
	<html>

	<head>
		<title>CBT - SISWA</title>
		<link rel="stylesheet" type="text/css" href="css/pengerjaan.css">
	</head>

	<body style="background-color: rgb(242, 245, 250);">

		<div class="nav">
			<div class="nav-left">
				<h1>SMK TI PEMBANGUNAN</h1>
			</div>
			<div class="nav-right">
				<img src="gambar/icon-siswa.png">
				<a href=""><img src="gambar/icon-exit.png" id="exit"></a>
				<label>SELAMAT DATANG</label>
				<label><?php echo $_SESSION['siswa']; ?></label>
				<label><?php echo "SELAMAT MENGERJAKAN" ?></label>
				<div style="clear: both;"></div>
				<div class="toast opasiti">
					<label>log out</label>
				</div>
			</div>
			<div style="clear: both;"></div>
		</div>
		<?php if (isset($_GET['page']) && $_GET['page'] > $jml_soal) : ?>
			<div style="text-align: center;">
				<h1 align="center" style="margin-top: 100px;">Soal Hanya <?php echo $jml_soal ?> Buah</h1>
				<a href="halpengerjaan.php">Kembali</a>
			</div>
		<?php else : ?>
			<div class="area-soal">
				<div class="timer">
					<span class="menit"><?= $menit ?></span>
					:
					<span class="detik"><?= $detik ?></span>
				</div>
				<?php while ($row = mysqli_fetch_assoc($result)) {
					$i++ ?>
					<div class="pertanyaan">
						<label class="no"><?php echo $no += 1 ?> .</label>
						<div class="soal" style="overflow: auto;">
							<?php echo $row['pertanyaan'] ?>
						</div>
					</div>
					<div class="opsi">
						<form method="post">
							<input type="hidden" value="<?= $menit ?>" name="menit">
							<input type="hidden" value="<?= $detik ?>" name="detik">
							<input type="hidden" name="jml_soal" value="<?php echo $jml_soal ?>">
							<?php if (empty($_SESSION["soke$i"])) : ?>
								<div class="opsi-a">
									<label for="A">A. </label><input type="radio" name="no<?php echo $i ?>" value="A" id="A" class="pg auto-save">
									<div class="jawabanA"><?php echo $row['jawaban_A'] ?></div>
								</div>
								<div class="opsi-b">
									<label for="B">B. </label><input type="radio" name="no<?php echo $i ?>" value="B" id="B" class="pg auto-save">
									<div class="jawabanB"><?php echo $row['jawaban_B'] ?></div>
								</div>
								<div class="opsi-c">
									<label for="C">C. </label><input type="radio" name="no<?php echo $i ?>" value="C" id="C" class="pg auto-save">
									<div class="jawabanC"><?php echo $row['jawaban_C'] ?></div>
								</div>
								<div class="opsi-d">
									<label for="D">D. </label><input type="radio" name="no<?php echo $i ?>" value="D" id="D" class="pg auto-save">
									<div class="jawabanD"><?php echo $row['jawaban_D'] ?></div>
								</div>
								<div class="opsi-e">
									<label for="E">E. </label><input type="radio" name="no<?php echo $i ?>" value="E" id="E" class="pg auto-save">
									<div class="jawabanE"><?php echo $row['jawaban_E'] ?></div>
								</div>
							<?php elseif ($_SESSION["soke$i"]["jawaban"] == "A") : ?>
								<div class="opsi-a">
									<label for="A">A. </label><input type="radio" checked name="no<?php echo $i ?>" value="A" id="A" class="pg auto-save">
									<div class="jawabanA"><?php echo $row['jawaban_A'] ?></div>
								</div>
								<div class="opsi-b">
									<label for="B">B. </label><input type="radio" name="no<?php echo $i ?>" value="B" id="B" class="pg auto-save">
									<div class="jawabanB"><?php echo $row['jawaban_B'] ?></div>
								</div>
								<div class="opsi-c">
									<label for="C">C. </label><input type="radio" name="no<?php echo $i ?>" value="C" id="C" class="pg auto-save">
									<div class="jawabanC"><?php echo $row['jawaban_C'] ?></div>
								</div>
								<div class="opsi-d">
									<label for="D">D. </label><input type="radio" name="no<?php echo $i ?>" value="D" id="D" class="pg auto-save">
									<div class="jawabanD"><?php echo $row['jawaban_D'] ?></div>
								</div>
								<div class="opsi-e">
									<label for="E">E. </label><input type="radio" name="no<?php echo $i ?>" value="E" id="E" class="pg auto-save">
									<div class="jawabanE"><?php echo $row['jawaban_E'] ?></div>
								</div>
							<?php elseif ($_SESSION["soke$i"]["jawaban"] == "B") : ?>
								<div class="opsi-a">
									<label for="A">A. </label><input type="radio" name="no<?php echo $i ?>" value="A" id="A" class="pg auto-save">
									<div class="jawabanA"><?php echo $row['jawaban_A'] ?></div>
								</div>
								<div class="opsi-b">
									<label for="B">B. </label><input type="radio" checked name="no<?php echo $i ?>" value="B" id="B" class="pg auto-save">
									<div class="jawabanB"><?php echo $row['jawaban_B'] ?></div>
								</div>
								<div class="opsi-c">
									<label for="C">C. </label><input type="radio" name="no<?php echo $i ?>" value="C" id="C" class="pg auto-save">
									<div class="jawabanC"><?php echo $row['jawaban_C'] ?></div>
								</div>
								<div class="opsi-d">
									<label for="D">D. </label><input type="radio" name="no<?php echo $i ?>" value="D" id="D" class="pg auto-save">
									<div class="jawabanD"><?php echo $row['jawaban_D'] ?></div>
								</div>
								<div class="opsi-e">
									<label for="E">E. </label><input type="radio" name="no<?php echo $i ?>" value="E" id="E" class="pg auto-save">
									<div class="jawabanE"><?php echo $row['jawaban_E'] ?></div>
								</div>
							<?php elseif ($_SESSION["soke$i"]["jawaban"] == "C") : ?>
								<div class="opsi-a">
									<label for="A">A. </label><input type="radio" name="no<?php echo $i ?>" value="A" id="A" class="pg auto-save">
									<div class="jawabanA"><?php echo $row['jawaban_A'] ?></div>
								</div>
								<div class="opsi-b">
									<label for="B">B. </label><input type="radio" name="no<?php echo $i ?>" value="B" id="B" class="pg auto-save">
									<div class="jawabanB"><?php echo $row['jawaban_B'] ?></div>
								</div>
								<div class="opsi-c">
									<label for="C">C. </label><input type="radio" checked name="no<?php echo $i ?>" value="C" id="C" class="pg auto-save">
									<div class="jawabanC"><?php echo $row['jawaban_C'] ?></div>
								</div>
								<div class="opsi-d">
									<label for="D">D. </label><input type="radio" name="no<?php echo $i ?>" value="D" id="D" class="pg auto-save">
									<div class="jawabanD"><?php echo $row['jawaban_D'] ?></div>
								</div>
								<div class="opsi-e">
									<label for="E">E. </label><input type="radio" name="no<?php echo $i ?>" value="E" id="E" class="pg auto-save">
									<div class="jawabanE"><?php echo $row['jawaban_E'] ?></div>
								</div>
							<?php elseif ($_SESSION["soke$i"]["jawaban"] == "D") : ?>
								<div class="opsi-a">
									<label for="A">A. </label><input type="radio" name="no<?php echo $i ?>" value="A" id="A" class="pg auto-save">
									<div class="jawabanA"><?php echo $row['jawaban_A'] ?></div>
								</div>
								<div class="opsi-b">
									<label for="B">B. </label><input type="radio" name="no<?php echo $i ?>" value="B" id="B" class="pg auto-save">
									<div class="jawabanB"><?php echo $row['jawaban_B'] ?></div>
								</div>
								<div class="opsi-c">
									<label for="C">C. </label><input type="radio" name="no<?php echo $i ?>" value="C" id="C" class="pg auto-save">
									<div class="jawabanC"><?php echo $row['jawaban_C'] ?></div>
								</div>
								<div class="opsi-d">
									<label for="D">D. </label><input type="radio" checked name="no<?php echo $i ?>" value="D" id="D" class="pg auto-save">
									<div class="jawabanD"><?php echo $row['jawaban_D'] ?></div>
								</div>
								<div class="opsi-e">
									<label for="E">E. </label><input type="radio" name="no<?php echo $i ?>" value="E" id="E" class="pg auto-save">
									<div class="jawabanE"><?php echo $row['jawaban_E'] ?></div>
								</div><?php elseif ($_SESSION["soke$i"]['jawaban'] == "E") : ?>
								<div class="opsi-a">
									<label for="A">A. </label><input type="radio" name="no<?php echo $i ?>" value="A" id="A" class="pg auto-save">
									<div class="jawabanA"><?php echo $row['jawaban_A'] ?></div>
								</div>
								<div class="opsi-b">
									<label for="B">B. </label><input type="radio" name="no<?php echo $i ?>" value="B" id="B" class="pg auto-save">
									<div class="jawabanB"><?php echo $row['jawaban_B'] ?></div>
								</div>
								<div class="opsi-c">
									<label for="C">C. </label><input type="radio" name="no<?php echo $i ?>" value="C" id="C" class="pg auto-save">
									<div class="jawabanC"><?php echo $row['jawaban_C'] ?></div>
								</div>
								<div class="opsi-d">
									<label for="D">D. </label><input type="radio" name="no<?php echo $i ?>" value="D" id="D" class="pg auto-save">
									<div class="jawabanD"><?php echo $row['jawaban_D'] ?></div>
								</div>
								<div class="opsi-e">
									<label for="E">E. </label><input type="radio" checked name="no<?php echo $i ?>" value="E" id="E" class="pg auto-save">
									<div class="jawabanE"><?php echo $row['jawaban_E'] ?></div>
								</div>
							<?php endif ?>
							<?php if (isset($_POST['no' . $i])) : ?>
								<?php $_SESSION["soke" . $i] = ["jawaban" => $_POST['no' . $i], "ragu" => $_POST["ragu-ragu"]]; ?>
							<?php endif ?>
						<?php } ?>
					</div>
					<div class="pagination">
						<?php if ($halaktif5 > 1) : ?>
							<button type="submit" name="prev" value="<?php echo $halaktif5 - 1; ?>" class="previous"> « </button>
							<?php if (isset($_POST['prev'])) : ?>
								<?php header("Location: ?page=" . $_POST['prev']) ?>
							<?php endif ?>
						<?php else : ?>
							<button type="submit" class="previous"> « </button>
						<?php endif ?>

						<div class="ragu">
							<?php if (isset($_SESSION["soke$i"]) && isset($_SESSION["soke$i"]["jawaban"]) && $_SESSION["soke$i"]["ragu"] == null) : ?>
								<input type="checkbox" name="ragu-ragu" id="ragu">
							<?php elseif (isset($_SESSION["soke$i"]) && $_SESSION["soke$i"]["ragu"] != null) : ?>
								<input type="checkbox" name="ragu-ragu" checked="on" id="ragu">
							<?php else : ?>
								<input type="checkbox" disabled id="ragu" name="ragu-ragu">
							<?php endif ?>
							<label for="ragu">Ragu - Ragu</label>
						</div>

						<?php if ($halaktif5 < $jmlhalaman5) : ?>
							<button type="submit" name="next" value="<?php echo $halaktif5 + 1; ?>" class="next"> » </button>
							<?php if (isset($_POST['next'])) : ?>
								<?php header("Location: ?page=" . $_POST['next']) ?>
							<?php endif ?>
						<?php else : ?>
							<button type="submit" name="beres" class="next" id="hapus"> beres </button>
						<?php endif ?>
					</div>
			</div>

			<div class="view-soal awal">
				<span> « </span>
			</div>

			<div class="det-view hilang">
				<?php for ($i = 1; $i <= $jml_soal; $i++) { ?>
					<button type="submit" name="link" value="?page=<?php echo $i ?>">
						<?php if (isset($_SESSION["soke$i"]) && isset($_SESSION["soke$i"]['jawaban']) && $_SESSION["soke$i"]['ragu'] == null) : ?>
							<div class="nomor terisi" id="no<?php echo $i ?>">
								<span class="jawaban no<?php echo $i ?>">
									<pre> <?php echo "" . $_SESSION["soke$i"]["jawaban"] . ""; ?> </pre></span>
							<?php elseif (isset($_SESSION["soke$i"]) && $_SESSION["soke$i"]["ragu"] != null) : ?>
								<div class="nomor ragu-ragu" id="no<?php echo $i ?>">
									<span class="jawaban no<?php echo $i ?>">
										<pre> <?php echo "" . $_SESSION["soke$i"]["jawaban"] . ""; ?> </pre></span>
								<?php else : ?>
									<div class="nomor" id="no<?php echo $i ?>">
										<span class="jawaban no<?php echo $i ?>">
											<pre> </pre></span>
									<?php endif ?>
									<span style="color: black;"><?php echo $i ?></span>
									</div>
									<?php if (isset($_POST['link'])) : ?>
										<?php header('Location: ' . $_POST['link']) ?>
									<?php endif ?>
					</button>
				<?php } ?>
			</div>
		<?php endif ?>
		</form>
		<!-- END OF paGE -->

		<script type="text/javascript" src="jquery-3.4.1.min.js"></script>
		<script type="text/javascript">
			const form = document.querySelector('form');
			const beres = document.querySelector('#hapus');
			const ragu_ragu = document.getElementById('ragu');
			const kotak = document.querySelectorAll(".nomor");
			const kot = document.getElementById("no<?= $no ?>");

			// Ragu
			ragu_ragu.addEventListener('input', function() {
				if (kot.classList.contains('terisi')) {
					kot.classList.remove('terisi');
					kot.classList.add('ragu-ragu');
				} else {
					kot.classList.remove('ragu-ragu');
					kot.classList.add('terisi');
				}
			});

			// validasi 
			if (beres != null) {
				beres.addEventListener('click', function() {
					for (let index = 0; index < kotak.length; index++) {

						if (!kotak[index].classList.contains('terisi') && !kotak[index].classList.contains('ragu-ragu')) {
							let no = index + 1;
							return alert('Lengkapi Jawaban soal yang belum Terisi !');
						} else if (kotak[index].classList.contains('ragu-ragu')) {
							let no = index + 1;
							return alert('Kamu masih ragu-ragu di no - ' + no);
						}
					}
					const cek = confirm('Sudah yakin dengan jawaban mu ?');
					if (cek) {
						form.setAttribute('action', 'proses_ujian.php');
						form.submit();
					}
				});
			}
			// timer
			const input = document.querySelectorAll('form input');
			const tMenit = document.querySelector('.menit');
			const tDetik = document.querySelector('.detik');
			let menit = <?= $menit ?>;
			let detik = <?= $detik ?>;

			let inter = setInterval(() => {
				if (detik == 0 && menit == 0) {
					clearInterval(inter);
					form.setAttribute('action', 'proses_ujian.php');
					beres.value = true;
					form.submit();
					window.location.href = "proses_ujian.php";
					return alert('Waktu Ujian Telah Selesai');
				}
				if (detik == 0) {
					menit--;
					detik = 60;
				}
				if (detik > 0) {
					detik--;
				}
				input[0].value = menit;
				input[1].value = detik;
				console.log("Menit : " + input[0].value + " Detik : " + input[1].value);
				tMenit.innerHTML = menit;
				tDetik.innerHTML = detik;
			}, 1000);
		</script>
		<script type="text/javascript" src="js/pengerjaan.js"></script>
	</body>

	</html>

<?php
} else {
	header("Location: beranda.php");
}
?>