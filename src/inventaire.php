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
            <a href="index.php" class="center-link">Acceuil</a>
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
                    $items_per_page = 24;
                    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                    $offset = ($page - 1) * $items_per_page;

                    $total_items_query = "SELECT COUNT(*) AS total FROM materiel";
                    $total_items = mysqli_fetch_assoc(mysqli_query($conn, $total_items_query))['total'];
                    $total_pages = ceil($total_items / $items_per_page);

                    if (isset($_POST['filter-type'])) {
                        $type = $_POST['filter-type'];
                        switch ($type) {
                            case "all":      charge_all($conn, $items_per_page, $offset); break;
                            case "uc":       charge_devices($conn, $items_per_page, $offset); break;
                            case "moniteur": charge_monitor($conn, $items_per_page, $offset); break;
                        }
                    } else {
                        charge_all($conn, $items_per_page, $offset);
                    }


                }
            }
            ?>
            <div class="invenroty-pages">
                <?php if($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>" class="invenroty-page">Précédent</a>
                <?php endif; ?>

                <input type="number" min="1" value="<?= $page ?>"
                       onchange="window.location='?page='+this.value">

                <?php if(mysqli_num_rows(mysqli_query($conn,"SELECT * FROM devices LIMIT $limit OFFSET ".($offset+$limit))) > 0): ?>
                    <a href="?page=<?= $page + 1 ?>" class="invenroty-page">Suivant</a>
                <?php endif; ?>
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
<script src="script/deconnexion.js" defer></script>
</body>
</html>
