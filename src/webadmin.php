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
            <a href="probas/charger_graphe.php" class="center-link"> Statistique </a>
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
                <li><button class="sidebar-btn" data-target="form-technicien">Ajouter un technicien</button></li>
                <li><button class="sidebar-btn" data-target="form-information">Ajouter une caractéristique</button></li>
            </ul>
        </aside>

        <div class="admin-content">

            <section id="form-technicien" class="content-section active">
                <h2>Liste des techniciens</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Login</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $host = "localhost";
                    $user = "root";
                    $pass = "root";
                    $db = "vines";
                    $conn = mysqli_connect($host, $user, $pass, $db);

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
                            $sql = "SELECT login FROM users WHERE role='technicien'";
                            $result = mysqli_query($conn, $sql);

                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr><td>" . $row['login'] . "</td></tr>";
                                }
                            } else {
                                echo "<script>console.log('Erreur requête : " . mysqli_error($conn) . "');</script>";
                            }
                        }
                    }
                    mysqli_close($conn);
                    ?>
                    </tbody>
                </table>
                <div class="form-container">
                    <h2>Créer un technicien</h2>

                    <form action="create_technician.php" method="post">
                        <?php
                            if ($_GET['error']=="user_exists") {
                                echo "<script>console.log('Erreur : utilisateur déjà existant');</script>";
                                echo "<p>Erreur : un utilisateur avec ce login existe déjà.</p>";
                            }
                        ?>
                        <label for="login">Login du technicien :</label>
                        <input type="text" id="login" name="login" required autofocus>

                        <label for="password">Mot de passe :</label>
                        <input type="password" id="password" name="password" required>

                        <button id="form-button" type="submit">Créer le technicien</button>
                    </form>
                </div>
            </section>

            <section id="form-information" class="content-section">
                <div class="form-container">
                    <h2>Ajouter une information</h2>

                    <form action="create_information.php" method="post">
                        <?php
                            if ($_GET['err']==1) {
                                echo "<script>console.log('Erreur lors de l\'ajout de l\'information');</script>";
                                echo "<p>Une erreur est survenue lors de l'ajout de l'information.</p>";
                            }
                        ?>
                        <label for="add-info">Ajouter une Information pour:</label>
                        <select name="add-info" id="add-info">
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

                                        $info = $row[0];
                                        echo "<option value='$info'>$info</option>";
                                    }

                                    while ($row = mysqli_fetch_array($result_monitors)) {

                                        $info = $row[0];
                                        echo "<option value='$info'>$info</option>";
                                    }
                                }
                            }
                            ?>
                        </select>

                        <label>Qu'est ce qu'il faut ajouter :
                        <input type="text" name="info" required>
                        </label>

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