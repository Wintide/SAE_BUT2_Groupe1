<?php


function charge_all($conn){
    echo "<script>console.log('Charge All');</script>";
    $sql_uc = "select * from devices limit 20";
    $resultat_uc = mysqli_query($conn, $sql_uc);

    if (mysqli_num_rows($resultat_uc) > 0) {

        while ($row = mysqli_fetch_assoc($resultat_uc)) {

            $name = $row['name'];
            $serial = $row['serial'];

            echo "<div class='card uc' id=$serial>";
            echo "<img src='images/uc.png' alt='Unité Centrale'>";
            echo "<h3>$name</h3>";
            echo "<p>$serial</p>";
            echo "<div class='actions'><button class='btn-view'>Consulter</button><button class='btn-edit'>Modifier</button></div></div>";

        }
    }
    $sql_monitor = "select * from monitors limit 20";
    $resultat_monitor = mysqli_query($conn, $sql_monitor);

    if (mysqli_num_rows($resultat_monitor) > 0) {

        while ($row = mysqli_fetch_assoc($resultat_monitor)) {

            $serial = $row['serial'];
            $model = $row['model'];

            echo "<div class='card monitor' id=$serial>";
            echo "<img src='images/monitor.png' alt='Moniteur'>";
            echo "<h3>$serial</h3>";
            echo "<p>$model</p>";
            echo "<div class='actions'><button class='btn-view'>Consulter</button><button class='btn-edit'>Modifier</button></div></div>";
        }
    }
}

function charge_monitor($conn){
    $sql_monitor = "select * from monitors limit 20";
    echo "<script>console.log('Charge Monitors');</script>";
    $resultat_monitor = mysqli_query($conn, $sql_monitor);

    if (mysqli_num_rows($resultat_monitor) > 0) {

        while ($row = mysqli_fetch_assoc($resultat_monitor)) {

            $serial = $row['serial'];
            $model = $row['model'];

            echo "<div class='card monitor' id=$serial>";
            echo "<img src='images/monitor.png' alt='Moniteur'>";
            echo "<h3>$serial</h3>";
            echo "<p>$model</p>";
            echo "<div class='actions'><button class='btn-view'>Consulter</button><button class='btn-edit'>Modifier</button></div></div>";
        }
    }
}

function charge_devices($conn){
    echo "<script>console.log('Charge devices');</script>";
    $sql_uc = "select * from devices limit 20";
    $resultat_uc = mysqli_query($conn, $sql_uc);

    if (mysqli_num_rows($resultat_uc) > 0) {

        while ($row = mysqli_fetch_assoc($resultat_uc)) {

            $name = $row['name'];
            $serial = $row['serial'];

            echo "<div class='card uc' id=$serial>";
            echo "<img src='images/uc.png' alt='Unité Centrale'>";
            echo "<h3>$name</h3>";
            echo "<p>$serial</p>";
            echo "<div class='actions'><button class='btn-view'>Consulter</button><button class='btn-edit'>Modifier</button></div></div>";

        }
    }
}

?>
