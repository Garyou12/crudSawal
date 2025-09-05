<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM mobil WHERE id=$id")->fetch_assoc();

if ($_POST) {
    $nama  = $_POST['nama'];
    $merek = $_POST['merek'];
    $jenis = $_POST['jenis'];
    $diskon= $_POST['diskon'];
    $harga = $_POST['harga'];

    $sql = "UPDATE mobil SET nama='$nama', merek='$merek', jenis='$jenis',
            diskon='$diskon', harga='$harga' WHERE id=$id";
    if ($conn->query($sql)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                showNotif('Data berhasil diupdate!');
                setTimeout(()=>{ window.location='index.php'; },2000);
            });
        </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #008B8B;
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            animation: fadeInPage 1s ease-in;
        }
        @keyframes fadeInPage {
            from {opacity:0; transform:translateY(20px);}
            to {opacity:1; transform:translateY(0);}
        }

        .card {
            background-color: rgba(0, 255, 255, 0.6);
            color: #000;
            border-radius: 20px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
            animation: slideUp 0.8s ease;
        }
        @keyframes slideUp {
            from {transform: translateY(40px); opacity:0;}
            to {transform: translateY(0); opacity:1;}
        }

        h2 {
            color: #00acc1;
            font-weight: bold;
        }

        /* Mobil animasi di atas card */
        .car-animation {
            font-size: 2.5rem;
            position: relative;
            width: 100%;
            overflow: hidden;
            margin-bottom: 15px;
            height: 50px;
        }
        .car-animation span {
            position: absolute;
            left: -60px; /* mulai dari kanan */
            animation: driveLeft 5s linear infinite;
            display: inline-block;
            transform: scaleX(-1); /* kebalikin arah mobil */
        }
        @keyframes driveLeft {
            from { left: -60px; }
            to { left: 100%; }
        }

        /* Input */
        .form-control {
            border: none;
            border-bottom: 2px solid #ddd;
            border-radius: 0;
            background: transparent;
            color: #000;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-bottom: 2px solid #00acc1;
            box-shadow: 0 2px 10px rgba(0,172,193,0.4);
            outline: none;
        }

        /* Tombol */
        .btn-blue {
            background-color: #00acc1;
            color: #fff;
            transition: transform 0.3s ease, background 0.3s;
        }
        .btn-blue:hover {
            transform: scale(1.05);
            background-color: #0097a7;
        }

        .btn-green {
            background-color: #26c6da;
            color: #fff;
            transition: transform 0.3s ease, background 0.3s;
        }
        .btn-green:hover {
            transform: scale(1.05);
            background-color: #00acc1;
        }

        /* Ripple Effect */
        .btn {
            border-radius: 8px;
            position: relative;
            overflow: hidden;
        }
        .btn::after {
            content: "";
            position: absolute;
            background: rgba(255,255,255,0.5);
            border-radius: 50%;
            transform: scale(0);
            width: 100px;
            height: 100px;
            opacity: 0;
            pointer-events: none;
        }
        .btn:active::after {
            transform: scale(2.5);
            opacity: 1;
            transition: transform 0.6s, opacity 1s;
            top: var(--y);
            left: var(--x);
        }

        /* Notifikasi */
        #notif {
            position: fixed;
            top: 20px;
            right: -300px;
            background: #26c6da;
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            transition: right 0.5s ease;
            z-index: 1000;
        }
        #notif.show {
            right: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Mobil jalan -->
        <div class="car-animation text-center">
            <span>🚗</span>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h2 class="text-center mb-4" style="color:white;">Edit Data Mobil</h2>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Merek</label>
                            <input type="text" name="merek" class="form-control" value="<?= $data['merek']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis</label>
                            <input type="text" name="jenis" class="form-control" value="<?= $data['jenis']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Diskon (%)</label>
                            <input type="number" name="diskon" class="form-control" value="<?= $data['diskon']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" step="0.01" name="harga" class="form-control" value="<?= $data['harga']; ?>" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-blue">Kembali</a>
                            <button type="submit" class="btn btn-green">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifikasi -->
    <div id="notif">Data berhasil diupdate!</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Ripple Effect posisi klik
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e){
                let x = e.clientX - e.target.offsetLeft;
                let y = e.clientY - e.target.offsetTop;
                btn.style.setProperty('--x', x+'px');
                btn.style.setProperty('--y', y+'px');
            });
        });

        // Notif function
        function showNotif(msg) {
            const notif = document.getElementById('notif');
            notif.textContent = msg;
            notif.classList.add('show');
            setTimeout(() => {
                notif.classList.remove('show');
            }, 2000);
        }
    </script>
</body>
</html>

