<?php

// Connexion à la BD
$host = "localhost";
$user = "root";
$pass = "root";
$db = "vines";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Erreur connexion BD : " . mysqli_connect_error());
}

function post_or_null($key) {
    return (isset($_POST[$key]) && $_POST[$key] !== "") ? $_POST[$key] : null;
}

$name = post_or_null("name");
$serial = post_or_null("serial");
$manufacturer = post_or_null("manufacturer");

if ($name == null || $serial == null || $manufacturer == null) {
    header("Location: ajout_avec_formulaire.php?error_obligatory");
    exit();
}

$model = post_or_null("model");
$type = post_or_null("type");
$cpu = post_or_null("cpu");

$ram_mb = post_or_null("ram_mb");
$ram_mb = is_null($ram_mb) ? null : (int)$ram_mb;

$disk_gb = post_or_null("disk_gb");
$disk_gb = is_null($disk_gb) ? null : (int)$disk_gb;

$os = post_or_null("os");
$domain = post_or_null("domain");
$location = post_or_null("location");
$building = post_or_null("building");
$room = post_or_null("room");
$purchase_date = post_or_null("purchase_date");
$macaddr = post_or_null("macaddr");
$warranty_end = post_or_null("warranty_end");


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
