<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Vines</title>
    <link rel="stylesheet" href="css/style-login.css">
</head>
<body>
<header>
    <div class="header-content">
        <img src="images/logovines.png" alt="Logo Vines" class="logo">
        <nav>
            <a href="index.php">Accueil</a>
        </nav>
    </div>
</header>

<main>
    <div class="form-container">
        <?php
            echo "<div class='error'>";
            if(isset($_GET["err"]) && $_GET["err"]==1){
                echo '<p style="color=red">Login ou mot de passe incorrect.</p>';
            }
            echo "</div>";
        ?>
        <h2>Connexion</h2>
        <form method="post" action="connexion.php">
            <label for="login">Login :</label>
            <input type="text" id="login" name="login" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Connexion</button>
        </form>
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
            <h4>Nos Contactes</h4>
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
</body>
</html>
