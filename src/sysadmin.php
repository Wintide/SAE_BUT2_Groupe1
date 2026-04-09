<?php session_start();
if (empty($_SESSION['role']) ||$_SESSION['role'] !== "administrateur_systeme") {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Système - Vines</title>
    <link rel="stylesheet" href="css/style-sysadmin.css">
</head>
<body>
<header>
    <div class="header-content">
        <img src="images/logovines.png" alt="Logo Vines" class="logo">
        <nav>
            <a href="index.php" class="center-link">Accueil</a>
            <a href="probas/charger_graphe.php" class="center-link"> Statistique </a>
            <div id="userButton" class="right-link">
                <a href="logout.php" role="menuitem">Déconnexion</a>
            </div>
        </nav>
    </div>
</header>
<main>
    <section class="log-connexion-success">
        <h1>Connexion Réussit</h1>
        <?php
        $logFile = 'logs/connexions_reussies.json';
        if (file_exists($logFile)) {
            $log = file_get_contents($logFile);
            $logs = json_decode($log, true);
            if (is_array($logs) && count($logs) > 0) {
                echo '<ul>';
                foreach ($logs as $entry) {
                    echo '<li>' . htmlspecialchars($entry['date']) . ' - ' . htmlspecialchars($entry['login']) . ' (' . htmlspecialchars($entry['role']) . ')</li>';
                }
                echo '</ul>';
            } else{
                echo '<p>Aucun connexion réussit.</p>';
            }
        } else {
            echo '<p>Aucun log de connexion trouvé.</p>';
        }
        ?>
    </section>
    <section class="log-connexion-failure">
        <h1>Connexion Echouée</h1>
        <?php
            $logFile = 'logs/connexions_echouees.json';
            if (file_exists($logFile)) {
                $log = file_get_contents($logFile);
                $logs = json_decode($log, true);
                if (is_array($logs) && count($logs) > 0) {
                    echo '<ul>';
                    foreach ($logs as $entry) {
                        echo '<li>' . htmlspecialchars($entry['date']) . ' - ' . htmlspecialchars($entry['login']) . ' (' . htmlspecialchars($entry['role']) . ')</li>';
                    }
                    echo '</ul>';
                } else{
                    echo '<p>Aucun connexion échouée.</p>';
                }
            } else {
                echo '<p>Aucun log de connexion trouvé.</p>';
            }
        ?>
    </section>
    <section class="log-connexion-ssh">
        <h1>Connexion SSH</h1>
        <?php
        require_once 'log_utils.php';
        $command_reussi = escapeshellcmd('cat ../../../../log/auth.log | grep Accepted');
        $command_rate = escapeshellcmd('cat ../../../../log/auth.log | grep Failed');
        $output_reussi = shell_exec($command_reussi);
        $output_rate = shell_exec($command_rate);
        echo '<p>ALLO</p>';
        echo '<p>'.$output_reussi.'</p>';

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
        $logFile = 'logs/connexions_ssh.json';
        if (file_exists($logFile)) {
            $log = file_get_contents($logFile);
            $logs = json_decode($log, true);
            if (is_array($logs) && count($logs) > 0) {
                echo '<ul>';
                foreach ($logs as $entry) {
                    echo '<li>' . htmlspecialchars($entry['status']) . ' - ' . htmlspecialchars($entry['date']) . ' - ' . htmlspecialchars($entry['ip']) . '-' . htmlspecialchars($entry['port']) . '</li>';
                }
                echo '</ul>';
            } else{
                echo '<p>Aucun connexion ssh.</p>';
            }
        } else {
            echo '<p>Aucun log de connexion trouvé.</p>';
        }
        ?>
    </section>
</main>
<footer>
    <div class="footer-columns">
        <div>
            <h3>Assistance</h3>
            <ul>
                <li><a href="#">Problèmes de connexion</a></li>
            </ul>
        </div>
        <div>
            <h3>Informations</h3>
            <ul>
                <li><a href="#">Politique de confidentialité</a></li>
                <li><a href="#">Mentions légales</a></li>
            </ul>
        </div>
        <div>
            <h3>Nos Contacts</h3>
            <ul>
                <li><a href="https://github.com/Wintide/SAE.git" target="_blank">GitHub du projet</a></li>
                <li><a href="mailto:vines.contact.pro@gmail.com">vines.contact.pro@gmail.com</a></li>
            </ul>
        </div>
    </div>
    <p class="copyright">
        &copy; 2025 Vines - Tous droits réservés
    </p>
</footer>