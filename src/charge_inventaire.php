<?php
function charge_all($conn, $limit, $offset){
    echo "<script>console.log('Charge All');</script>";

    // UC
    $sql = "SELECT * FROM devices LIMIT $limit OFFSET $offset";
    afficher_uc($conn, $sql);

    // Moniteurs
    $sql = "SELECT * FROM monitors LIMIT $limit OFFSET $offset";
    afficher_monitor($conn, $sql);
}

function charge_monitor($conn, $limit, $offset){
    echo "<script>console.log('Charge Monitors');</script>";
    $sql = "SELECT * FROM monitors LIMIT $limit OFFSET $offset";
    afficher_monitor($conn, $sql);
}

function charge_devices($conn, $limit, $offset){
    echo "<script>console.log('Charge Devices');</script>";
    $sql = "SELECT * FROM devices LIMIT $limit OFFSET $offset";
    afficher_uc($conn, $sql);
}

function afficher_uc($conn, $sql){
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
        $name   = $row['name'];
        $serial = $row['serial'];

        echo "<div class='card uc' id='$serial'>
                <img src='images/uc.png' alt='UC'>
                <h3>$name</h3>
                <p>$serial</p>
                <div class='actions'>
                    <button class='btn-view'>Consulter</button>
                    <button class='btn-edit'>Modifier</button>
                </div>
            </div>";
    }
}

function afficher_monitor($conn, $sql){
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
        $serial = $row['serial'];
        $model  = $row['model'];

        echo "<div class='card monitor' id='$serial'>
                <img src='images/monitor.png' alt='Moniteur'>
                <h3>$serial</h3>
                <p>$model</p>
                <div class='actions'>
                    <button class='btn-view'>Consulter</button>
                    <button class='btn-edit'>Modifier</button>
                </div>
            </div>";
    }
}

?>
