<?php
//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'chamelis_203');
define('DB_PASSWORD', 'pentarraychameli203');
define('DB_NAME', 'chamelis_wp');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}

$from = date('Y-m-d',strtotime("-30 days"));
$to = date('Y-m-d',strtotime("-1 days"));
//query to get data from the table
$sql = sprintf("SELECT total, cash, credit, paid_out, tip_total, uber, postmates, grubhub, eat_24, peach, desi_dine_2_go, others
                        FROM manualsales
                        ORDER BY cash
                        ");

//execute query
$result = $mysqli->query($sql);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
?>