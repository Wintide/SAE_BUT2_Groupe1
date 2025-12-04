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
        $sql_insert = "INSERT INTO $databases($databases) VALUES ('$info')";
        if (mysqli_query($conn, $sql_insert)) {
            echo "<script>console.log('Information ajoutée avec succès');</script>";
            header("Location: webadmin.php");
        } else {
            header("Location: webadmin.php?err=1");
        }
    }
}