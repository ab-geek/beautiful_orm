<?php


	define("DB_USER","root");
	define("DB_PASSWORD","12345");
	define("DB_HOST","localhost");
	define("DB_NAME","beautifulorm");


function dbConnect() {
    static $connection;
    if(!isset($connection)) {
        $connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    }
    if($connection === false) {
        return mysqli_connect_error();
    }
    return $connection;
}

function dbQuery($query) {
    $connection = dbConnect();
    $result = mysqli_query($connection,$query);
    return $result;
}

function dbSelect($query) {
    $rows = array();
    $result = dbQuery($query);
    if($result === false) {
        return false;
    }
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function countRows($query){
        return mysqli_num_rows( dbQuery($query) );
}


?>
