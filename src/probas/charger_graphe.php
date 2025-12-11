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

<?php
// Connexion à la BD
$host = "localhost";
$user = "root";
$pass = "root";
$db = "vines";
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    echo "<script>console.log('Erreur connexion serveur');</script>";
} else {
    echo "<script>console.log('Connecté au serveur !');</script>";
}

// On recupère les colonnes de devices pour le menu déroulant de sélection des attributs
$columns_query = mysqli_query($conn, "SHOW COLUMNS FROM devices");
$colonnes = [];
while ($row = mysqli_fetch_assoc($columns_query)) {
    $field = $row['Field'];
    // Il faut ignorer ces attributs car leur répartition n'est pas intéressante
    if (!in_array($field, ['name', 'serial', 'macaddr','purchase_date','warranty_end','room'])) {
        $colonnes[] = $field;
    }
}
?>
<body>
    <h1> Statistique </h1>
    <?php
    $repertoire = "./python";
    $liste_scripts = scandir($repertoire);
    $liste_scripts = array_diff($liste_scripts, array('.', '..'));

    ?>
    <form name="form-stats" id="form-stats" method="post" action="">
    <select name="stats" id="stats">
        <option value="">-- Sélectionner le script --</option>
        <?php foreach ($liste_scripts as $script): ?>
            <option value="<?= $script ?>"><?= $script ?></option>
        <?php endforeach; ?>
    </select>

    <select name="attribut" id="attribut">
        <option value="">-- Sélectionner un attribut (si besoin) --</option>
        <?php foreach ($colonnes as $col): ?>
            <option value="<?= $col ?>"><?= $col ?></option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Valider">
</form>

<?php
if (isset($_POST['stats']) && !empty($_POST['stats'])) {
    $select = $_POST['stats'];

    if (!empty($_POST['attribut'])) { // cas où une option du menu déroulant des attributs a été selectionnée
        $attr = $_POST['attribut'];
        $command = "../../sae/bin/python python/$select $attr";
    } else {
        $command = "../../sae/bin/python python/$select";
    }

    $output = shell_exec($command);
}
?>

<img src = "../images/graphe.png" alt="graphe" width="800" id="graphe">

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
