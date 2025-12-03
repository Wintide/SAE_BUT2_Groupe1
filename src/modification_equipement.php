<?php
header("Content-Type: application/json");
$host = "localhost";
$user = "root";
$pass = "root";
$db = "vines";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    echo json_encode(["status"=>"error","message"=>"Connexion échouée"]);
    exit;
}

$type = $_POST["type"];
$serial = $_POST["serial"];

if ($type == "uc") {
    $name = $_POST["name"];
    $local = $_POST["local"];
    $year = $_POST["year"];

    $sql = "UPDATE devices SET 
                name = ?, 
                room = ?, 
                purchase_date = ?
            WHERE serial = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $local, $year, $serial);
}

else if ($type == "monitor") {
    $model = $_POST["model"];
    $size = $_POST["size"];

    $sql = "UPDATE monitors SET 
                model = ?, 
                size_inch = ?
            WHERE serial = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sis", $model, $size, $serial);
}

if (mysqli_stmt_execute($stmt)) {
    echo json_encode(["status"=>"success"]);
} else {
    echo json_encode(["status"=>"error","message"=>mysqli_error($conn)]);
}

mysqli_close($conn);
?>
