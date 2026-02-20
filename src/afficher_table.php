<?php

$host = "localhost";
$user = "root";
$pass = "root";
$db = "vines";

$conn = mysqli_connect($host, $user, $pass, $db);

if(!$conn){
    die("Erreur connexion");
}

$table = $_GET['table'];

$allowed = [
    "devices_building","devices_cpu","devices_disk_gb","devices_domain",
    "devices_location","devices_manufacturer","devices_model","devices_os",
    "devices_ram_mb","devices_room","devices_type",
    "monitors_connector","monitors_manufacturer","monitors_model",
    "monitors_resolution","monitors_size_inch"
];

if(!in_array($table, $allowed)){
    die("Table non autorisée");
}

$result = mysqli_query($conn, "SELECT * FROM $table");

echo "<table style='border: 1px solid black; border-collapse: collapse;'>";
echo "<tr>";

$fields = mysqli_fetch_fields($result);
foreach($fields as $field){
    echo "<th>{$field->name}</th>";
}
echo "</tr>";

while($row = mysqli_fetch_assoc($result)){
    echo "<tr>";
    foreach($row as $cell){
        echo "<td>$cell</td>";
    }
    echo "</tr>";
}

echo "</table>";
?>

