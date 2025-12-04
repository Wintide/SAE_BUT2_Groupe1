<?php


function charge_all($conn, $element_par_page, $offset){
    echo "<script>console.log('Charge All');</script>";
    $sql_uc = "select * from devices limit 12";
    $resultat_uc = mysqli_query($conn, $sql_uc);

    if (mysqli_num_rows($resultat_uc) > 0) {

        while ($row = mysqli_fetch_assoc($resultat_uc)) {

            $name = $row['name'];
            $serial = $row['serial'];
            $manufacturer = $row['manufacturer'];
            $model = $row['model'];
            $type = $row['type'];
            $cpu = $row['cpu'];
            $ram_mb = $row['ram_mb'];
            $disk_gb = $row['disk_gb'];
            $os = $row['os'];
            $domain = $row['domain'];
            $location = $row['location'];
            $building = $row['building'];
            $room = $row['room'];
            $macaddr = $row['macaddr'];
            $purchase_date = $row['purchase_date'];
            $warranty_end = $row['warranty_end'];

            echo "<div class='card uc' id='$serial' data-name='$name' data-serial='$serial' data-manufacturer='$manufacturer' data-model='$model' data-type='$type' data-cpu='$cpu' data-ram='$ram_mb' data-disk='$disk_gb' data-os='$os' data-domain='$domain' data-location='$location' data-building='$building' data-room='$room' data-macaddr='$macaddr' data-purchase='$purchase_date' data-warranty='$warranty_end'>";
            echo "<img src='images/uc.png' alt='Unité Centrale'>";
            echo "<h3>$name</h3>";
            echo "<p>$serial</p>";
            echo "<div class='actions'><button class='btn-view'>Consulter</button><button class='btn-edit'>Modifier</button></div></div>";

        }
    }
    $sql_monitor = "select * from monitors limit 12";
    $resultat_monitor = mysqli_query($conn, $sql_monitor);

    if (mysqli_num_rows($resultat_monitor) > 0) {

        while ($row = mysqli_fetch_assoc($resultat_monitor)) {

            $serial = $row['serial'];
            $manufacturer = $row['manufacturer'];
            $model = $row['model'];
            $size_inch = $row['size_inch'];
            $resolution = $row['resolution'];
            $connector = $row['connector'];
            $attached_to = $row['attached_to'];
            echo "<div class='card monitor' id='$serial'  data-serial='$serial' data-manufacturer='$manufacturer' data-model='$model' data-size='$size_inch' data-resolution='$resolution' data-connector='$connector' data-attached_to='$attached_to'>";
            echo "<img src='images/monitor.png' alt='Moniteur'>";
            echo "<h3>$serial</h3>";
            echo "<p>$model</p>";
            echo "<div class='actions'><button class='btn-view'>Consulter</button><button class='btn-edit'>Modifier</button></div></div>";
        }
    }
}

function charge_monitor($conn, $element_par_page, $offset){
    $sql_monitor = "select * from monitors limit 12";
    echo "<script>console.log('Charge Monitors');</script>";
    $resultat_monitor = mysqli_query($conn, $sql_monitor);

    if (mysqli_num_rows($resultat_monitor) > 0) {

        while ($row = mysqli_fetch_assoc($resultat_monitor)) {

            $serial = $row['serial'];
            $model = $row['model'];
            $size_inch = $row['size_inch'];

            echo "<div class='card monitor' id='$serial'  data-serial='$serial' data-model='$model' data-size='$size_inch'>";
            echo "<img src='images/monitor.png' alt='Moniteur'>";
            echo "<h3>$serial</h3>";
            echo "<p>$model</p>";
            echo "<div class='actions'><button class='btn-view'>Consulter</button><button class='btn-edit'>Modifier</button></div></div>";
        }
    }
}

function charge_devices($conn, $element_par_page, $offset){
    echo "<script>console.log('Charge devices');</script>";
    $sql_uc = "select * from devices limit 12";
    $resultat_uc = mysqli_query($conn, $sql_uc);

    if (mysqli_num_rows($resultat_uc) > 0) {

        while ($row = mysqli_fetch_assoc($resultat_uc)) {

            $name = $row['name'];
            $serial = $row['serial'];
            $room = $row['room'];
            $purchase_date = $row['purchase_date'];

            echo "<div class='card uc' id='$serial' data-name='$name' data-serial='$serial' data-model='$name' data-local='$room' data-year='$purchase_date'>";
            echo "<img src='images/uc.png' alt='Unité Centrale'>";
            echo "<h3>$name</h3>";
            echo "<p>$serial</p>";
            echo "<div class='actions'><button class='btn-view'>Consulter</button><button class='btn-edit'>Modifier</button></div></div>";

        }
    }
}

?>
