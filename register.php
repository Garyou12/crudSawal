<?php
include "koneksi.php";

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "INSERT INTO users (username, password) VALUES ('$username','$password')";
    if ($conn->query($sql)) {
        $success = "Akun berhasil dibuat! Silakan login 🚦";
    } else {
        $error = "Gagal daftar: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - Rental Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: #222;
            overflow: hidden;
            animation: fadeInPage 1s ease-in;
            color: white;
        }
        @keyframes fadeInPage {
            from {opacity:0; transform:translateY(20px);}
            to {opacity:1; transform:translateY(0);}
        }

        /* jalan raya */
        .road {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 320px;
            height: 100%;
            background: #444;
            border-left: 8px solid yellow;
            border-right: 8px solid yellow;
            overflow: hidden;
        }
        .road::before {
            content: "";
            position: absolute;
            top: 0;
            left: 50%;
            width: 12px;
            height: 100%;
            transform: translateX(-50%);
            background: repeating-linear-gradient(
                to bottom,
                white 0 40px,
                transparent 40px 80px
            );
            animation: moveLines 0.5s linear infinite;
        }
        @keyframes moveLines {
            from { background-position: 0 0; }
            to { background-position: 0 80px; }
        }

        /* mobil PNG */
        .car-npc {
            width: 200px;   
            height: 280px;  
            background: url('Asset/images-removebg-preview.png') no-repeat center/contain;
            position: absolute;
            top: -220px;  /* mulai dari atas */
            left: 50%;
            transform: translateX(-50%);
            animation: moveUp 4s linear infinite;
        }
        @keyframes moveUp {
    from {
        top: 100%; 
    }
    to {
        top: -200px; 
    }
}
        @keyframes npcMove {
            from { top: -220px; }
            to { top: 110%; }
        }

        /* card register */
        .card {
            position: relative;
            z-index: 10;
            background: rgba(255,255,255,0.95);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 25px rgba(0,200,255,0.6);
            animation: slideUp 1s ease;
            color: #000;
        }
        @keyframes slideUp {
            from {transform: translateY(80px); opacity:0;}
            to {transform: translateY(0); opacity:1;}
        }

        .form-control {
            background: rgba(0,0,0,0.05);
            border: 1px solid #ccc;
            border-radius: 10px;
            color: #000;
        }
        .form-control:focus {
            box-shadow: 0 0 10px #00c8ff;
        }

        .btn-race {
            background: linear-gradient(45deg, #00c8ff, #0077b6);
            border: none;
            color: #fff;
            font-weight: bold;
            transition: transform 0.3s ease, opacity 0.3s;
            border-radius: 10px;
        }
        .btn-race:hover {
            transform: scale(1.05);
            opacity: 0.9;
        }

        h2 {
            text-align: center;
            color: #00c8ff;
            text-shadow: 0 0 10px #00c8ff, 0 0 20px #0077b6;
        }
        a {
            color: #00c8ff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Jalan + mobil -->
    <div class="road">
        <div class="car-npc"></div>
    </div>

    <!-- Form -->
    <div class="d-flex justify-content-center align-items-center" style="height:100vh;">
        <div class="card col-md-4">
            <h2 class="mb-4">🚦 Registrasi 🚦</h2>
            <?php if($success): ?>
                <div class="alert alert-success text-center"><?= $success; ?></div>
            <?php endif; ?>
            <?php if($error): ?>
                <div class="alert alert-danger text-center"><?= $error; ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-race w-100">Daftar</button>
            </form>
            <div class="text-center mt-3">
                <a href="login.php">Sudah punya akun? Login di sini</a>
            </div>
        </div>
    </div>
</body>
</html>

