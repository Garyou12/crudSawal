<?php
include "koneksi.php";

if ($_POST) {
    $nama  = $_POST['nama'];
    $merek = $_POST['merek'];
    $jenis = $_POST['jenis'];
    $diskon= $_POST['diskon'];
    $harga = $_POST['harga'];

    $sql = "INSERT INTO mobil (nama,merek,jenis,diskon,harga)
            VALUES ('$nama','$merek','$jenis','$diskon','$harga')";
    if ($conn->query($sql)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                showNotif('Data berhasil ditambahkan!');
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
    <title>Tambah Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
           margin: 0;
    padding: 0;
    background: #008B8B; /* mau ganti warna background di sini ya wal */
    font-family: Arial, sans-serif 
        }
        @keyframes fadeInPage {
            from {opacity:0; transform:translateY(20px);}
            to {opacity:1; transform:translateY(0);}
        }
        .card {
            background: rgba(0, 255, 255, 0.6); /* cyan transparan */
    color: #000;
    border-radius: 15px;
    border: 1px solid rgba(255,255,255,0.3);
    backdrop-filter: blur(10px);
    box-shadow: 0 6px 15px rgba(0,0,0,0.3);
    animation: slideUp 0.8s ease;       }
        @keyframes slideUp {
            from {transform: translateY(40px); opacity:0;}
            to {transform: translateY(0); opacity:1;}
        }
        .form-control {
            border: none;
            border-bottom: 2px solid #ffffffaa;
            border-radius: 0;
            background: transparent;
            color: #fff;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-bottom: 2px solid #fff;
            box-shadow: 0 2px 10px rgba(255,255,255,0.3);
            outline: none;
        }
        label {
            color: #fff;
        }
        .btn-blue {
            background-color: #0dcaf0;
            color: #fff;
            transition: transform 0.3s ease, background 0.3s;
        }
        .btn-blue:hover { transform: scale(1.05); background:#0bb8da; }
        .btn-green {
            background-color: #00ffc6;
            color: #000;
            transition: transform 0.3s ease, background 0.3s;
        }
        .btn-green:hover { transform: scale(1.05); background:#00d9a7; }
        .btn { position: relative; overflow: hidden; }
        .btn::after {
            content:""; position:absolute; background:rgba(255,255,255,0.4);
            border-radius:50%; transform:scale(0);
            width:100px;height:100px; opacity:0;
        }
        .btn:active::after {
            transform:scale(2.5); opacity:1;
            transition:transform 0.6s,opacity 1s;
            top:var(--y); left:var(--x);
        }
        #notif {
            position: fixed; top: 20px; right: -300px;
            background: #0dcaf0; color: white;
            padding: 15px 25px; border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            transition: right 0.5s ease; z-index: 1000;
        }
        #notif.show { right: 20px; }

        /* Animasi mobil */
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
            left: -60px; /* ganti ke right:-60px kalau mau keluar dari kanan */
            animation: driveRight 5s linear infinite;
            display: inline-block;
            transform: scaleX(-1);
        }
        @keyframes driveRight {
            from { left: -60px; }
            to { left: 100%; }
        }
        @keyframes driveLeft {
            from { right: -60px; }
            to { right: 100%; }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="car-animation text-center">
                    <span>🚗</span>
                </div>
                <div class="card p-4">
                    <h2 class="text-center mb-4" style="color:white;">Tambah Data Mobil</h2>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Merek</label>
                            <input type="text" name="merek" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis</label>
                            <input type="text" name="jenis" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Diskon (%)</label>
                            <input type="number" name="diskon" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" step="0.01" name="harga" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-blue">Kembali</a>
                            <button type="submit" class="btn btn-green">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="notif">Data berhasil ditambahkan!</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e){
                let x = e.clientX - e.target.offsetLeft;
                let y = e.clientY - e.target.offsetTop;
                btn.style.setProperty('--x', x+'px');
                btn.style.setProperty('--y', y+'px');
            });
        });
        function showNotif(msg){
            const notif = document.getElementById('notif');
            notif.textContent = msg;
            notif.classList.add('show');
            setTimeout(()=> notif.classList.remove('show'),2000);
        }
    </script>
</body>
</html>

