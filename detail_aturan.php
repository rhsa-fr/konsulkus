<!-- Proses Menampilkan Data basis aturan -->
<?php 
//Mengambil ID dari Parameter
$idaturan=$_GET['id'];

// Query untuk mengambil detail basis aturan dan penyakit terkait
$sql = "SELECT basis_aturan.idaturan, basis_aturan.idpenyakit, penyakit.nmpenyakit, penyakit.keterangan
        FROM basis_aturan 
        INNER JOIN penyakit ON basis_aturan.idpenyakit = penyakit.idpenyakit
        WHERE basis_aturan.idaturan = '$idaturan'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
?> 

<!-- Tampilan Halaman Detail --> 
<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
            <div class="card">
            <div class="card-header bg-primary text-white border-dark"><strong>Detail Halaman Basis Aturan</strong></div>
                <div class="card-body">

            <div class="form-group">
            <label for="">Nama Penyakit</label>
            <input type="text" class="form-control" value="<?php echo $row['nmpenyakit'] ?>" name="nama" readonly>
            </div>
            <div class="form-group">
            <label for="">Keterangan</label>
            <input type="text" class="form-control" value="<?php echo $row['keterangan'] ?>" name="ket" readonly>
            </div>

            <!-- Tabel Gejala Gejala --> 
             <label for="">Gejala Gejala Penyakit :</label>
            <table class="table table-bordered">
            <thead>
            <tr>
                <th width="40px">No</th>
                <th width="700px">Nama Gejala</th>
            </tr>
            </thead>
            <tbody>
                <?php
                    $no=1;

                    // Query untuk mengambil detail gejala terkait dengan basis aturan
                    $sql = "SELECT detail_basis_aturan.idaturan, detail_basis_aturan.idgejala, gejala.nmgejala
                            FROM detail_basis_aturan
                            INNER JOIN gejala ON detail_basis_aturan.idgejala = gejala.idgejala
                            WHERE detail_basis_aturan.idaturan = '$idaturan'";

                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                 ?>
                 <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $row['nmgejala']; ?></td>
                 </tr>
                <?php
                    }
                    $conn->close();
                ?>
            </tbody>
            </table>

            <a class="btn btn-danger" href="?page=aturan">Kembali</a>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
