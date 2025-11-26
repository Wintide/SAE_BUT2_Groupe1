<?php

$login = $_POST['login'];
$password = $_POST['password'];

$host = 'localhost';
$user = "root";
$pass = "root";
$db = "vines";
$conn = mysqli_connect($host, $user, $pass);

if (!$conn) {
    echo "<script>console.log('Erreur connexion serveur');</script>";
} else{
    echo "<script>console.log('Connecté au serveur !');</script>";

    $base = mysqli_select_db($conn, $db);
    if (!$base) {
        echo "<script>console.log('Erreur connexion BD');</script>";
    } else {
        echo "<script>console.log('Connecté à la BD !');</script>";

        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);

        $valide = false;
        if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)){
                if($login == $row['login'] && md5($password) == $row['password']){
                    $valide = true;

                    break;
                }
            }
        }
    }
}

if($valide){
    session_start();

    $_SESSION['login'] = $login;

    header('Location: login_success_test.html');
} else{
    echo "Erreur : login ou mot de passe incorrect.";
}
?>