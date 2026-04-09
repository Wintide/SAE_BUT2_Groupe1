<?php

function ecrireLogJson($chemin, $input){

    $content = file.file_get_contents($chemin);
    $logs = json_decode($content, true);

    // Si aucun log
    if (!is_array($logs)) {
        $logs = [];
    }

    $logs[] = $input; // AJOUT

    file_put_contents($chemin, json_encode($logs, JSON_PRETTY_PRINT));
}
