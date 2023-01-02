<?php

$hostname = "Localhost";
$username = "root";
$password = "";
$db_name = "transng_db";

$conn = mysqli_connect($hostname, $username, $password, $db_name) or die("database connection failed");
