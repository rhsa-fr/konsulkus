<?php
session_start();
//koneksi ke database
include "config.php";
?>

<!DOCTYPE html> 
<html lang="en"> 
<head>     
    <meta charset="UTF-8">     
    <meta name="viewport" content="width=device-width, initial-scale=1.0">     
    <title>Konsultasi Kita</title>      
    <!-- bootstrap css-->
    <link rel="stylesheet" href="Assets/css/bootstrap.min.css">     
    <!-- datatable css-->
    <link rel="stylesheet" href="Assets/css/datatables.min.css">
    <!-- Font-->
    <link rel="stylesheet" href="Assets/css/all.css">

    <link rel="stylesheet" href="Assets/css/bootstrap-chosen.css">

    <style>
        body {
            background-image: url('Assets/img/suster.jpg');
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed; 
            background-repeat: no-repeat;
            height: 100vh;
        }

        .container {
            padding-top: 20px;
            height: 2000px; 
        }

        .navbar {
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            padding: 15px 20px; 
            transition: background-color 0.3s ease; 
        }

        .navbar-nav .nav-link {
            padding: 10px 15px; 
            border-radius: 5px; 
            transition: background-color 0.3s ease, transform 0.3s ease; 
        }

        
        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2); 
            transform: scale(1.05); 
        }

        
        .navbar.navbar-expand-sm.bg-primary.navbar-dark {
            transition: background-color 0.3s ease-in-out;
        }
    </style>
</head>  
<body> 

<!-- navbar -->
<nav class="navbar navbar-expand-sm bg-primary navbar-dark ">
    <div class="container-fluid">
        <!-- Logo atau judul -->
        <a class="navbar-brand" href="#">Konsultasi Kita</a>
        
        <!-- Tombol toggle untuk tampilan mobile -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Isi Navbar -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

        <!-- setting hak akses -->
        <?php 
            if ($_SESSION['role'] == "Admin") {
        ?>
        <li class="nav-item active">
            <a class="nav-link" href="?page=users">Users</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="?page=gejala">Gejala</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="?page=penyakit">Penyakit</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="?page=aturan">Basis Aturan</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="?page=konsultasiadm">Konsultasi</a> 
        </li>
        <?php 
        }
        ?>


                <?php 
                    if ($_SESSION['role'] == "Konsultan") {
                ?>
    
                    <li class="nav-item active">
                    <a class="nav-link" href="?page=konsultasi">Konsultasi</a>
                    </li>
                <?php 
                    }
                ?>


                    
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link btn btn-danger text-white" href="?page=logout">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- cek status login -->
<?php 
    if($_SESSION['status']!="y"){
        header("Location:login.php");
    }
?>

<!-- container -->
<div class="container mt-2 mb-2">
    <!-- setting menu -->
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : "";
    $action = isset($_GET['action']) ? $_GET['action'] : "";

        if ($page == "") {
            include "welcome.php";
        } elseif ($page == "gejala") {
            if ($action == "") {
                include "tampil_gejala.php";
            } elseif ($action == "tambah") {
                include "tambah_gejala.php";
            } elseif ($action == "update") {
                include "update_gejala.php";
            } else {
                include "hapus_gejala.php";
            }
        }elseif ($page == "penyakit") {
        if ($action == "") {
            include "tampil_penyakit.php";
        } elseif ($action == "tambah") {
            include "tambah_penyakit.php";
        } elseif ($action == "update") {
            include "update_penyakit.php";
        } else {
            include "hapus_penyakit.php";
        }
        }elseif ($page == "aturan") {
        if ($action == "") {
            include "tampil_aturan.php";
        } elseif ($action == "tambah") {
            include "tambah_aturan.php";
        } elseif ($action == "detail") {
            include "detail_aturan.php";
        } elseif ($action == "update") {
            include "update_aturan.php";
        } elseif ($action == "hapus_gejala") {
            include "hapus_detail_aturan.php";
        } else {
            include "hapus_aturan.php";
        }
    }elseif ($page == "konsultasi") {
        if ($action == "") {
            include "tampil_konsultasi.php";
        } else {
            include "hasil_konsultasi.php";
        }
    }elseif ($page == "konsultasiadm") {
        if ($action == "") {
            include "tampil_konsultasiadm.php";
        } else {
            include "detail_konsultasiadm.php";
        }
    }elseif ($page == "users") {
        if ($action == "") {
            include "tampil_users.php";
        } elseif ($action == "tambah") {
            include "tambah_users.php";
        } elseif ($action == "update") {
            include "update_users.php";
        } else {
            include "hapus_users.php";
        }
    }else {
        include "logout.php";
    }
    ?>
</div>

<!-- jquery -->
<Script src="Assets/js/jquery-3.7.0.min.js"></Script>
<!-- bootstrap js -->
<Script src="Assets/js/bootstrap.min.js"></Script>
<!-- datatable js -->
<Script src="Assets/js/datatables.min.js"></Script>
<!-- dFont js -->
<Script src="Assets/js/all.js"></Script>

<Script src="Assets/js/chosen.jquery.min.js"></Script>
<script>
    $(function() {
        $('.chosen').chosen();
    });
</script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    } );
</script>
</body>
</html>
