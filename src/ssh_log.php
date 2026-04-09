<?php
require_once 'log_utils.php';
$command_reussi = escapeshellcmd('cat ../../../../log/auth.log | grep Accepted');
$command_rate = escapeshellcmd('cat ../../../../log/auth.log | grep Failed');
$output_reussi = trim(shell_exec($command_reussi));
$output_rate = trim(shell_exec($command_rate));

$output_reussi = str_replace(array("\r", "\n"), '', $output_reussi);
$output_rate = str_replace(array("\r", "\n"), '', $output_rate);

foreach ($output_reussi as $ligne) {
    $nouveau = [
        "status" => "réussi",
        "date" => $ligne[0],
        "ip" => $ligne[8],
        "port" => $ligne[10]
    ];
    ecrireLogJson('logs/connexion_ssh.json',$nouveau);
}

foreach ($output_rate as $ligne) {
    $nouveau = [
        "status" => "échec",
        "date" => $ligne[0],
        "ip" => $ligne[8],
        "port" => $ligne[10]
    ];
    ecrireLogJson('logs/connexion_ssh.json',$nouveau);
}


