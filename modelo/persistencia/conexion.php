<?php
class conexion{

function getconexion(){

$servername = "localhost";
$username = "root";
$password = "";
$db="consultasfrm";
try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //  echo "Connected successfully"; 
    return $conn;
}
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
}

}
?>
