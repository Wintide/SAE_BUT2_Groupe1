<?php
$host = "localhost";
$user = "root";
$pass = "root";
$db = "vines";
$conn = mysqli_connect($host, $user, $pass);

$databases = $_POST["add-info"];
$info = $_POST["info"];

if (!$conn) {
    echo "<script>console.log('Erreur connexion serveur');</script>";
}
else {
    echo "<script>console.log('Connecté au serveur !');</script>";
    $base = mysqli_select_db($conn, $db);
    if (!$base) {
        echo "<script>console.log('Erreur connexion BD');</script>";
    } else {
        echo "<script>console.log('Connecté à la BD !');</script>";
        $type = gettype($info);
        echo "<script>console.log('Type de info: ' + '$type');</script>";
        $stmt = $conn->prepare("INSERT INTO ? VALUES (?)");
        $stmt->bind_param("s"+$type, $databases, $info);

        if ($stmt->execute()) {
            echo "<script>console.log('Information ajoutée avec succès');</script>";
            header("Location: webadmin.php");
        } else {
            header("Location: webadmin.php?err=1");
        }
    }
}