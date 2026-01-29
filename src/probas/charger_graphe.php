<?php session_start();
if (empty($_SESSION['role']) ||$_SESSION['role'] !== "administrateur_web" ||$_SESSION["role"]!=="technicien") {
    header("Location: ./index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inventaire - Vines</title>
    <link rel="stylesheet" href="../css/style-charger-graphe.css">
</head>

<body>
    <header>
        <div class="header-content">
            <img src="../images/logovines.png" alt="Logo Vines" class="logo">
            <nav>
                <a href="../index.php" class="center-link">Accueil</a>
                <a href="../webadmin.php" class="center-link">Admin web</a>

                <div id="userButton" class="right-link">
                    <a href="logout.php" role="menuitem">Déconnexion</a>
                </div>
            </nav>
        </div>
    </header>

<script>
    fetch('../css/style-charger-graphe.css')
        .then(response => response.text())
        .then(data => {
            console.log('CSS File Contents:');
            console.log(data);
        })
        .catch(error => {
            console.error('Error fetching CSS file:', error);
        });
</script>
    
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
$colonnes_devices = [];
while ($row = mysqli_fetch_assoc($columns_query)) {
    $field = $row['Field'];
    // Il faut ignorer ces attributs car leur répartition n'est pas intéressante
    if (!in_array($field, ['name', 'serial', 'macaddr','purchase_date','warranty_end','room'])) {
        $colonnes_devices[] = $field;
    }
}

// On recupère les colonnes de monitors pour le menu déroulant de sélection des attributs
$columns_query = mysqli_query($conn, "SHOW COLUMNS FROM monitors");
$colonnes_monitors = [];
while ($row = mysqli_fetch_assoc($columns_query)) {
    $field = $row['Field'];
    // Il faut ignorer ces attributs car leur répartition n'est pas intéressante
    if (!in_array($field, ['serial', 'attached_to'])) {
        $colonnes_monitors [] = $field;
    }
}
?>

    <main>
        <h1> Module Statistiques </h1>
        <?php
        $repertoire = "./python";
        $liste_scripts = scandir($repertoire);
        $liste_scripts = array_diff($liste_scripts, array('.', '..'));

        $noms_scripts = [
            'repartition_de.py' => 'Répartition des unités centrales selon...',
            'repartition_moniteur_de.py' => 'Répartition des moniteurs selon...',
            'boxplot_duree_connexion.py' => "Boxplot des durées de connexion des utilisateurs",
            'courbe_machines_achetees_par_annee.py' => "Nombre d'unités centrales achetées par année",
            'duree_total_connexion_top.py' => 'Top 10 des utilisateurs avec les durées totales de connexion les plus grandes',
            'moniteurs_rattaches.py' => 'Répartition des moniteurs selon le rattachement',
            'repartition_connexions_par_intervalle_de_duree.py' => 'Répartition des connexions par intervalle de durée',
            'repartition_type_machine.py' => 'Répartition des types de machine',
            'repartition_UC_selon_garantie.py' => 'Répartition des UC selon leur proximité à la date de fin de garantie'
        ];
        ?>

        <form name="form-stats" id="form-stats" method="post" action="charger_graphe.php">
            <label for="stats">Choix du graphe : </label>
            <select name="stats" id="stats">
                <option value="">Sélectionner le script</option>
                <?php foreach ($liste_scripts as $script): ?>
                    <option value="<?= $script ?>"><?= $noms_scripts[$script] ?></option>
                <?php endforeach; ?>
            </select>
        
            <div id="attribut-container-devices" style="display:none;">
                <label for="attribut_device">Choix de l'attribut : </label>
                <select name="attribut_device" id="attribut_device">
                    <option value="">Sélectionner un attribut</option>
                    <?php foreach ($colonnes_devices as $col): ?>
                        <option value="<?= $col ?>"><?= $col ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        
            <div id="attribut-container-monitors" style="display:none;">
                <label for="attribut_monitor">Choix de l'attribut : </label>
                <select name="attribut_monitor" id="attribut_monitor">
                    <option value="">Sélectionner un attribut</option>
                    <?php foreach ($colonnes_monitors as $col): ?>
                        <option value="<?= $col ?>"><?= $col ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        
            <br>
            <input type="submit" value="Valider">
        </form>

    
        <?php if (!empty($_POST['stats'])): ?>
            <div id="div_graphe">
                <img src="../images/graphe.png" alt="graphe" width="800" id="graphe">
            </div>
        <?php endif; ?>
    
    </main>
<?php
if (isset($_POST['stats']) && !empty($_POST['stats'])) {
    $select = $_POST['stats'];

    if ($select === "repartition_de.py" && !empty($_POST['attribut_device'])) {
        $attr = $_POST['attribut_device'];
        $command = "../../sae/bin/python python/$select $attr";
    }
    elseif ($select === "repartition_moniteur_de.py" && !empty($_POST['attribut_monitor'])) {
        $attr = $_POST['attribut_monitor'];
        $command = "../../sae/bin/python python/$select $attr";
    }
    else {
        $command = "../../sae/bin/python python/$select";
    }

    $output = shell_exec($command);
}
?>
    <script>
        document.getElementById("stats").addEventListener("change", function () {
            const dev = document.getElementById("attribut-container-devices");
            const mon = document.getElementById("attribut-container-monitors");
        
            if (this.value === "repartition_de.py") {
                dev.style.display = "block";
                mon.style.display = "none";
                document.getElementById("attribut_monitor").value = "";
            }
            else if (this.value === "repartition_moniteur_de.py") {
                mon.style.display = "block";
                dev.style.display = "none";
                document.getElementById("attribut_device").value = "";
            }
            else {
                dev.style.display = "none";
                mon.style.display = "none";
                document.getElementById("attribut_device").value = "";
                document.getElementById("attribut_monitor").value = "";
            }
        });
    </script>

    <footer>
        <div class="footer-columns">
            <div>
                <h2>Assistance</h2>
                <ul>
                    <li><a href="#">Problèmes de connexion</a></li>
                </ul>
            </div>
            <div>
                <h2>Informations</h2>
                <ul>
                    <li><a href="#">Politique de confidentialité</a></li>
                    <li><a href="#">Mentions légales</a></li>
                </ul>
            </div>
            <div>
                <h2>Nos Contacts</h2>
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

<script src="../script/deconnexion.js" defer></script>
</html>
