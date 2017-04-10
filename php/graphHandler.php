<?php
$mysqli = new mysqli("localhost", "root");
	$databaseSelect = 'graduateoutcomes';
	if ($mysqli->connect_errno) {
    	echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

	$db = mysqli_select_db ($mysqli, $databaseSelect);

	if (! $db) {
 		echo "no db";
	}

	$graphSelect2= $_POST['graphSelect1'];


	if ($graphSelect2=="''" || $graphSelect2=="undefined"){
		echo "db missing or query invalid";
	}

	if ($graphSelect2 == "Campus") {
		$query = "call getemployedbycampus";
	
		$result = mysqli_query($mysqli, $query);
	
		$fp = fopen('../dataFiles/file.csv', 'w');
	
		//For our d3 we use a csv style of label,count for the pie chart
		$csvline = "label,count" . PHP_EOL;
		fwrite($fp, $csvline);
		while ($row = mysqli_fetch_array($result)){
			$csvline = $row['campus'] . "," . $row['COUNT(s.pkey)']  . PHP_EOL;
			fwrite($fp, $csvline);
		}
		fclose($fp);

	} else if ($graphSelect2 == "School"){

		$query = "call getemployedbyschool";
	
		$result = mysqli_query($mysqli, $query);
	
		$fp = fopen('../dataFiles/file.csv', 'w');

		//For our d3 we use a csv style of label,count for the pie chart
		$csvline = "label,count" . PHP_EOL;
		fwrite($fp, $csvline);
		while ($row = mysqli_fetch_array($result)){
			$csvline = $row['school'] . "," . $row['COUNT(s.pkey)']  . PHP_EOL;
			fwrite($fp, $csvline);
		}
		fclose($fp);

	} else if ($graphSelect2 == "Level"){
		$query = "call getemployedbylevel";

		$result = mysqli_query($mysqli, $query);
	
		$fp = fopen('../dataFiles/file.csv', 'w');
	
		//For our d3 we use a csv style of label,count for the pie chart
		$csvline = "label,count" . PHP_EOL;
		fwrite($fp, $csvline);
		while ($row = mysqli_fetch_array($result)){
			$csvline = $row['level'] . "," . $row['COUNT(s.pkey)']  . PHP_EOL;
			fwrite($fp, $csvline);
		} 
		fclose($fp);
	} else{
			echo "Failed!!!!!!";
		}

    mysqli_close($mysqli);
?>