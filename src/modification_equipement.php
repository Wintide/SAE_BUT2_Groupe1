<?php
error_reporting(E_ALL ^ E_NOTICE);
header("Content-type:application/json");
$host = "localhost";
$user = "root";
$pass = "root";
$db = "vines";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    echo "<script>console.log('erreur conn')</script>";
    echo json_encode(["status"=>"error","message"=>"Connexion échouée"]);
    exit;
}

if (isset($_POST['cpu'])) {
    $cpu = $_POST['cpu'];
    echo "Le CPU sélectionné est : " . $cpu;
}


$type = $_POST["type"];
$serial = $_POST["serial"];

if ($type == "uc") {
    echo "<script>console.log('dans uc')</script>";
    $name = $_POST["name"];
    $cpu = $_POST["cpu"];
    $ram_mb = $_POST["ram_mb"];
    $disk_gb = $_POST["disk_gb"];
    $os = $_POST["os"];
    $domain = $_POST["domain"];
    $location = $_POST["location"];
    $building = $_POST["building"];
    $room = $_POST["room"];
    $warranty = $_POST["warranty"];
    echo "<script>console.log('$warranty')</script>";

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
                warranty_end = to_date(?, 'yyyy-mm-dd')
            WHERE serial = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssssssss", $name, $cpu, $ram_mb, $disk_gb, $os, $domain, $location, $building, $room, $warranty, $serial);
}

else if ($type == "monitor") {
    echo "<script>console.log('dans monitor')</script>";
    $resolution = $_POST["resolution"];
    $connector = $_POST["connector"];
    $attachedto = $_POST["attached_to"];

    $sql = "UPDATE monitors SET 
                resolution = ?, 
                connector = ?,
                attached_to = ?
            WHERE serial = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $resolution, $connector, $attachedto, $serial);
}

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(["status"=>"success"]);
} else {
    echo json_encode(["status"=>"error","message"=>mysqli_error($conn)]);
}

mysqli_close($conn);
?>
