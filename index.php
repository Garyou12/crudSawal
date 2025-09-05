<?php
session_start();
include "koneksi.php";

// Logout handler
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

$result = $conn->query("SELECT * FROM mobil");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0f7fa, #ffffff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            animation: fadeInPage 1s ease-in;
        }
        @keyframes fadeInPage {
            from {opacity:0; transform:translateY(20px);}
            to {opacity:1; transform:translateY(0);}
        }
        .card {
            background-color: #ffffff;
            color: #000;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
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
        table {
            background: #fff;
            color: #000;
            border-radius: 12px;
            overflow: hidden;
        }
        th {
            background: #00bcd4;
            color: #fff;
        }
        td, th {
            padding: 12px;
        }
        .btn-blue {
            background-color: #00acc1;
            color: #fff;
            transition: transform 0.3s ease, background 0.3s;
        }
        .btn-blue:hover { transform: scale(1.05); background:#0097a7; }
        .btn-green {
            background-color: #26c6da;
            color: #fff;
            transition: transform 0.3s ease, background 0.3s;
        }
        .btn-green:hover { transform: scale(1.05); background:#00acc1; }
        .btn-red {
            background-color: #ef5350;
            color: #fff;
            transition: transform 0.3s ease, background 0.3s;
        }
        .btn-red:hover { transform: scale(1.05); background:#d32f2f; }
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
            width: 100px; height: 100px;
            opacity: 0; pointer-events: none;
        }
        .btn:active::after {
            transform: scale(2.5);
            opacity: 1;
            transition: transform 0.6s, opacity 1s;
            top: var(--y);
            left: var(--x);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4">
            <h2 class="text-center mb-4">Data Mobil Rental</h2>
            <div class="d-flex justify-content-between mb-3">
                <a href="tambah.php" class="btn btn-green">+ Tambah Mobil</a>
                <a href="?logout=true" class="btn btn-red">Logout</a>
            </div>
            <table class="table table-bordered text-center">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Merek</th>
                    <th>Jenis</th>
                    <th>Diskon (%)</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
                <?php $no = 1; ?>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['merek']; ?></td>
                    <td><?= $row['jenis']; ?></td>
                    <td><?= $row['diskon']; ?></td>
                    <td><?= number_format($row['harga'],2,',','.'); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-blue btn-sm">Edit</a>
                        <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin hapus?')" class="btn btn-red btn-sm">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <script>
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e){
                let x = e.clientX - e.target.offsetLeft;
                let y = e.clientY - e.target.offsetTop;
                btn.style.setProperty('--x', x+'px');
                btn.style.setProperty('--y', y+'px');
            });
        });
    </script>
</body>
</html>

