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
    <title>Inventaire - Vines</title>
    <link rel="stylesheet" href="../css/style-adminweb.css">
</head>
<body>
<header>
    <div class="header-content">
        <img src="../images/logovines.png" alt="Logo Vines" class="logo">
        <nav>
            <a href="../index.php" class="center-link">Accueil</a>
            <a href="../webadmin.php" class="center-link">Admin web</a>

            <div class="right-link">
                <button id="userButton"><?= htmlspecialchars($_SESSION['login'], ENT_QUOTES, 'UTF-8') ?></button>
                <div id="userOverlay" class="user-overlay" role="menu" aria-hidden="true">
                    <a href="../logout.php">Déconnexion</a>
                </div>
            </div>
        </nav>
    </div>
</header>
<body>
    <h1> Statistique </h1>
    <?php
    $repertoire = "probas/python";
    echo "<script>console.log($repertoire)</script>";
    $liste_scripts = scandir($repertoire);
    echo "<script>console.log($liste_scripts)</script>";

    ?>
    <form name="form-stats" id="form-stats">
        <select name="stats" id="stats">
            <option value="NULL">-- Sélectionner --</option>
            <?php foreach ($liste_scripts as $script): ?>
                <option value="<?= $script ?>"><?= $script ?></option>
            <?php endforeach; ?>
        </select>
    </form>
<?php


$command = escapeshellcmd('../../sae/bin/python template_test.py');
$output = shell_exec($command);

?>
<img src = "../images/graphe.png" width="800">

</body>
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
<script src="../script/deconnexion.js" defer></script>
</html>
