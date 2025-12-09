
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inventaire - Vines</title>
    <link rel="stylesheet" href="css/style-tech.css">
    <script src="script/chart.js"></script>
</head>
<body>
<header>
    <div class="header-content">
        <img src="images/logovines.png" alt="Logo Vines" class="logo">
        <nav>
            <a href="index.php" class="center-link">Accueil</a>
            <a href="webadmin.php" class="center-link">Admin web</a>

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
    <h1> Statistique </h1>
    <div id="main-stat">
        <p>
            Pourcentage de pc selon les locations
        </p>
        <canvas height="400px" width="400px" id="chart1"></canvas>
        <?php
        $host = "localhost";
        $user = "root";
        $pass = "root";
        $db = "vines";
        $conn = mysqli_connect($host, $user, $pass);

        echo "<script>let xValues = []; let yValues = []</script>";

        if (!$conn) {
            echo "<script>console.log('Erreur connexion serveur');</script>";
        } else {
        echo "<script>console.log('conn');</script>";
        $base = mysqli_select_db($conn, $db);
        if (!$base) {
            echo "<script>console.log('Erreur connexion BD');</script>";
        } else {
            $sql_uc = "select location, count(serial) as 'num' from devices group by location ";
            $resultat_uc = mysqli_query($conn, $sql_uc);
            if (mysqli_num_rows($resultat_uc) > 0) {
                while ($row = mysqli_fetch_assoc($resultat_uc)) {
                    echo "<script> xValues.push('".$row['location']."'); yValues.push('".$row['num']."')</script>";
                }
                echo "<script> 
const ctx = document.getElementById('chart1');
new Chart(ctx, {
    type: 'pie',
    data: {
        labels: xValues,
        datasets: [{
            data: yValues
        }]
    },
    options: {
        plugins: {
            legend: {
                display: true
            },
            title: {
                display: true,
                text: 'Pourcentage de pc selon les locations',
                fontSize: 16
            }
        }
    }
})
</script>";
            }
        }
        }?>


    </div>
</main>


