<?php session_start();?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Vines</title>
    <link rel="stylesheet" href="css/style-accueil.css">
</head>
<body>
<header>
    <div class="header-content">
        <img src="images/logovines.png" alt="Logo Vines" class="logo">
        <nav>
            <?php if (empty($_SESSION['role'])): ?>
                <a href="login.php" class="right-link">Login</a>
            <?php else: ?>
                <?php if (!empty($_SESSION['role'])): ?>
                    <?php if ($_SESSION['role'] === 'technicien'): ?>
                        <a href="inventaire.php" class="center-link">Inventaire</a>
                    <?php elseif ($_SESSION['role'] === 'administrateur_web'): ?>
                        <a href="webadmin.php" class="center-link">Admin web</a>
                        <a href="probas/charger_graphe.php" class="center-link">Statistique</a>
                    <?php elseif ($_SESSION['role'] === 'administrateur_systeme'): ?>
                        <a href="webadmin.php" class="center-link">Admin systeme</a>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="right-link">
                    <button id="userButton"><?= htmlspecialchars($_SESSION['login'], ENT_QUOTES, 'UTF-8') ?></button>
                    <div id="userOverlay" class="user-overlay" role="menu" aria-hidden="true">
                        <a href="logout.php" role="menuitem">Déconnexion</a>
                    </div>
                </div>
            <?php endif; ?>
        </nav>
    </div>
</header>

<main>
    <section class="presentation">
        <h1>Bienvenue sur Vines</h1>
        <p>
            Vines est une plateforme de gestion de parc informatique.
            Elle permet de suivre, ajouter, modifier ou supprimer des équipements informatiques
            tout en assurant une vision claire et structurée du matériel.
        </p>
    </section>

    <section class="video-section">
        <h2>Vidéo explicative</h2>
        <!--<video controls>
             <source src="media/video-presentation.mp4" type="video/mp4">
            Votre navigateur ne supporte pas la lecture de la vidéo.
        </video>-->

        <a href="https://www.skylinewebcams.com/fr/webcam/italia/lazio/roma/fontana-di-trevi.html" target="_blank">
            <img src="https://embed.skylinewebcams.com/img/286.jpg" alt="【LIVE】 Fontaine de Trevi - Rome | SkylineWebcams">
        </a>
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
<script src="script/deconnexion.js" defer></script>
</body>
</html>
