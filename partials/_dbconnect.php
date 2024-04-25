<?php

//Script to connect to the database
$hostname = "localhost";
$username = "root";
$password = "";
$database = "idiscuss";

$conn = mysqli_connect($hostname, $username, $password, $database);

if(!$conn) {
    echo "Error: ".mysqli_connect_error();
}
