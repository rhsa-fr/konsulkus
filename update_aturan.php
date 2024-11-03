<?php
// Mengambil Parameter
$idaturan = $_GET['id'];

$sql = "SELECT basis_aturan.idaturan, basis_aturan.idpenyakit, penyakit.nmpenyakit
        FROM basis_aturan 
        INNER JOIN penyakit ON basis_aturan.idpenyakit = penyakit.idpenyakit 
        WHERE idaturan = '$idaturan'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Define $idpenyakit
$idpenyakit = $row['idpenyakit']; // Pastikan $idpenyakit didefinisikan

// Proses update
if (isset($_POST['update'])) {
    $idgejala = isset($_POST['idgejala']) ? $_POST['idgejala'] : [];

    // Mendapatkan semua gejala yang terkait dengan aturan saat ini
    $sqlAllGejala = "SELECT idgejala FROM detail_basis_aturan WHERE idaturan = '$idaturan'";
    $resultAllGejala = $conn->query($sqlAllGejala);
    $existingGejala = [];
    while ($rowGejala = $resultAllGejala->fetch_assoc()) {
        $existingGejala[] = $rowGejala['idgejala'];
    }

    // Hapus gejala yang tidak dicentang (yaitu, gejala yang ada di database tapi tidak ada di checkbox)
    foreach ($existingGejala as $gejala) {
        if (!in_array($gejala, $idgejala)) {
            $sqlDelete = "DELETE FROM detail_basis_aturan WHERE idaturan = '$idaturan' AND idgejala = '$gejala'";
            mysqli_query($conn, $sqlDelete);
        }
    }

    // Tambahkan gejala yang dicentang (jika belum ada di basis aturan)
    foreach ($idgejala as $idgejalane) {
        if (!in_array($idgejalane, $existingGejala)) {
            $sqlInsert = "INSERT INTO detail_basis_aturan (idaturan, idgejala) 
                        VALUES ('$idaturan', '$idgejalane')";
            mysqli_query($conn, $sqlInsert);
        }
    }

    // Redirect setelah selesai update
    header("Location:?page=aturan");
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>Update Data Basis Aturan</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Penyakit</label>
                            <input type="text" class="form-control" value="<?php echo $row['nmpenyakit']; ?>" name="nmpenyakit" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Pilih gejala-gejala berikut :</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="20px"></th>
                                        <th width="50px">No.</th>
                                        <th width="700px">Nama Gejala</th>
                                        <th width="50px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $sql = "SELECT * FROM gejala ORDER BY nmgejala ASC";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        $idgejala = $row['idgejala'];

                                        // Cek ke tabel detail basis aturan
                                        $sql2 = "SELECT * FROM detail_basis_aturan WHERE idaturan = '$idaturan' AND idgejala = '$idgejala'";
                                        $result2 = $conn->query($sql2);
                                        $isChecked = ($result2->num_rows > 0) ? "checked" : ""; // Jika ditemukan, berikan centang
                                    ?>
                                        <tr>
                                            <!-- Checkbox di sini -->
                                            <td align="center">
                                                <input type="checkbox" class="check-item" name="idgejala[]" value="<?php echo $idgejala; ?>" <?php echo $isChecked; ?>>
                                            </td>
                                            <td><?php echo $no++; ?></td> <!-- Tampilkan nomor -->
                                            <td><?php echo $row['nmgejala']; ?></td>
                                            <td align="center">
                                                <?php if ($isChecked) { ?>
                                                    <!-- Tampilkan tombol hapus jika checkbox dicentang -->
                                                    <a onclick="return confirm('Yakin menghapus gejala ini?')" class="btn btn-danger" href="?page=aturan&action=hapus_gejala&idaturan=<?php echo $idaturan ?>&idgejala=<?php echo $idgejala ?>">
                                                        <i class="fas fa-window-close"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                    } // Tutup while di sini
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <input class="btn btn-primary" type="submit" name="update" value="update">
                        <a class="btn btn-danger" href="?page=aturan">Batal</a>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
$conn->close();
?>
