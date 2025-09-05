<?php
session_start();
include "koneksi.php";

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $result = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Rental Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(#87CEEB, #e0f7fa);
            overflow: hidden;
            animation: fadeInPage 1s ease-in;
        }
        @keyframes fadeInPage {
            from {opacity:0; transform:translateY(20px);}
            to {opacity:1; transform:translateY(0);}
        }
        /* Jalan */
        .road {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 200px;
            background: #333;
            overflow: hidden;
        }
        .lane {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 10px;
            background: repeating-linear-gradient(
                to right,
                yellow 0,
                yellow 50px,
                transparent 50px,
                transparent 100px
            );
            animation: moveLane 2s linear infinite;
        }
        @keyframes moveLane {
            from {background-position: 0 0;}
            to {background-position: 100px 0;}
        }
        /* Mobil animasi */
        .car {
            position: absolute;
            bottom: 50px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 60px;
            animation: bounceCar 1s infinite ease-in-out;
        }
        @keyframes bounceCar {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(-10px); }
        }
        /* Card login */
        .card {
            position: relative;
            z-index: 10;
            background: rgba(255,255,255,0.95);
            border-radius: 15px;
            padding: 30px;
            color: #000;
            box-shadow: 0 0 25px rgba(0,0,0,0.4);
            animation: slideUp 1s ease;
        }
        @keyframes slideUp {
            from {transform: translateY(50px); opacity:0;}
            to {transform: translateY(0); opacity:1;}
        }
        .btn-car {
            background: linear-gradient(45deg, #FFD700, #FFA500);
            border: none;
            color: #000;
            font-weight: bold;
            transition: transform 0.3s ease, background 0.3s;
        }
        .btn-car:hover {
            transform: scale(1.05);
            background: linear-gradient(45deg, #FFA500, #FFD700);
        }
        h2 {
            text-shadow: 0 0 5px #FFA500, 0 0 10px #FFD700;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center" style="height:100vh;">
        <div class="card col-md-4">
            <h2 class="text-center mb-4">🚗 Login 🚗</h2>
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
                <button type="submit" class="btn btn-car w-100">Login</button>
            </form>
            <a href="register.php">Belum punya akun? Klik di sini</a>
        </div>
    </div>

    <!-- Animasi jalan dan mobil -->
    <div class="road">
        <div class="lane"></div>
        <div class="car">🚙💨</div>
    </div>
</body>
</html>

