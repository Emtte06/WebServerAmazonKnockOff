<?php
$host = 'localhost';       
$username = 'root';        
$password = '';             
$dbname = 'amazon'; // databsens namn

$connection = mysqli_connect($host, $username, $password, $dbname); // skapar anslutningen till databasen

if (!$connection) { // stoppar programet om anslutningen misslyckas
    die("Databasanslutning misslyckades: " . mysqli_connect_error());
}
?>
