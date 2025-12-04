<?php
$host = "localhost";
$user = "root";
$pass = "root";
$db = "vines";
$conn = mysqli_connect($host, $user, $pass);

$databases = $_POST["add-info"];
$info = $_POST["info"];

error_reporting(E_ALL ^ E_NOTICE);

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
        $stmt = $base->prepare("INSERT INTO ? VALUES (?)");

        if($databases=="devices_ram_mb"||$databases=="devices_disk_gb"||$databases=="monitors_size_inch"){
            $stmt->bind_param("si", $databases, $info);
            echo "<script>console.log(typeof($info));</script>";
        } else{
            $stmt->bind_param("ss", $databases, $info);
            echo "<script>console.log(typeof($info));</script>";
        }

        if ($stmt->execute()) {
            echo "<script>console.log('Information ajoutée avec succès');</script>";
            header("Location: webadmin.php");
        } else {
            header("Location: webadmin.php?err=1");
        }
    }
}