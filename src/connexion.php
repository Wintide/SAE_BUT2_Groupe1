<?php

$login = $_POST['login'];
$password = $_POST['password'];

$host = "localhost";
$user = "root";
$pass = "root";
$db = "vines";
$conn = mysqli_connect($host, $user, $pass);

$role = null;

if (!$conn) {
    echo "<script>console.log('Erreur connexion serveur');</script>";
} else {
    echo "<script>console.log('Connecté au serveur !');</script>";

    $base = mysqli_select_db($conn, $db);
    if (!$base) {
        echo "<script>console.log('Erreur connexion BD');</script>";
    } else {
        echo "<script>console.log('Connecté à la BD !');</script>";

        $sql = "select * from users";
        $result = mysqli_query($conn, $sql);

        $valid = false;

        if(mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

                $command = escapeshellcmd('python crypto/chacha20.py '.$password);
                $output = shell_exec($command);

                echo '<p> $output </p>';

                echo '<script>console.log("'.$output.'");</script>';

                if ($login == $row["login"] && $output == $row["password"]) {

                    $valid = true;
                    $role = $row["role"];
                    break;
                }

            }

        }

    }
}


if ($valid) {

    session_start();

    $_SESSION['role'] = $role;
    $_SESSION['login'] = $login;

    header("location: index.php");

}
else{
    header("location: login.php?err=1");
}

?>
