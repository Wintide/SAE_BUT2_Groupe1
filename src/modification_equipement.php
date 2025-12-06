<?php
error_reporting(E_ALL ^ E_NOTICE);
header("Content-type:application/json");

$host = "localhost";
$user = "root";
$pass = "root";
$db = "vines";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    echo json_encode(["status" => "error", "message" => "Connexion échouée"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = isset($_POST["type"]) ? $_POST["type"] : null;
    $serial = isset($_POST["serial"]) ? $_POST["serial"] : null;

    if (!$type || !$serial) {
        echo json_encode(["status" => "error", "message" => "Données manquantes"]);
        exit;
    }

    if ($type == "uc") {
        $name = isset($_POST["name"]) ? $_POST["name"] : null;
        $cpu = isset($_POST["cpu"]) ? $_POST["cpu"] : null;
        $ram_mb = isset($_POST["ram_mb"]) ? $_POST["ram_mb"] : null;
        $disk_gb = isset($_POST["disk_gb"]) ? $_POST["disk_gb"] : null;
        $os = isset($_POST["os"]) ? $_POST["os"] : null;
        $domain = isset($_POST["domain"]) ? $_POST["domain"] : null;
        $location = isset($_POST["location"]) ? $_POST["location"] : null;
        $building = isset($_POST["building"]) ? $_POST["building"] : null;
        $room = isset($_POST["room"]) ? $_POST["room"] : null;
        $warranty = isset($_POST["warranty"]) ? $_POST["warranty"] : null;

        if (!$name || !$cpu || !$ram_mb || !$disk_gb || !$os || !$domain || !$location || !$building || !$room || !$warranty) {
            echo json_encode(["status" => "error", "message" => "Données manquantes pour UC"]);
            exit;
        }

        $sql = "UPDATE devices SET 
                    name = ?, 
                    cpu = ?, 
                    ram_mb = ?, 
                    disk_gb = ?, 
                    os = ?, 
                    domain = ?, 
                    location = ?, 
                    building = ?, 
                    room = ?, 
                    warranty_end = STR_TO_DATE(?, '%Y-%m-%d')
                WHERE serial = ?";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssssss", $name, $cpu, $ram_mb, $disk_gb, $os, $domain, $location, $building, $room, $warranty, $serial);
    }

    else if ($type == "monitor") {
        $resolution = isset($_POST["resolution"]) ? $_POST["resolution"] : null;
        $connector = isset($_POST["connector"]) ? $_POST["connector"] : null;
        $attachedto = isset($_POST["attached_to"]) ? $_POST["attached_to"] : null;

        if (!$resolution || !$connector || !$attachedto) {
            echo json_encode(["status" => "error", "message" => "Données manquantes pour le moniteur"]);
            exit;
        }

        $sql = "UPDATE monitors SET 
                    resolution = ?, 
                    connector = ?, 
                    attached_to = ?
                WHERE serial = ?";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $resolution, $connector, $attachedto, $serial);
    }

    // Exécution de la requête
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($conn)]);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
