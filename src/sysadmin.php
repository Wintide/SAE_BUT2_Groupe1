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
    <link rel="stylesheet" href="css/style-adminweb.css">
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
    <section class="presentation">
        <h1>Bienvenue sur la page d'administration système</h1>
        <p>
            Cette section est dédiée à la gestion des aspects techniques et systèmes de la plateforme Vines.
            En tant qu'administrateur système, vous avez accès à des outils avancés pour assurer le bon fonctionnement
            de l'infrastructure informatique, gérer les serveurs, les réseaux et les configurations système.
        </p>
    </section>

    <section class="admin-tools">
        <h2>Outils d'administration système</h2>
        <ul>
            <li><a href="sysadmin_tools/server_management.php">Gestion des serveurs</a></li>
            <li><a href="sysadmin_tools/network_configuration.php">Configuration réseau</a></li>
            <li><a href="sysadmin_tools/system_monitoring.php">Surveillance du système</a></li>
            <li><a href="sysadmin_tools/user_management.php">Gestion des utilisateurs</a></li>
        </ul>
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