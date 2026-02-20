<?php
session_start();

if (empty($_SESSION['role']) || $_SESSION['role'] !== "administrateur_web") {
    header("Location: index.php");
    exit();
}

if (!isset($_POST['login'], $_POST['password'], $_POST['password_confirm'])) {
    die("Champs manquants");
}

$login = $_POST['login'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

$minLength = 8;

if (strlen($password) < $minLength) {
    header("Location: webadmin.php?error=pwd_too_short");
    exit();
}

if (strlen($login) < 1) {
    header("Location: webadmin.php?error=empty_login");
    exit();
}

if ($password !== $password_confirm) {
    header("Location: webadmin.php?error=pwd_mismatch");
    exit();
}

$hashed = md5($password);
$hashed_confirm = md5($password_confirm);

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
    header("Location: webadmin.php?success=ajout");
} else {
    echo "Erreur : " . $stmt->error;
}

$stmt->close();
