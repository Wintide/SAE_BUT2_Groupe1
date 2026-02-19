<?php session_start();
if (empty($_SESSION['role']) ||$_SESSION['role'] !== "technicien") {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inventaire - Vines</title>
    <link rel="stylesheet" href="css/style-tech.css">
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
    <div class="main-filtrage">
        <h1>Filtrer : </h1>
        <div class="filters">

            <form action="" method="post">
                <label for="filter-type">Type :</label>
                <select id="filter-type" name="filter-type">
                    <option value="all">Tous</option>
                    <option value="devices">Unités centrales</option>
                    <option value="monitors">Moniteurs</option>
                </select>

                <label for="filter-local">Localisation :</label>
                <select id="filter-local" name="filter-local">
                    <option value="all"> Tous </option>
                    <?php
                    include 'charge_inventaire.php';
                    $host = "localhost";
                    $user = "root";
                    $pass = "root";
                    $db = "vines";
                    $conn = mysqli_connect($host, $user, $pass);

                    if (!$conn) {
                        echo "<script>console.log('Erreur connexion serveur');</script>";
                    } else {
                        echo "<script>console.log('conn');</script>";
                        $base = mysqli_select_db($conn, $db);
                        if (!$base) {
                            echo "<script>console.log('Erreur connexion BD');</script>";
                        } else {
                            echo "<script>console.log('base');</script>";
                            $sql_uc = "select * from devices_location ";
                            $resultat_uc = mysqli_query($conn, $sql_uc);
                            if (mysqli_num_rows($resultat_uc) > 0) {
                                echo "<script>console.log('while');</script>";
                                while ($row = mysqli_fetch_assoc($resultat_uc)) {
                                    echo "<option value=".$row['location'].">".$row['location']."</option>";
                                }

                            }
                        }

                    }
                    ?>
                </select>

                <label for="filter-date">Année d’achat :</label>
                <select id="filter-date" name="filter-date">
                    <option value="all">Toutes</option>
                    <option value="2025">2025</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                </select>

                <label for="filter-search">Recherche :</label>
                <input type="text" id="filter-search" placeholder="Rechercher un modèle, ID...">

                <button type="submit">Filtrer</button>
            </form>

        </div>
        <form action="ajout_avec_formulaire.php" method="post">
            <button class="btn-add">Ajouter une machine</button>
        </form>
    </div>

    <div class="main-inventory">
        <h2>Inventaire Actif</h2>
        <div class="inventory-grid">

            <?php
            if (!$conn) {
                echo "<script>console.log('Erreur connexion serveur');</script>";
            }
            else {
                echo "<script>console.log('Connecté au serveur !');</script>";

                $base = mysqli_select_db($conn, $db);
                if (!$base) {
                    echo "<script>console.log('Erreur connexion BD');</script>";
                } else {
                    echo "<script>console.log('Connecté à la BD !');</script>";
                        if(empty($_POST['filter-type']) && empty($_POST['filter-local']) && empty($_POST['filter-date'])) {
                            charge_all($conn);
                        } else {
                            $req = "select * from ";
                            $first_filter = true;
                            if(in_array($_POST['filter-type'], ['devices', 'monitors']) && $_POST['filter-local'] == "all" && $_POST['filter-date'] == "all"){
                                $req = $req . $_POST['filter-type'];
                            } else if($_POST['filter-local'] != "all" || $_POST['filter-date'] != "all"){
                                $req = $req . " devices";
                            }
                            if($_POST['filter-local'] != "all"){
                                $req = $req . " WHERE location = '" . $_POST['filter-local']."'";
                                $first_filter = false;
                            }
                            if($_POST['filter-date'] != "all") {
                                if($first_filter){
                                    $req = $req . " devices";
                                    $req = $req . " WHERE YEAR(purchase_date) = " . $_POST['filter-date'];
                                    $first_filter = false;
                                } else {
                                    $req = $req . " AND YEAR(purchase_date) = " . $_POST['filter-date'];
                                }
                            }
                            if ($first_filter && $_POST['filter-type'] == "all") {
                                charge_all($conn);
                            } else {
                                $req = $req . ";";
                                if($_POST['filter-type'] == "monitors"){
                                    charge_monitors_from_req($conn, $req);
                                } else {
                                    charge_devices_from_req($conn, $req);
                                }
                            }
                        }

                }

            }
            ?>

        </div>
    </div>

    <div class="main-inventory rebus">
        <h2>Inventaire de Rebut</h2>
        <div class="inventory-grid">
            <div class="card rebus-card">
                <img src="images/uc.png" alt="Unité centrale">
                <h3>HP Pro</h3>
                <p>UC-014</p>
                <div class="actions">
                    <button class="btn-view">Consulter</button>
                    <button class="btn-restore">Remise en service</button>
                </div>
            </div>
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

<div id="model-consulter" class="model hidden">
    <div class="model-content">
        <span class="close">&times;</span>

        <h2 id="model-title">Titre</h2>

        <p><strong>Type :</strong> <span id="model-Gtype"></span></p>
        <p><strong>Numéro de série :</strong> <span id="model-serial"></span></p>

        <!-- UNIQUEMENT UC -->
        <p class="field-uc"><strong>Nom :</strong> <span id="model-name"></span></p>
        <p class="field-uc"><strong>Fabricant :</strong> <span id="model-manufacturer"></span></p>
        <p class="field-uc"><strong>Modèle :</strong> <span id="model-model"></span></p>
        <p class="field-uc"><strong>Type d'unité :</strong> <span id="model-type"></span></p>
        <p class="field-uc"><strong>CPU :</strong> <span id="model-cpu"></span></p>
        <p class="field-uc"><strong>RAM(mb) :</strong> <span id="model-ram_mb"></span></p>
        <p class="field-uc"><strong>Capacité disque(gb) :</strong> <span id="model-disk_gb"></span></p>
        <p class="field-uc"><strong>Système d'exploitation :</strong> <span id="model-os"></span></p>
        <p class="field-uc"><strong>Domaine :</strong> <span id="model-domain"></span></p>
        <p class="field-uc"><strong>Localisation :</strong> <span id="model-location"></span></p>
        <p class="field-uc"><strong>Batiment :</strong> <span id="model-building"></span></p>
        <p class="field-uc"><strong>Piece :</strong> <span id="model-room"></span></p>
        <p class="field-uc"><strong>Adresse mac :</strong> <span id="model-macaddr"></span></p>
        <p class="field-uc"><strong>Année d'achat :</strong> <span id="model-purchase"></span></p>
        <p class="field-uc"><strong>Fin de la garantie :</strong> <span id="model-warranty"></span></p>


        <!-- UNIQUEMENT moniteur -->
        <p class="field-monitor"><strong>Fabricant :</strong> <span id="model-manu"></span></p>
        <p class="field-monitor"><strong>Modèle :</strong> <span id="model-modele"></span></p>
        <p class="field-monitor"><strong>Taille :</strong> <span id="model-size"></span></p>
        <p class="field-monitor"><strong>Resolution :</strong> <span id="model-resolution"></span></p>
        <p class="field-monitor"><strong>Connecteur :</strong> <span id="model-connector"></span></p>
        <p class="field-monitor"><strong>Connecté à :</strong> <span id="model-attached_to"></span></p>
    </div>
</div>

<div id="model-edit" class="model hidden">
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

    // Unités centrales
    $devices_building = mysqli_query($conn, "SELECT * FROM devices_building");
    $devices_cpu = mysqli_query($conn, "SELECT * FROM devices_cpu");
    $devices_disk_gb = mysqli_query($conn, "SELECT * FROM devices_disk_gb");
    $devices_domain = mysqli_query($conn, "SELECT * FROM devices_domain");
    $devices_location = mysqli_query($conn, "SELECT * FROM devices_location");
    $devices_os = mysqli_query($conn, "SELECT * FROM devices_os");
    $devices_ram_mb = mysqli_query($conn, "SELECT * FROM devices_ram_mb");
    $devices_room = mysqli_query($conn, "SELECT * FROM devices_room");
    // Moniteurs
    $monitor_connector = mysqli_query($conn, "SELECT * FROM monitors_connector");
    $monitor_resolution = mysqli_query($conn, "SELECT * FROM monitors_resolution");
    $monitor_attach = mysqli_query($conn, "SELECT DISTINCT(name) FROM devices");
    ?>
    <div class="model-content">
        <span class="close-edit">&times;</span>
        <h2>Modifier l'équipement</h2>

        <form id="edit-form">
            <input type="hidden" name="serial" id="edit-serial">
            <input type="hidden" name="type" id="edit-type"> <!-- uc / monitor -->

            <!-- UC -->
            <div class="form-uc">
                <label for="edit-name">Nom :</label>
                <input type="text" name="name" id="edit-name">

                <label for="edit-cpu">CPU :</label>
                <select name="cpu" id="edit-cpu" class="styled-select">
                    <option value="NULL">-- Sélectionner --</option>
                    <?php foreach ($devices_cpu as $el): ?>
                        <option value="<?= $el['cpu'] ?>"><?= $el['cpu'] ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="edit-ram_mb">RAM(mb) :</label>
                <select name="ram_mb" id="edit-ram_mb" class="styled-select">
                    <option value="NULL">-- Sélectionner --</option>
                    <?php foreach ($devices_ram_mb as $el): ?>
                        <option value="<?= $el['ram_mb'] ?>"><?= $el['ram_mb'] ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="edit-disk_gb">Espace disque(gb) :</label>
                <select name="disk_gb" id="edit-disk_gb" class="styled-select">
                    <option value="NULL">-- Sélectionner --</option>
                    <?php foreach ($devices_disk_gb as $el): ?>
                        <option value="<?= $el['disk_gb'] ?>"><?= $el['disk_gb'] ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="edit-os">Système d'exploitation :</label>
                <select name="os" id="edit-os" class="styled-select">
                    <option value="NULL">-- Sélectionner --</option>
                    <?php foreach ($devices_os as $el): ?>
                        <option value="<?= $el['os'] ?>"><?= $el['os'] ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="edit-domain">Domaine :</label>
                <select name="domain" id="edit-domain" class="styled-select">
                    <option value="NULL">-- Sélectionner --</option>
                    <?php foreach ($devices_domain as $el): ?>
                        <option value="<?= $el['domain'] ?>"><?= $el['domain'] ?></option>
                    <?php endforeach; ?>
                </select>


                <label for="edit-location">Localisation :</label>
                <select name="location" id="edit-location" class="styled-select">
                    <option value="NULL">-- Sélectionner --</option>
                    <?php foreach ($devices_location as $el): ?>
                        <option value="<?= $el['location'] ?>"><?= $el['location'] ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="edit-building">Batiment :</label>
                <select name="building" id="edit-building" class="styled-select">
                    <option value="NULL">-- Sélectionner --</option>
                    <?php foreach ($devices_building as $el): ?>
                        <option value="<?= $el['building'] ?>"><?= $el['building'] ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="edit-room">Salle :</label>
                <select name="room" id="edit-room" class="styled-select">
                    <option value="NULL">-- Sélectionner --</option>
                    <?php foreach ($devices_room as $el): ?>
                        <option value="<?= $el['room'] ?>"><?= $el['room'] ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="edit-warranty">Fin de la garantie :</label>
                <input type="date" name="warranty" id="edit-warranty">
            </div>

            <!-- Moniteur -->
            <div class="form-monitor">
                <label for="edit-resolution">Resolution :</label>
                <select name="resolution" id="edit-resolution" class="styled-select">
                    <option value="NULL">-- Sélectionner --</option>
                    <?php foreach ($monitor_resolution as $el): ?>
                        <option value="<?= $el['resolution'] ?>"><?= $el['resolution'] ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="edit-connector">Connecteur :</label>
                <select name="connector" id="edit-connector" class="styled-select">
                    <option value="NULL">-- Sélectionner --</option>
                    <?php foreach ($monitor_connector as $el): ?>
                        <option value="<?= $el['connector'] ?>"><?= $el['connector'] ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="edit-attached_to">Connecté à :</label>
                <select name="attached_to" id="edit-attached_to" class="styled-select">
                    <option value="NULL">-- Sélectionner --</option>
                    <?php foreach ($monitor_attach as $el): ?>
                        <option value="<?= $el['name'] ?>"><?= $el['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn-save">Enregistrer</button>
        </form>
    </div>
</div>

<script src="script/deconnexion.js" defer></script>
<script src="script/inventaire.js" defer></script>

</body>
</html>
