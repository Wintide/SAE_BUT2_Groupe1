<?php

session_start();
if (empty($_SESSION['role']) || $_SESSION['role'] !== "technicien") {
    header("Location: index.php");
    exit();
}

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

// Unités centrales
$devices_building = mysqli_query($conn, "SELECT * FROM devices_building");
echo "<script>console.log('Terminé 1 !');</script>";
$devices_cpu = mysqli_query($conn, "SELECT * FROM devices_cpu");
$devices_disk_gb = mysqli_query($conn, "SELECT * FROM devices_disk_gb");
$devices_domain = mysqli_query($conn, "SELECT * FROM devices_domain");
$devices_location = mysqli_query($conn, "SELECT * FROM devices_location");
$devices_manufacturer = mysqli_query($conn, "SELECT * FROM devices_manufacturer");
$devices_model = mysqli_query($conn, "SELECT * FROM devices_model");
$devices_os = mysqli_query($conn, "SELECT * FROM devices_os");
$devices_ram_mb = mysqli_query($conn, "SELECT * FROM devices_ram_mb");
$devices_room = mysqli_query($conn, "SELECT * FROM devices_room");
$devices_type = mysqli_query($conn, "SELECT * FROM devices_type");
echo "<script>console.log('Terminé devices!');</script>";
// Moniteurs
$monitor_connector = mysqli_query($conn, "SELECT * FROM monitors_connector");
$monitor_manufacturer = mysqli_query($conn, "SELECT * FROM monitors_manufacturer");
$monitor_model = mysqli_query($conn, "SELECT * FROM monitors_model");
$monitor_resolution = mysqli_query($conn, "SELECT * FROM monitors_resolution");
$monitor_size_inch = mysqli_query($conn, "SELECT * FROM monitors_size_inch");

echo "<script>console.log('Terminé !');</script>";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout matériel - Vines</title>
    <link rel="stylesheet" href="css/style-ajout-formulaire.css">
</head>
<body>
<header>
    <div class="header-content">
        <img src="images/logovines.png" alt="Logo Vines" class="logo">
        <nav>
            <a href="index.php" class="center-link">Accueil</a>
            <div class="right-link">
                <button id="userButton"><?= htmlspecialchars($_SESSION['login'], ENT_QUOTES, 'UTF-8') ?></button>
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
                <li>
                    <button class="sidebar-btn" data-target="form-uc">Ajouter une unité centrale</button>
                </li>
                <li>
                    <button class="sidebar-btn" data-target="form-moniteur">Ajouter un moniteur</button>
                </li>
            </ul>
        </aside>

        <div class="admin-content">

            <!-- FORMULAIRE UNITE CENTRALE -->
            <section id="form-uc" class="content-section active">
                <div class="form-container">
                    <h2>Créer une unité centrale</h2>
                    <form action="create_uc.php" method="post">

                        <label>Bâtiment :</label>
                        <select name="building" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($devices_building as $el): ?>
                                <option value="<?= $el['building'] ?>"></option>
                            <?php endforeach; ?>
                        </select>

                        <label>Processeur :</label>
                        <select name="cpu" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($devices_cpu as $el): ?>
                                <option value="<?= $el['cpu'] ?>"><?= $el['cpu'] ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label>Espcace disque (GB) :</label>
                        <select name="disk_gb" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($devices_disk_gb as $el): ?>
                                <option value="<?= $el['disk_gb'] ?>"></option>
                            <?php endforeach; ?>
                        </select>

                        <label>Nom de domaine :</label>
                        <select name="domain" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($devices_domain as $el): ?>
                                <option value="<?= $el['domain'] ?>"></option>
                            <?php endforeach; ?>
                        </select>

                        <label>Localisation :</label>
                        <select name="location" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($devices_location as $el): ?>
                                <option value="<?= $el['location'] ?>"></option>
                            <?php endforeach; ?>
                        </select>

                        <label>Constructeur :</label>
                        <select name="manufacturer" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($devices_manufacturer as $el): ?>
                                <option value="<?= $el['manufacturer'] ?>"></option>
                            <?php endforeach; ?>
                        </select>

                        <label>Modèle :</label>
                        <select name="model" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($devices_model as $el): ?>
                                <option value="<?= $el['model'] ?>"></option>
                            <?php endforeach; ?>
                        </select>

                        <label>Système d'exploitation :</label>
                        <select name="os" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($devices_os as $el): ?>
                                <option value="<?= $el['os'] ?>"></option>
                            <?php endforeach; ?>
                        </select>

                        <label>Capacité RAM (MB) :</label>
                        <select name="ram_mb" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($devices_ram_mb as $el): ?>
                                <option value="<?= $el['ram_mb'] ?>"></option>
                            <?php endforeach; ?>
                        </select>

                        <label>Pièce :</label>
                        <select name="room" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($devices_room as $el): ?>
                                <option value="<?= $el['room'] ?>"></option>
                            <?php endforeach; ?>
                        </select>

                        <label>Type :</label>
                        <select name="type" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($devices_type as $el): ?>
                                <option value="<?= $el['type'] ?>"></option>
                            <?php endforeach; ?>
                        </select>

                        <button id="form-button" type="submit">Créer l’unité centrale</button>
                    </form>
                </div>
            </section>

            <!-- FORMULAIRE MONITEUR -->
            <section id="form-moniteur" class="content-section">
                <div class="form-container">
                    <h2>Créer un moniteur</h2>
                    <form action="create_moniteur.php" method="post">

                        <label>Connecteur :</label>
                        <select name="connector" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($monitor_connector as $el): ?>
                                <option value="<?= $el['connector'] ?>"></option>
                            <?php endforeach; ?>
                        </select>

                        <label>Constructeur</label>
                        <select name="manufacturer" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($monitor_manufacturer as $el): ?>
                                <option value="<?= $el['manufacturer'] ?>"></option>
                            <?php endforeach; ?>
                        </select>

                        <label>Modèle :</label>
                        <select name="model" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($monitor_model as $el): ?>
                                <option value="<?= $el['model'] ?>"></option>
                            <?php endforeach; ?>
                        </select>

                        <label>Résolution :</label>
                        <select name="resolution" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($monitor_resolution as $el): ?>
                                <option value="<?= $el['resolution'] ?>"></option>
                            <?php endforeach; ?>
                        </select>

                        <label>Taille (en inch) :</label>
                        <select name="size_inch" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($monitor_size_inch as $el): ?>
                                <option value="<?= $el['size_inch'] ?>"></option>
                            <?php endforeach; ?>
                        </select>

                        <button id="form-button" type="submit">Créer le moniteur</button>
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
</body>
</html>
