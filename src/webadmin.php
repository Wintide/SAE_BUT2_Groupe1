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
                <li><button class="sidebar-btn" data-target="form-technicien">Gérer les techniciens</button></li>
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

                    <form action="creer_technicien.php" method="post" id="create-tech-form">

                        <?php
                        if (isset($_GET['error'])) {

                            if ($_GET['error'] == "user_exists") {
                                echo "<p>Erreur : un utilisateur avec ce login existe déjà.</p>";
                            }
                            elseif ($_GET['error'] == "pwd_too_short") {
                                echo "<p>Erreur : le mot de passe doit contenir au moins 8 caractères.</p>";
                            }
                            elseif ($_GET['error'] == "pwd_mismatch") {
                                echo "<p>Erreur : les mots de passe ne correspondent pas.</p>";
                            }
                        }
                        ?>

                        <label for="login">Login du technicien :</label>
                        <input type="text" id="login" name="login" required autofocus>

                        <label for="password">Mot de passe :</label>
                        <input type="password" id="password" name="password" required>

                        <label for="password_confirm">Confirmer le mot de passe :</label>
                        <input type="password" id="password_confirm" name="password_confirm" required>

                        <button id="form-button" type="submit">Créer le technicien</button>
                    </form>
                </div>
                <div class="form-container">
                    <h2>Supprimer un technicien</h2>

                    <form action="supprimer_technicien.php" method="post">
                        <?php
                        if (isset($_GET['error'])) {
                            if ($_GET['error']=="user_dont_exist") {
                                echo "<script>console.log('Erreur : utilisateur inexistant');</script>";
                                echo "<p>Erreur : L'utilisateur avec ce login n'existe pas.</p>";
                            }
                            elseif ($_GET['error']=="tech1") {
                                echo "<script>console.log('Erreur : Suppression de tech1 impossible');</script>";
                                echo "<p>Erreur : Suppression de tech1 impossible.</p>";
                            }
                        }
                        ?>
                        <label for="login">Login du technicien :</label>
                        <input type="text" id="login" name="login" required>

                        <button id="form-button" type="submit">Supprimer</button>
                    </form>
                </div>
            </section>

            <section id="form-information" class="content-section">
                <div class="form-container">
                    <h2>Ajouter une caractéristique</h2>

                    <form action="creer_information.php" method="post">
                        <?php
                        if (isset($_GET['error'])) {
                            if ($_GET['error']==1) {
                                echo "<script>console.log('Erreur lors de l\'ajout de l\'information');</script>";
                                echo "<p>Une erreur est survenue lors de l'ajout de l'information.</p>";
                            }
                            if ($_GET['error']=="empty") {
                                echo "<script>console.log('Erreur champ vide');</script>";
                                echo "<p>Veuillez remplir le formulaire.</p>";
                            }
                        }
                        ?>
                        <label for="add-info">Ajouter une caratéristique pour:</label>
                        <select name="add-info" id="add-info">
                            <?php
                            $host = "localhost";
                            $user = "root";
                            $pass = "root";
                            $db = "vines";
                            $conn = mysqli_connect($host, $user, $pass);

                            $nom = [
                                    "devices_building" => "Batiment (UC)",
                                    "devices_cpu" => "CPU (UC)",
                                    "devices_disk_gb" => "Capacité disque GB (UC)",
                                    "devices_domain" => "Domaine (UC)",
                                    "devices_location" => "Localisation (UC)",
                                    "devices_manufacturer" => "Fabricant (UC)",
                                    "devices_model" => "Model (UC)",
                                    "devices_os" => "Système d'exploitation (UC)",
                                    "devices_ram_mb" => "RAM MB (UC)",
                                    "devices_room" => "Salle (UC)",
                                    "devices_type" => "Type (UC)",
                                    "monitors_connector" => "Connecteur (Moniteur)",
                                    "monitors_manufacturer" => "Fabricant (Moniteur)",
                                    "monitors_model" => "Model (Moniteur)",
                                    "monitors_resolution" => "Résolution (Moniteur)",
                                    "monitors_size_inch" => "Taille (Moniteur)",

                            ];

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
                                        echo "<option value='$info'>$nom[$info]</option>";
                                    }

                                    while ($row = mysqli_fetch_array($result_monitors)) {

                                        $info = $row[0];
                                        echo "<option value='$info'>$nom[$info]</option>";
                                    }
                                }
                            }
                            ?>
                        </select>

                        <label>Caractéristique à ajouter :
                        <input type="text" name="info" required>
                        </label>

                        <button id="form-button" type="submit">Ajouter</button>
                    </form>
                    <div id="table-content">
                        <script>
                            const select = document.getElementById("add-info");
                            const content = document.getElementById("table-content");

                            function loadTable(table) {
                                fetch("afficher_table.php?table=" + table)
                                    .then(response => response.text())
                                    .then(data => {
                                        content.innerHTML = data;
                                    });
                            }

                            select.addEventListener("change", function() {
                                loadTable(this.value);
                            });

                            window.addEventListener("DOMContentLoaded", function() {
                                loadTable(select.value);
                            });
                        </script>



                    </div>

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
<script>
    document.getElementById("create-tech-form")
        .addEventListener("submit", function(e) {

            const pwd = document.getElementById("password").value;
            const confirm = document.getElementById("password_confirm").value;
            const minLength = 8;

            if (pwd.length < minLength) {
                alert("Le mot de passe doit contenir au minimum " + minLength + " caractères.");
                e.preventDefault();
                return;
            }

            if (pwd !== confirm) {
                alert("Les mots de passe ne correspondent pas.");
                e.preventDefault();
            }
        });
</script>
<script src="script/deconnexion.js" defer></script>
<script src="script/admin-tabs.js" defer></script>
</body>
</html>