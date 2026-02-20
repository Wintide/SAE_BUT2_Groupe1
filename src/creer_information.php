<?php
$host = "localhost";
$user = "root";
$pass = "root";
$db = "vines";
$conn = mysqli_connect($host, $user, $pass, $db);

$databases = $_POST["add-info"];
$info = $_POST["info"];

if(empty($info)){
    header("Location: webadmin.php?error=empty");
}

error_reporting(E_ALL ^ E_NOTICE);

if (!($conn)) {
    echo "<script>console.log('Erreur connexion BD');</script>";
} else {
    if (strpos($databases, "devices_") === 0) {
        $databases_cut = str_replace("devices_", "", $databases);
    } elseif (strpos($databases, "monitors_") === 0) {
        $databases_cut = str_replace("monitors_", "", $databases);
    }

    $verif = $conn->query("SELECT * FROM $databases WHERE $databases_cut");
    foreach($verif as $row){
        if ($info == $row[$databases_cut]){
            header("Location: webadmin.php?error=exist");
        }
    }

    if($databases=="devices_ram_mb"||$databases=="devices_disk_gb"||$databases=="monitors_size_inch"){
        $stmt = $conn->prepare("INSERT INTO $databases($databases_cut) VALUES (?)");
        $stmt->bind_param("i",$info);
        echo "<script>console.log(typeof($info));</script>";
    } else{
        $stmt = $conn->prepare("INSERT INTO $databases($databases_cut) VALUES (?)");
        $stmt->bind_param("s", $info);
        echo "<script>console.log(typeof($info));</script>";
    }

    if ($stmt->execute()) {
        echo "<script>console.log('Information ajoutée avec succès');</script>";
        header("Location: webadmin.php");
    } else {
        header("Location: webadmin.php?error=exec");
    }
}