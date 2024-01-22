<?php
include '../koneksi.php';
$search = strtoupper($_GET['q']);
if (empty($search)) {
    $result_guru = mysqli_query($koneksi , "SELECT * FROM tb_guru");
    $jumlah_guru = mysqli_num_rows($result_guru);
}else{
    $result_guru = mysqli_query($koneksi , "SELECT tb_guru.id ,tb_mapel.nama as nama_mapel, tb_guru.nip, tb_guru.nama FROM tb_guru, tb_mapel WHERE tb_guru.id_mapel = tb_mapel.id and tb_guru.nama LIKE '%$search%'");
    $jumlah_guru = mysqli_num_rows($result_guru);
}

$jmlperhalaman = 7;
$jmldata = $jumlah_guru;
$jmlhalaman = ceil($jmldata / $jmlperhalaman);
$halaktif = ( isset($_GET['page']) ) ? $_GET['page'] : 1;
$start = ($jmlperhalaman * $halaktif) - $jmlperhalaman;
$no = $start;


if (empty($_GET['q'])) {
    $result_table_guru = mysqli_query($koneksi, "SELECT tb_guru.id ,tb_mapel.nama as nama_mapel, tb_guru.nip, tb_guru.nama FROM tb_guru, tb_mapel WHERE tb_guru.id_mapel = tb_mapel.id order by tb_mapel.nama LIMIT $start, $jmlperhalaman");
 }else{
     $result_table_guru = mysqli_query($koneksi, "SELECT tb_guru.id ,tb_mapel.nama as nama_mapel, tb_guru.nip, tb_guru.nama FROM tb_guru, tb_mapel WHERE tb_guru.id_mapel = tb_mapel.id and tb_guru.nama LIKE '%$search%' order by tb_mapel.nama LIMIT $start, $jmlperhalaman");
 }
 ?>
                                <div class="table-responsive" >
                                    <div class="align-middle mb-0 table table-borderless table-striped table-hover">
                                        <div class="col-md-12">
                                            <table class="mb-0 table table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>Nip</th>
                                                        <th>Nama</th>
                                                        <th>Mapel</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while ($row = mysqli_fetch_assoc($result_table_guru)) { ?>
                                                    <tr>
                                                        <td><?php echo $no += 1 ?></td>
                                                        <td><?php echo $row['nip'] ?></td>
                                                        <td><?php echo $row['nama'] ?></td>
                                                        <td><?php echo $row['nama_mapel'] ?></td>
                                                        <td><a href="delete.php?id_guru=<?php echo $row['id']?>" onclick = "return confirm('Apakah Anda Yakin ?')" class="border-0 btn-transition btn btn-outline-danger">Hapus</a>
                                                            <a href="?hal=update_guru&id_guru=<?php echo $row['id']?>" class="border-0 btn-transition btn btn-outline-success">Update</a>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-block text-center card-footer">
                                    <!-- PAGINATION-->
                                    <ul class="pagination mt-2">
                                        <?php if ($halaktif > 1): ?>
                                            <li class="page-item"><a class="page-link" aria-label="Previous" href="beranda.php?hal=guru&q=<?= $search ?>&page=<?php echo $halaktif-1; ?>"><span aria-hidden="true">«</span><span class="sr-only">Previous</span></a></li>
                                        <?php endif ?>

                                        <?php for ($i=1; $i <= $jmlhalaman ; $i++) { 
                                                if ( $i == $halaktif) { ?>
                                                    <li class="page-item active"><a class="page-link" href="beranda.php?&hal=guru&q=<?= $search ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                        <?php } else { ?>
                                                    <li class="page-item"><a class="page-link" href="beranda.php?hal=guru&q=<?= $search ?>&page=<?php echo $i ?>"><?php echo $i ?></a ></li>
                                        <?php } 
                                        } ?>

                                        <?php if ($halaktif < $jmlhalaman): ?>
                                                <li class="page-item"><a class="page-link" aria-label="Next" href="beranda.php?hal=guru&q=<?= $search ?>&page=<?php echo $halaktif + 1; ?>"><span aria-hidden="true">»</span><span class="sr-only">Next</span></a></li>
                                        <?php endif ?>
                                    </ul>
                                </div>



