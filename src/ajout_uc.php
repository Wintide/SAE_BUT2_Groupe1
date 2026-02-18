<?php

// Connexion à la BD
$host = "localhost";
$user = "root";
$pass = "root";
$db = "vines";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Erreur connexion BDD : " . mysqli_connect_error());
}

$name = isset($_POST["name"]) ? $_POST["name"] : null;
$name = isset($_POST["name"]) ? $_POST["name"] : null;
$serial = isset($_POST["serial"]) ? $_POST["serial"] : null;
$manufacturer = isset($_POST["manufacturer"]) ? $_POST["manufacturer"] : null;
$model = isset($_POST["model"]) ? $_POST["model"] : null;
$type = isset($_POST["type"]) ? $_POST["type"] : null;
$cpu = isset($_POST["cpu"]) ? $_POST["cpu"] : null;
$ram_mb = isset($_POST["ram_mb"]) ? $_POST["ram_mb"] : null;
$disk_gb = isset($_POST["disk_gb"]) ? $_POST["disk_gb"] : null;
$os = isset($_POST["os"]) ? $_POST["os"] : null;
$domain = isset($_POST["domain"]) ? $_POST["domain"] : null;
$location = isset($_POST["location"]) ? $_POST["location"] : null;
$building = isset($_POST["building"]) ? $_POST["building"] : null;
$room = isset($_POST["room"]) ? $_POST["room"] : null;
$purchase_date = isset($_POST["purchase_date"]) ? $_POST["purchase_date"] : null;
$macaddr = isset($_POST["macaddr"]) ? $_POST["macaddr"] : null;
$warranty_end = isset($_POST["warranty_end"]) ? $_POST["warranty_end"] : null;


$stmt = mysqli_prepare($conn, "
    INSERT INTO devices
    (name, serial, manufacturer, model, type, cpu, ram_mb, disk_gb, os, domain, location, building, room, purchase_date, macaddr, warranty_end)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

if ($stmt) {

    mysqli_stmt_bind_param(
        $stmt,
        "ssssssiiisssssss",
        $name,
        $serial,
        $manufacturer,
        $model,
        $type,
        $cpu,
        $ram_mb,
        $disk_gb,
        $os,
        $domain,
        $location,
        $building,
        $room,
        $purchase_date,
        $macaddr,
        $warranty_end
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ajout_avec_formulaire.php?success=uc");
        exit();
    } else {
        echo "Erreur exécution : " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);

} else {
    echo "Erreur préparation : " . mysqli_error($conn);
}

mysqli_close($conn);
