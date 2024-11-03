<?php 

$idusers = $_GET['id'];

if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    // proses update untuk username dan password
    $sql = "UPDATE users SET username='$username', pass='$pass' WHERE idusers='$idusers'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=users");
    }
}

// Mengambil data pengguna berdasarkan idusers
$sql = "SELECT * FROM users WHERE idusers='$idusers'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!-- Memasukkan Font Awesome melalui CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>Update Data Users</strong></div>
                    <div class="card-body">
                        <!-- Username -->
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $row['username'] ?>" required>
                        </div>
                        
                        <!-- Password -->
                        <div class="form-group">
                            <label for="">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="pass" name="pass" value="<?php echo $row['pass'] ?>" readonly>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword" onclick="togglePasswordVisibility()">
                                        <i class="fa fa-eye" id="icon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Role (readonly) -->
                        <div class="form-group">
                            <label for="">Role</label>
                            <input type="text" class="form-control" name="role" value="<?php echo $row['role']; ?>" readonly>
                        </div>

                        <!-- Tombol Update dan Batal -->
                        <input class="btn btn-primary" type="submit" name="update" value="Update">
                        <a class="btn btn-danger" href="?page=users">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Script untuk Show/Hide Password dengan Icon -->
<script>
function togglePasswordVisibility() {
    var passwordInput = document.getElementById('pass');
    var icon = document.getElementById('icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
