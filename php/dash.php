<?php
header("Content-type: text/javascript");

    $mysqli = new mysqli("localhost", "root");
    $databaseSelect = 'graduateoutcomes';
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    $db = mysqli_select_db ($mysqli, $databaseSelect);

    if (! $db) {
    echo "no db";
    }
    
    $query = "SELECT * FROM `dashboarddata` ";

    //$query = "call getUndergrads()";
    $result = $mysqli->query($query);

    while ($row = $result->fetch_array()) {
        $rows[] = $row;
    }

    
    $fp = fopen('../dataFiles/jsonFile.json', 'w');
    fwrite($fp, json_encode($rows, JSON_PRETTY_PRINT));
    fclose($fp);
    echo json_encode($rows);
    mysqli_close($mysqli);
?>