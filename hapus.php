<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM mobil WHERE id=$id");
}
header("Location: index.php");
?>

