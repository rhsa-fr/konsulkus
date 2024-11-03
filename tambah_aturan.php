<?php

if(isset($_POST['simpan'])){
    $nmpenyakit=$_POST['nmpenyakit'];
	
    // validasi
    $sql = "SELECT basis_aturan.idaturan, basis_aturan.idpenyakit, penyakit.nmpenyakit
                FROM basis_aturan  INNER JOIN penyakit ON basis_aturan.idpenyakit=penyakit.idpenyakit
                WHERE nmpenyakit='$nmpenyakit'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Data basis aturan penyakit tersebut tidak ada</strong>
            </div>
        <?php
    }else{
        
        //mengambil data
            $sql = "SELECT * FROM penyakit WHERE nmpenyakit='$nmpenyakit'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $idpenyakit=$row['idpenyakit'];

        //proses simpan
            $sql = "INSERT INTO basis_aturan VALUES (Null,'$idpenyakit')";
            mysqli_query($conn,$sql);
        
        //mengambil id gejala
            $idgejala= $_POST['idgejala'];

        //proses mengambil data aturan
            $sql = "SELECT * FROM basis_aturan ORDER BY idaturan DESC";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $idpenyakit=$row['idaturan'];

        //proses simpan basis aturan
            $jumlah = count($idgejala);
            $i=0;
            while($i < $jumlah){
                $idgejalane=$idgejala[$i];
                $sql = "INSERT INTO detail_basis_aturan VALUES ($idpenyakit,'$idgejalane')";
                mysqli_query($conn,$sql);
                $i++;
            }
                header("Location:?page=aturan");
    }
}
?>
<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST" name="Form" onsubmit="return validasiForm()">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Tambah Data Basis Aturan</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Penyakit</label>
                        <select class="form-control chosen" data-placeholder="Pilih Nama Penyakit" name="nmpenyakit">
                            <option value=""></option>
                            <?php
                                $sql = "SELECT * FROM penyakit";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['nmpenyakit']; ?>"><?php echo $row['nmpenyakit']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Pilih gejala-gejala berikut :</label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="20px"></th>
                                    <th width="50px">No.</th>
                                    <th width="700px">Nama Gejala</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no=1;
                                    $sql = "SELECT*FROM gejala ORDER BY nmgejala ASC";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td align="center"><input type="checkbox" class="check-item" name="<?php echo 'idgejala[]';?>" value="<?php echo $row['idgejala']; ?>"></td>
                                    <td align="center"><?php echo $no++; ?></td>
                                    <td><?php echo $row['nmgejala']; ?></td>
                                </tr>
                                    <?php
                                        }
                                        $conn->close();
                                    ?>`
                            </tbody>
                        </table>
                    </div>

                <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                <a class="btn btn-danger" href="?page=penyakit">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function validasiForm() {
        // Validasi nama penyakit
        var nmpenyakit = document.forms["Form"]["nmpenyakit"].value;

        if (nmpenyakit == "") {
            alert("Pilih Nama Penyakit terlebih dahulu boskuh!!");
            return false;
        }

        // Validasi gejala yang belum dipilih
        var checkboxes = document.getElementsByName('idgejala[]');
        var isChecked = false;

        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                isChecked = true;
                break;
            }
        }

        // Jika belum ada gejala yang dipilih
        if (!isChecked) {
            alert('Pilih setidaknya satu gejala boskuh!!');
            return false;
        }

        return true;
    }
</script>
