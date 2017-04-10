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
    
    $query = "SELECT DISTINCT `major` FROM `studentdata` WHERE `school` = 'Dyson College Arts & Sciences'";

    
    $result = $mysqli->query($query);

    while ($row = $result->fetch_array()) {
        $rows[] = $row;
    }

    echo json_encode($rows);
    mysqli_close($mysqli);
?>