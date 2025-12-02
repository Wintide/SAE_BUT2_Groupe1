<?php
session_start();

if (empty($_SESSION['role']) || $_SESSION['role'] !== "adminweb") {
    header("Location: index.php");
    exit();
}

$login = $_POST['login'];
$password = $_POST['password'];

$hashed = md5($password);

$host = "localhost";
$user = "root";
$pass = "root";
$db = "vines";

$conn = mysqli_connect($host, $user, $pass);
$base = mysqli_select_db($conn, $db);

if (!$conn || !$base) {
    die("Erreur de connexion à la base de données");
}

$sql = "INSERT INTO users (login, password, role) VALUES ('$login', '$hashed', 'tech')";

if (mysqli_query($conn, $sql)) {
    header("Location: webadmin.php?success=1");
    exit();
} else {
    echo "Erreur : " . mysqli_error($conn);
}
