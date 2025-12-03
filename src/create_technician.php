<?php
session_start();

if (empty($_SESSION['role']) || $_SESSION['role'] !== "administrateur_web") {
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

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    echo json_encode(["status"=>"error","message"=>"Connexion échouée"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO users (login, password, role) VALUES (?, ?, ?)");
$role = "technicien";
$stmt->bind_param("sss", $login, $hashed, $role);

if ($stmt->execute()) {
    echo "Utilisateur ajouté avec succès !";
    header("Location: index.php");
} else {
    echo "Erreur : " . $stmt->error;
}

$stmt->close();


