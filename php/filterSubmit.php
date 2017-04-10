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

//Fetching Values from URL
$school2= "'" . $_POST['school1'] . "'";
if ($school2=="''" || $school2=="undefined" || $school2=="all"){
	$school2 = "null";
	}
$campus2= "'" . $_POST['campus1'] ."'";
if ($campus2=="''" || $campus2=="undefined" || $campus2=="All"){
	$campus2 = "null";
	}
$level2 = "'" . $_POST['level1']. "'";
if ($level2=="''" || $level2=="undefined" || $level2=="All"){
	$level2 = "null";
	}
$approved2= "'" . $_POST['approved1'] . "'";
if ($approved2=="''" || $approved2=="undefined" || $approved2=="All"){
	$approved2 = "null";
	}
$review2= "'" . $_POST['review1']."'";
if ($review2=="''" || $review2=="undefined" || $review2=="All"){
	$review2 = "null";
	}

//Insert query
$query = "call getstudentdata(". $school2 . ", " . $campus2 . ", " . $level2 . ", null, " . $approved2 . ", ". $review2 . ", null, null )";

$result = mysqli_query($mysqli, $query);

while($row = $result->fetch_assoc()){
	echo $row['username'] . '<br />';
	echo $result->num_rows;
}

/*echo "school = " . $school2 . " campus = " . $campus2 . " level = " . $level2 . " approved = " . $approved2 . " review = " . $review2 . "</br>" . $row; */

mysqli_close($mysqli); // Connection Closed
?>