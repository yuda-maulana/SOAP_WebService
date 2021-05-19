<?php

$host         = "localhost";
$username     = "root";
$password     = "";
$dbname       = "dbpasien";

try {
    $dbconn = new PDO('mysql:host=localhost;dbname=dbpasien', $username, $password);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
