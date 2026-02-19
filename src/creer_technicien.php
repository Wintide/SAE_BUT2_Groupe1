<?php
session_start();

if (empty($_SESSION['role']) || $_SESSION['role'] !== "administrateur_web") {
    header("Location: index.php");
    exit();
}

$login = $_POST['login'];
$password = $_POST['password'];

if (!$login || !$password) {
    die("Champs manquants");
}

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

$check = $conn->prepare("SELECT * FROM users WHERE login = ?");
$check->bind_param("s", $login);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    $check->close();
    mysqli_close($conn);

    header("Location: webadmin.php?error=user_exists");
    exit();
}

$check->close();

$stmt = $conn->prepare("INSERT INTO users (login, password, role) VALUES (?, ?, ?)");
$role = "technicien";
$stmt->bind_param("sss", $login, $hashed, $role);

if ($stmt->execute()) {
    echo "<script>console.log('Utilisateur ajouté avec succès !');</script>";
    header("Location: webadmin.php");
} else {
    echo "Erreur : " . $stmt->error;
}

$stmt->close();
