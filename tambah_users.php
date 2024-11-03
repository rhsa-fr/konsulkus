<?php

if(isset($_POST['simpan'])){

    //mengambil data
    $username=$_POST['username'];
    $pass=md5($_POST['pass']);
    $role=$_POST['role'];

	//proses simpan
        $sql = "INSERT INTO users VALUES (Null,'$username', '$pass', '$role')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=users");
        }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>Tambah Data Users</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" maxlength="20" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="pass" id="password" maxlength="10" required>
                                <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                                    <i class="fa fa-eye" id="toggleIcon"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Role</label>
                            <select class="form-control chosen" data-placeholder="Pilih Role" name="role">
                                <option value=""></option>
                                <option value="Admin">Admin</option>
                                <option value="Konsultan">Konsultan</option>
                            </select>
                        </div>

                        <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                        <a class="btn btn-danger" href="?page=users">Batal</a>

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function togglePassword() {
    var passwordInput = document.getElementById("password");
    var toggleIcon = document.getElementById("toggleIcon");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    }
}
</script>
