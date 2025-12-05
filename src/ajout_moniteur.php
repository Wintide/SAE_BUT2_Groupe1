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

$serial = $_POST["serial"];
$manufacturer = $_POST["manufacturer"];
$model = $_POST["model"];
$size_inch = $_POST["size_inch"];
$resolution = $_POST["resolution"];
$connector = $_POST["connector"];
$attached_to = $_POST["attached_to"];

$insert_query = "INSERT INTO monitors (serial, manufacturer, model, size_inch, resolution, connector, attached_to) VALUES ('$serial', '$manufacturer', '$model', '$size_inch', '$resolution', '$connector', '$attached_to')";

$result = mysqli_query($conn, $insert_query);

if ($result) {
    //echo "<script>alert('Moniteur de numéro de série " . $serial . " ajouté avec succès');</script>";
    echo "<script>console.log('Moniteur de numéro de série " . $serial . " ajouté avec succès')</script>";
    header("Location: ajout_avec_formulaire.php");
} else {
    echo "<script>console.log('Erreur !')</script>";

