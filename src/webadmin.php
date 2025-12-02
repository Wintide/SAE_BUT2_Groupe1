<?php session_start();
if (empty($_SESSION['role']) ||$_SESSION['role'] !== "administrateur_web") {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Web - Vines</title>
    <link rel="stylesheet" href="css/style-adminweb.css">
</head>
<body>
<header>
    <div class="header-content">
        <img src="images/logovines.png" alt="Logo Vines" class="logo">
        <nav>
            <a href="index.php" class="center-link">Acceuil</a>
            <div class="right-link">
                <button id="userButton"><?= htmlspecialchars($_SESSION['role'], ENT_QUOTES, 'UTF-8') ?></button>
                <div id="userOverlay" class="user-overlay" role="menu" aria-hidden="true">
                    <a href="logout.php">Déconnexion</a>
                </div>
            </div>
        </nav>
    </div>
</header>

<main>
    <div class="admin-wrapper">

        <aside class="sidebar">
            <ul>
                <li><button class="sidebar-btn" data-target="form-technicien">Ajouter un technicien</button></li>
                <li><button class="sidebar-btn" data-target="form-os">Ajouter un OS</button></li>
                <li><button class="sidebar-btn" data-target="form-constructeur">Ajouter un constructeur</button></li>
            </ul>
        </aside>

        <div class="admin-content">

            <section id="form-technicien" class="content-section active">
                <div class="form-container">
                    <h2>Créer un technicien</h2>

                    <form action="create_technician.php" method="post">
                        <label>Login du technicien :</label>
                        <input type="text" name="login" required>

                        <label>Mot de passe :</label>
                        <input type="password" name="password" required>

                        <button id="form-button" type="submit">Créer le technicien</button>
                    </form>
                </div>
            </section>

            <section id="form-os" class="content-section">
                <div class="form-container">
                    <h2>Ajouter un système d’exploitation</h2>

                    <form action="create_os.php" method="post">
                        <label>Nom de l’OS :</label>
                        <input type="text" name="osname" required>

                        <button id="form-button" type="submit">Ajouter</button>
                    </form>
                </div>
            </section>

            <section id="form-constructeur" class="content-section">
                <div class="form-container">
                    <h2>Ajouter un constructeur</h2>

                    <form action="create_constructeur.php" method="post">
                        <label>Nom du constructeur :</label>
                        <input type="text" name="brand" required>

                        <button id="form-button" type="submit">Ajouter</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</main>



<footer>
    <div class="footer-columns">
        <div>
            <h4>Assistance</h4>
            <ul>
                <li><a href="#">Problèmes de connexion</a></li>
            </ul>
        </div>
        <div>
            <h4>Informations</h4>
            <ul>
                <li><a href="#">Politique de confidentialité</a></li>
                <li><a href="#">Mentions légales</a></li>
            </ul>
        </div>
        <div>
            <h4>Nos Contacts</h4>
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
<script src="script/admin-tabs.js" defer></script>
</body>
</html>