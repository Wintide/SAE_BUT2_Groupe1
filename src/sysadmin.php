
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
        <h1>Connexions réussies</h1>
        <?php
        $logFile = 'logs/connexions_reussies.json';
        $limite = 6;
        $actual = 1;
        if (file_exists($logFile)) {
            $log = file_get_contents($logFile);
            $logs = json_decode($log, true);
            if (is_array($logs) && count($logs) > 0) {
                usort($logs, function($a, $b) {
                    return strtotime($b['date']) - strtotime($a['date']);
                });
                echo '<ul>';
                foreach ($logs as $entry) {
                    if ($actual <= $limite) {
                        $dateObj = new DateTime($entry['date']);
                        $date = $dateObj->format('l d F Y H:i:s');
                        $jours = [
                                'Monday' => 'Lundi', 'Tuesday' => 'Mardi', 'Wednesday' => 'Mercredi',
                                'Thursday' => 'Jeudi', 'Friday' => 'Vendredi', 'Saturday' => 'Samedi', 'Sunday' => 'Dimanche'
                        ];
                        $mois = [
                                'January' => 'janvier', 'February' => 'février', 'March' => 'mars',
                                'April' => 'avril', 'May' => 'mai', 'June' => 'juin',
                                'July' => 'juillet', 'August' => 'août', 'September' => 'septembre',
                                'October' => 'octobre', 'November' => 'novembre', 'December' => 'décembre'
                        ];
                        $date = strtr($date, $jours);
                        $date = strtr($date, $mois);

                        echo '<li>'
                                . htmlspecialchars($date)
                                . ' - ' . htmlspecialchars($entry['login'])
                                . ' (' . htmlspecialchars($entry['role']) . ')'
                                . '</li>';
                        $actual++;
                    }
                }
                echo '</ul>';
            } else{
                echo '<p>Aucune connexions réussies.</p>';
            }
        } else {
            echo '<p>Aucun logs de connexion trouvés.</p>';
        }
        ?>
    </section>
    <section class="log-connexion-failure">
        <h1>Connexions échouées</h1>
        <?php
            $logFile = 'logs/connexions_echouees.json';
            if (file_exists($logFile)) {
                $log = file_get_contents($logFile);
                $logs = json_decode($log, true);
                if (is_array($logs) && count($logs) > 0) {
                    usort($logs, function($a, $b) {
                        return strtotime($b['date']) - strtotime($a['date']);
                    });
                    echo '<ul>';
                    foreach ($logs as $entry) {
                        if ($actual <= $limite) {
                            $dateObj = new DateTime($entry['date']);
                            $date = $dateObj->format('l d F Y H:i:s');
                            $jours = [
                                    'Monday' => 'Lundi', 'Tuesday' => 'Mardi', 'Wednesday' => 'Mercredi',
                                    'Thursday' => 'Jeudi', 'Friday' => 'Vendredi', 'Saturday' => 'Samedi', 'Sunday' => 'Dimanche'
                            ];
                            $mois = [
                                    'January' => 'janvier', 'February' => 'février', 'March' => 'mars',
                                    'April' => 'avril', 'May' => 'mai', 'June' => 'juin',
                                    'July' => 'juillet', 'August' => 'août', 'September' => 'septembre',
                                    'October' => 'octobre', 'November' => 'novembre', 'December' => 'décembre'
                            ];
                            $date = strtr($date, $jours);
                            $date = strtr($date, $mois);

                            echo '<li>'
                                    . htmlspecialchars($date)
                                    . ' - ' . htmlspecialchars($entry['login'])
                                    . '</li>';
                        }
                    }
                    echo '</ul>';
                } else{
                    echo '<p>Aucune connexion échouée.</p>';
                }
            } else {
                echo '<p>Aucune log de connexion trouvé.</p>';
            }
        ?>
    </section>
    <section class="log-connexion-ssh">
        <h1>Connexions SSH</h1>
        <?php
        require_once 'log_utils.php';

        $command_reussi = escapeshellcmd('cat /var/log/auth.log');
        $command_rate = escapeshellcmd('cat /var/log/auth.log');
        $output_reussi = shell_exec($command_reussi.' | grep Accepted');
        $output_rate = shell_exec($command_rate.' | grep Failed');

        $reussi = explode("\n",$output_reussi);
        $echec = explode("\n",$output_rate);
        echo '<p>'.$reussi.'</p>';
        foreach ($reussi as $ligne) {
            $nouveau = [
                    "status" => "réussi",
                    "date" => $ligne[0],
                    "ip" => $ligne[8],
                    "port" => $ligne[10]
            ];
            ecrireLogJson('logs/connexion_ssh.json',$nouveau);
        }

        foreach ($echec as $ligne) {
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
                echo '<p>Aucune connexion ssh.</p>';
            }
        } else {
            echo '<p>Aucune log de connexion trouvé.</p>';
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
