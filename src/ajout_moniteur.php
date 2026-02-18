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
$serial = isset($_POST["serial"]) ? $_POST["serial"] : null;
$manufacturer = isset($_POST["manufacturer"]) ? $_POST["manufacturer"] : null;
$model = isset($_POST["model"]) ? $_POST["model"] : null;
$size_inch = isset($_POST["size_inch"]) ? $_POST["size_inch"] : null;
$resolution = isset($_POST["resolution"]) ? $_POST["resolution"] : null;
$connector = isset($_POST["connector"]) ? $_POST["connector"] : null;
$attached_to = isset($_POST["attached_to"]) ? $_POST["attached_to"] : null;

$stmt = mysqli_prepare($conn, "
    INSERT INTO monitors
    (serial, manufacturer, model, size_inch, resolution, connector, attached_to)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");

if ($stmt) {

    mysqli_stmt_bind_param(
        $stmt,
        "sssisss",
        $serial,
        $manufacturer,
        $model,
        $size_inch,
        $resolution,
        $connector,
        $attached_to
    );

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ajout_avec_formulaire.php?success=monitor");
        exit();
    } else {
        echo "Erreur exécution : " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);

} else {
    echo "Erreur préparation : " . mysqli_error($conn);
}

mysqli_close($conn);
