<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valeur = isset($_POST["valeur"]) ? $_POST["valeur"] : null;

    if ($valeur === null) {
        exit();
    }
    else{
        $command = escapeshellcmd('../../sae/bin/python '.$valeur );
        $output = shell_exec($command);
    }
}


?>