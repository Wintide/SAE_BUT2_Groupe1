<?php
session_start();

if (empty($_SESSION['role']) || $_SESSION['role'] !== "administrateur_web") {
    header("Location: index.php");
    exit();
}

$login = $_POST['login'];

if (!$login) {
    die("Champs manquants");
}

if($login=="tech1"){
    header("Location: webadmin.php?error=tech1");
    exit();
}

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

if ($check->num_rows !== 1) {
    $check->close();
    mysqli_close($conn);

    header("Location: webadmin.php?error=user_dont_exist");
    exit();
}

$check->close();

$stmt = $conn->prepare("DELETE FROM users WHERE login = ?");
$stmt->bind_param("s", $login);

if ($stmt->execute()) {
    echo "<script>console.log('Utilisateur supprimer avec succès !');</script>";
    header("Location: webadmin.php?success=suppression");
} else {
    echo "Erreur : " . $stmt->error;
}

$stmt->close();
