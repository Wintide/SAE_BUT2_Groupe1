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

$serial = post_or_null("serial");
$manufacturer = post_or_null("manufacturer");
$model = post_or_null("model");

$size_inch = post_or_null("size_inch");
$size_inch = is_null($size_inch) ? null : (int)$size_inch;
$resolution = post_or_null("resolution");
$connector = post_or_null("connector");
$attached_to = post_or_null("attached_to");


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
