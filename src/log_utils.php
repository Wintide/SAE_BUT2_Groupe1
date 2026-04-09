<?php

function ecrireLogJson($chemin, $input){

if (file_exists($chemin)) {
    $content = file_get_contents($chemin);
    $logs = json_decode($content, true);
} else {
    $logs = [];
}

if (!is_array($logs)) {
    $logs = [];
}

$logs[] = $input;

file_put_contents($chemin, json_encode($logs, JSON_PRETTY_PRINT));
}
