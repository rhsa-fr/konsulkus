<?php 

$idpenyakit=$_GET['id'];

if(isset($_POST['update'])){
    $nmpenyakit=$_POST['nmpenyakit'];
    $ket=$_POST['keterangan'];
    $solusi=$_POST['solusi'];

    // proses update
    $sql = "UPDATE penyakit SET nmpenyakit='$nmpenyakit', keterangan='$ket', solusi='$solusi' WHERE idpenyakit='$idpenyakit'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=penyakit");
    }
}

$sql = "SELECT * FROM penyakit WHERE idpenyakit='$idpenyakit'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Update Data Penyakit</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Penyakit</label>
                        <input type="text" class="form-control" name="nmpenyakit" value="<?php echo $row['nmpenyakit']  ?>" maxlength="80" required>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" value="<?php echo $row['keterangan']  ?>" maxlength="500" required>
                    </div>
                    <div class="form-group">
                        <label for="">Solusi</label>
                        <input type="text" class="form-control" name="solusi" value="<?php echo $row['solusi']  ?>" maxlength="200" required>
                    </div>

                <input class="btn btn-primary" type="submit" name="update" value="Update">
                <a class="btn btn-danger" href="?page=gejala">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>