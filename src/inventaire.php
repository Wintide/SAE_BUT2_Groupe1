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
    <title>Technicien - Vines</title>
    <link rel="stylesheet" href="css/style-tech.css">
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
    <div class="main-filtrage">
        <div class="filters">

            <form action="" method="post">
                <label for="filter-type">Type :</label>
                <select id="filter-type" name="filter-type">
                    <option value="all">Tous</option>
                    <option value="uc">Unités centrales</option>
                    <option value="moniteur">Moniteurs</option>
                </select>

                <label for="filter-local">Localisation :</label>
                <select id="filter-local" name="filter-local">
                    <option value="all">Toutes</option>
                    <option value="batA">Bât. A</option>
                    <option value="batB">Bât. B</option>
                    <option value="batC">Bât. C</option>
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
        <button class="btn-add">Ajouter une machine</button>
    </div>

    <div class="main-inventory">
        <h2>Inventaire Actif</h2>
        <div class="inventory-grid">

            <?php
            include 'charge_inventaire.php';
            $host = "localhost";
            $user = "root";
            $pass = "root";
            $db = "vines";
            $conn = mysqli_connect($host, $user, $pass);

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
                    if (isset($_POST['filter-type'])) {
                        $type = $_POST['filter-type'];
                        $element_par_page = 12; // nombre d’éléments par page
                        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                        if ($page < 1) $page = 1;
                        $offset = ($page - 1) * $element_par_page;

                        switch ($type) {
                            case "all":
                                charge_all($conn, $element_par_page, $offset);

                                break;

                            case "uc":
                                charge_devices($conn, $element_par_page, $offset);
                                break;

                            case "moniteur":
                                charge_monitor($conn, $element_par_page, $offset);
                                break;
                        }
                    } else {

                        charge_all($conn, 12, 0);
                    }
                }
            }
            ?>
            <div class="invenroty-pages">
                <input type="button" class="inventory-page" value="Precedent" id="precedent">
                <label for="num-page"></label>
                <input type="number" min="1" max="10" value="1" id="num-page">
                <input type="button" class="inventory-page" value="Suivant" id="suivant">
                <input type="hidden" id="page-input" name="page" value="<?= isset($_GET['page']) ? (int)$_GET['page'] : 1 ?>">

                <script>
                    let num_page = document.getElementById("num-page");
                    let precedent = document.getElementById("precedent");
                    let suivant = document.getElementById("suivant");
                    console.log(num_page.getAttribute("value"));

                    precedent.onclick = function(){
                        if (Number(num_page.getAttribute("value"))!==Number(num_page.getAttribute("min"))){
                            num_page.setAttribute("value", Number(num_page.getAttribute("value"))-1);
                        }

                    }
                    suivant.onclick = function(){
                        if (Number(num_page.getAttribute("value"))!==Number(num_page.getAttribute("max"))){
                            num_page.setAttribute("value", Number(num_page.getAttribute("value"))+1);
                        }
                    }
                </script>
            </div>
        </div>
    </div>

    <div class="main-inventory rebus">
        <h2>Inventaire de Rebus</h2>
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

        <h2 id="model-title"></h2>

        <p><strong>Type :</strong> <span id="model-type"></span></p>
        <p><strong>Numéro de série :</strong> <span id="model-serial"></span></p>

        <!-- UNIQUEMENT UC -->
        <p class="field-uc"><strong>Nom :</strong> <span id="model-name"></span></p>
        <p class="field-uc"><strong>Fabricant :</strong> <span id="model-manufacturer"></span></p>
        <p class="field-uc"><strong>Modèle :</strong> <span id="model-model"></span></p>
        <p class="field-uc"><strong>Type d'unité :</strong> <span id="model-uctype"></span></p>
        <p class="field-uc"><strong>CPU :</strong> <span id="model-cpu"></span></p>
        <p class="field-uc"><strong>RAM(mb) :</strong> <span id="model-ram_mb"></span></p>
        <p class="field-uc"><strong>Capacité disque(gb) :</strong> <span id="model-diskgb"></span></p>
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
        <p class="field-monitor"><strong>Connecté à :</strong> <span id="model-attachedto"></span></p>
    </div>
</div>

<div id="model-edit" class="model hidden">
    <div class="model-content">
        <span class="close-edit">&times;</span>
        <h2>Modifier l'équipement</h2>

        <form id="edit-form">
            <input type="hidden" name="serial" id="edit-serial">
            <input type="hidden" name="type" id="edit-type"> <!-- uc / monitor -->

            <!-- UC -->
            <div class="form-uc">
                <label>Nom :</label>
                <input type="text" name="name" id="edit-name">

                <label>CPU :</label>
                <input type="text" name="cpu" id="edit-cpu">

                <label>RAM(mb) :</label>
                <input type="number" name="ram" id="edit-ram_mb">

                <label>Espace disque(gb) :</label>
                <input type="number" name="disk" id="edit-diskgb">

                <label>Système d'exploitation :</label>
                <input type="text" name="os" id="edit-os">

                <label>Domaine :</label>
                <input type="text" name="domain" id="edit-domain">

                <label>Localisation :</label>
                <input type="text" name="location" id="edit-location">

                <label>Batiment :</label>
                <input type="text" name="building" id="edit-building">

                <label>Pièce :</label>
                <input type="text" name="room" id="edit-room">

                <label>Fin de la garantie :</label>
                <input type="text" name="year" id="edit-warranty">
            </div>

            <!-- Moniteur -->
            <div class="form-monitor">
                <label>Resolution :</label>
                <input type="text" name="resolution" id="edit-resolution">

                <label>Connecteur :</label>
                <input type="text" name="connector" id="edit-connector">

                <label>Connecté à :</label>
                <input type="text" name="attached_to" id="edit-attachedto">
            </div>

            <button type="submit" class="btn-save">Enregistrer</button>
        </form>
    </div>
</div>

<script src="script/deconnexion.js" defer></script>
<script src="script/inventaire.js" defer></script>

</body>
</html>
