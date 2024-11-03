<?php
include 'config.php';
date_default_timezone_set("Asia/Jakarta");

//proses konsultasi
if(isset($_POST['kirim'])){

    //mengambil data dari form
    $nmpasien = $_POST['nmpasien'];
    $tgl = date("Y-m-d");

    //proses simpan konsultasi
    $sql = "INSERT INTO konsultasi (tanggal, nama) VALUES ('$tgl','$nmpasien')";
    mysqli_query($conn, $sql);

    //proses mengambil data konsultasi terakhir
    $sql = "SELECT * FROM konsultasi ORDER BY idkonsultasi DESC LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $idkonsultasi = $row['idkonsultasi'];

    //proses mengambil data gejala yang dipilih dengan nilai 'iya'
    $sql_gejala = "SELECT * FROM gejala";
    $result_gejala = $conn->query($sql_gejala);
    while ($row_gejala = $result_gejala->fetch_assoc()) {
        $idgejala = $row_gejala['idgejala'];
        $pilihan = $_POST['idgejala_' . $idgejala];

        if ($pilihan == 'iya') {
            // simpan gejala yang dipilih ke detail_konsultasi
            $sql = "INSERT INTO detail_konsultasi (idkonsultasi, idgejala) VALUES ('$idkonsultasi','$idgejala')";
            mysqli_query($conn, $sql);
        }
    }

    //mengambil data dari tabel penyakit dan cek basis aturan
    $sql = "SELECT * FROM penyakit";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {

        $idpenyakit = $row['idpenyakit'];
        $jyes = 0;

        //mencari jumlah gejala di basis aturan berdasarkan penyakit
        $sql2 = "SELECT COUNT(idpenyakit) AS jml_gejala
                 FROM basis_aturan 
                 INNER JOIN detail_basis_aturan ON basis_aturan.idaturan = detail_basis_aturan.idaturan
                 WHERE idpenyakit='$idpenyakit'";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();
        $jml_gejala = $row2['jml_gejala'];

        //mencari gejala pada basis aturan
        $sql3 = "SELECT idpenyakit, idgejala
                 FROM basis_aturan 
                 INNER JOIN detail_basis_aturan ON basis_aturan.idaturan = detail_basis_aturan.idaturan
                 WHERE idpenyakit='$idpenyakit'";
        $result3 = $conn->query($sql3);
        while($row3 = $result3->fetch_assoc()) {

            $idgejalane = $row3['idgejala'];

            //membandingkan apakah yang dipilih pada konsultasi sesuai
            $sql4 = "SELECT idgejala FROM detail_konsultasi 
                     WHERE idkonsultasi='$idkonsultasi' AND idgejala='$idgejalane'";
            $result4 = $conn->query($sql4);
            if ($result4->num_rows > 0) {
                $jyes++;
            }
        }

        //mencari persentase
        if($jml_gejala > 0){
            $peluang = round(($jyes / $jml_gejala) * 100, 2);
        } else {
            $peluang = 0;   
        }

        //simpan data detail penyakit
        if($peluang > 0){
            $sql = "INSERT INTO detail_penyakit (idkonsultasi, idpenyakit, persentase) 
                    VALUES ('$idkonsultasi', '$idpenyakit', '$peluang')";
            mysqli_query($conn, $sql);
        }
    }

    // redirect ke halaman hasil konsultasi
    header("Location:?page=konsultasi&action=hasil&idkonsultasi=$idkonsultasi");
}
?>


<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST" name="Form" onsubmit="return validasiForm()">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark">
                        <strong>Konsultasi Pasien</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nama Pasien</label>
                            <input type="text" class="form-control" name="nmpasien" maxlength="80" required>
                        </div>

                        <div class="form-group">
                            <label for="">Pilih gejala-gejala berikut :</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="20px">No.</th>
                                        <th width="700px">Nama Gejala</th>
                                        <th width="100px">Iya</th>
                                        <th width="100px">Tidak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $sql = "SELECT * FROM gejala ORDER BY nmgejala ASC";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $no++; ?></td>
                                        <td><?php echo $row['nmgejala']; ?></td>
                                        <td align="center">
                                            <input type="radio" name="<?php echo 'idgejala_' . $row['idgejala']; ?>" value="iya" required>
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="<?php echo 'idgejala_' . $row['idgejala']; ?>" value="tidak" required>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <input class="btn btn-primary" type="submit" name="kirim" value="Kirim">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script type="text/javascript">
    function validasiForm() {
        var radios = document.querySelectorAll('input[type="radio"]:checked');
        if (radios.length === 0) {
            alert('Pilih setidaknya satu gejala boskuh!!');
            return false;
        }
        return true;
    }
</script>
