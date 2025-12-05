<?php

// Connexion à la BD
$host = "localhost";
$user = "root";
$pass = "root";
$db = "vines";
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    echo "<script>console.log('Erreur connexion serveur');</script>";
} else {
    echo "<script>console.log('Connecté au serveur !');</script>";
}

$name = $_POST["name"];
$serial = $_POST["serial"];
$manufacturer = $_POST["manufacturer"];
$model = $_POST["model"];
$type = $_POST["type"];
$cpu = $_POST["cpu"];
$ram_mb = $_POST["ram_mb"];
$disk_gb = $_POST["disk_gb"];
$os = $_POST["os"];
$domain = $_POST["domain"];
$location = $_POST["location"];
$building = $_POST["building"];
$room = $_POST["room"];
$purchase_date = $_POST["purchase_date"];
$macaddr = $_POST["macaddr"];
$warranty_end = $_POST["warranty_end"];

$insert_query = "INSERT INTO devices (name, serial, manufacturer, model, type, cpu, ram_mb, disk_gb, os, domain, location, building, room, purchase_date, macaddr, warranty_end)
          VALUES ('$name', '$serial', '$manufacturer', '$model', '$type', '$cpu', '$ram_mb', '$disk_gb', '$os', '$domain', '$location', '$building', '$room', '$purchase_date', '$macaddr', '$warranty_end')";

$result = mysqli_query($conn, $insert_query);

if ($result) {
    echo "<script>alert('Unité centrale '. $name .' ajoutée avec succès');</script>";
    header("Location: ajout_avec_formulaire.php");
} else {
    echo "Erreur : " . mysqli_error($conn);
}
