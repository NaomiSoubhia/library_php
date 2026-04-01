<?php

$host = "172.31.22.43"; //hostname
$db = "Naomi200645137"; //database name
$user = "Naomi200645137"; //username
$password = "jztLDwD6JZ"; //password

//Points to the database
$dsn = "mysql:host=$host;dbname=$db";

//try to connect, if connected echo yay!
try{
 $pdo = new PDO($dsn, $user, $password);
  //Show error message
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
//what happens if there is an error 
catch(PDOException $e){
    die("Database connection fail" . $e->getMessage());
}
?>