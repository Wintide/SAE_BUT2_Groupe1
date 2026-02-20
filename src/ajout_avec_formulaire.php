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
// Moniteurs
$monitor_connector = mysqli_query($conn, "SELECT * FROM monitors_connector");
$monitor_manufacturer = mysqli_query($conn, "SELECT * FROM monitors_manufacturer");
$monitor_model = mysqli_query($conn, "SELECT * FROM monitors_model");
$monitor_resolution = mysqli_query($conn, "SELECT * FROM monitors_resolution");
$monitor_size_inch = mysqli_query($conn, "SELECT * FROM monitors_size_inch");

$monitor_attached_to = mysqli_query($conn, "SELECT name FROM devices");
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
            <a href="probas/charger_graphe.php" class="center-link">Statistique</a>
            <div id="userButton" class="right-link">
                <a href="logout.php" role="menuitem">Déconnexion</a>
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
                <li>
                    <button class="sidebar-btn" id="revenir">Retourner à l'inventaire</button>
                    <script>
                        var btn = document.getElementById("revenir");
                        btn.addEventListener('click', function() {
                            document.location.href = "inventaire.php";
                        });
                    </script>
                </li>
            </ul>
        </aside>

        <div class="admin-content">

            <!-- FORMULAIRE UNITE CENTRALE -->
            <section id="form-uc" class="content-section active">
                <div class="form-container">
                    <h2>Créer une unité centrale</h2>
                    <form action="ajout_uc.php" method="post">

                        <?php
                        if (isset($_GET['error_obligatory'])) {
                            echo "<p class='error-message'>Veuillez remplir tous les champs obligatoires.</p>";
                        } elseif (isset($_GET['success']) && $_GET['success'] === "uc") {
                            echo "<p class='success-message'>Unité centrale créée avec succès !</p>";
                        }?>

                        <label for="uc-name">Nom :</label>
                        <input type="text" name="name" id="uc-name" autofocus required>


                        <label for="uc-SN">Numéro de série :</label>
                        <input type="text" name="serial" id="uc-SN" required>

                        <label for="uc-construct">Constructeur :</label>
                        <select name="manufacturer" class="styled-select" id="uc-construct" required>
                            <option value="">-- Sélectionner --</option>
                            <?php foreach ($devices_manufacturer as $el): ?>
                                <option value="<?= $el['manufacturer'] ?>"><?= $el['manufacturer'] ?></option>
                            <?php endforeach; ?>
                        </select>

                        <div class="accordion-header" id="toggle-uc">
                            <span>Options avancées</span>
                            <span id="arrow-uc">▼</span>
                        </div>

                        <div class="accordion-body" id="advanced-uc">

                            <label for="uc-bat">Bâtiment :</label>
                            <select name="building" class="styled-select" id="uc-bat">
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($devices_building as $el): ?>
                                    <option value="<?= $el['building'] ?>"><?= $el['building'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="uc-process">Processeur :</label>
                            <select name="cpu" class="styled-select" id="uc-process">
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($devices_cpu as $el): ?>
                                    <option value="<?= $el['cpu'] ?>"><?= $el['cpu'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="uc-EspDisque">Espcace disque (GB) :</label>
                            <select name="disk_gb" class="styled-select" id="uc-EspDisque">
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($devices_disk_gb as $el): ?>
                                    <option value="<?= $el['disk_gb'] ?>"><?= $el['disk_gb'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="uc-DomainName">Nom de domaine :</label>
                            <select name="domain" class="styled-select" id="uc-DomainName">
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($devices_domain as $el): ?>
                                    <option value="<?= $el['domain'] ?>"><?= $el['domain'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="uc-loc">Localisation :</label>
                            <select name="location" class="styled-select" id="uc-loc">
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($devices_location as $el): ?>
                                    <option value="<?= $el['location'] ?>"><?= $el['location'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="uc-modele">Modèle :</label>
                            <select name="model" class="styled-select" id="uc-modele">
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($devices_model as $el): ?>
                                    <option value="<?= $el['model'] ?>"><?= $el['model'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="uc-OS">Système d'exploitation :</label>
                            <select name="os" class="styled-select" id="uc-OS">
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($devices_os as $el): ?>
                                    <option value="<?= $el['os'] ?>"><?= $el['os'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="uc-RAM">Capacité RAM (MB) :</label>
                            <select name="ram_mb" class="styled-select" id="uc-RAM">
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($devices_ram_mb as $el): ?>
                                    <option value="<?= $el['ram_mb'] ?>"><?= $el['ram_mb'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="uc-Piece">Pièce :</label>
                            <select name="room" class="styled-select" id="uc-Piece">
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($devices_room as $el): ?>
                                    <option value="<?= $el['room'] ?>"><?= $el['room'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="uc-type">Type :</label>
                            <select name="type" class="styled-select" id="uc-type">
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($devices_type as $el): ?>
                                    <option value="<?= $el['type'] ?>"><?= $el['type'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="uc-mac">Adresse MAC :</label>
                            <input type="text" name="macaddr" id="uc-mac">

                            <label for="uc-date_achat">Date d'achat :</label>
                            <input type="date" name="purchase_date" id="uc-date_achat">

                            <label for="uc-date_garantie">Date de fin de garantie :</label>
                            <input type="date" name="warranty_end" id="uc-date_garantie">
                        </div>

                        <button id="form-button" type="submit">Créer l’unité centrale</button>
                    </form>
                </div>
            </section>

            <!-- FORMULAIRE MONITEUR -->
            <section id="form-moniteur" class="content-section">
                <div class="form-container">
                    <h2>Créer un moniteur</h2>
                    <form action="ajout_moniteur.php" method="post">

                        <?php
                        if (isset($_GET['error_obligatory'])) {
                            echo "<p class='error-message'>Veuillez remplir tous les champs obligatoires.</p>";
                        } elseif (isset($_GET['success']) && $_GET['success'] === "uc") {
                            echo "<p class='success-message'>Moniteur créée avec succès !</p>";
                        }?>

                        <label for="m-NS">Numéro de série :</label>
                        <input type="text" name="serial" id="m-NSr" required>

                        <div class="accordion-header" id="toggle-monitor">
                            <span>Options avancées</span>
                            <span id="arrow-monitor">▼</span>
                        </div>

                        <div class="accordion-body" id="advanced-monitor">

                            <label for="m-Connect">Connecteur :</label>
                            <select name="connector" class="styled-select" id="m-Connect">
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($monitor_connector as $el): ?>
                                    <option value="<?= $el['connector'] ?>"><?= $el['connector'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="m-Construct">Constructeur</label>
                            <select name="manufacturer" class="styled-select" id="m-Construct">
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($monitor_manufacturer as $el): ?>
                                    <option value="<?= $el['manufacturer'] ?>"><?= $el['manufacturer'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="m-model">Modèle :</label>
                            <select name="model" class="styled-select" id="m-model">
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($monitor_model as $el): ?>
                                    <option value="<?= $el['model'] ?>"><?= $el['model'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="m-resolu">Résolution :</label>
                            <select name="resolution" class="styled-select" id="m-resolu">
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($monitor_resolution as $el): ?>
                                    <option value="<?= $el['resolution'] ?>"><?= $el['resolution'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="m-size">Taille (en inch) :</label>
                            <select name="size_inch" class="styled-select" id="m-size">
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($monitor_size_inch as $el): ?>
                                    <option value="<?= $el['size_inch'] ?>"><?= $el['size_inch'] ?></option>
                                <?php endforeach; ?>
                            </select>

                             <label for="m-attached">Attaché à :</label>
                            <select name="attached_to" class="styled-select" id="m-attached">
                                <option value="">-- Sélectionner --</option>
                                <?php foreach ($monitor_attached_to as $el): ?>
                                    <option value="<?= $el['name'] ?>"><?= $el['name'] ?></option>
                                <?php endforeach; ?>
                            </select>

                        </div>
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
<script src="script/admin-tabs.js" defer></script>
</body>
</html>




