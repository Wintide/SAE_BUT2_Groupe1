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
                <li><button class="sidebar-btn" data-target="form-technicien">Ajouter un technicien</button></li>
                <li><button class="sidebar-btn" data-target="form-os">Ajouter un OS</button></li>
                <li><button class="sidebar-btn" data-target="form-constructeur">Ajouter un constructeur</button></li>
                <li><button class="sidebar-btn" data-target="form-information">Ajouter une information</button></li>
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

            <section id="form-information" class="content-section">
                <div class="form-container">
                    <h2>Ajouter une information</h2>

                    <form action="create_information.php" method="post">
                        <label>Ajouter une Information</label>
                        <select name="information" id="add-info">
                            <?php
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
                                    $sql_devices = "SHOW TABLES LIKE 'devices_%'";
                                    $result_devices = mysqli_query($conn, $sql_devices);

                                    $sql_monitor = "SHOW TABLES LIKE 'monitors_%'";
                                    $result_monitors = mysqli_query($conn, $sql_monitor);

                                    while ($row = mysqli_fetch_array($result_devices)) {

                                        $table = $row[0];                     // ex: devices_disk_gb
                                        $parts = explode("_", $table, 2);     // coupe après devices_
                                        $info = $parts[1];                    // ex: disk_gb

                                        echo "<option value='$info'>$info</option>";
                                    }

                                    while ($row = mysqli_fetch_array($result_monitors)) {

                                        $table = $row[0];
                                        $parts = explode("_", $table, 2);
                                        $info = $parts[1];

                                        echo "<option value='$info'>$info</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
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