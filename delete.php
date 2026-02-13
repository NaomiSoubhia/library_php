<?php
/**
 * delete.php
 */
//connect to db

require "connect.php";





// make sure we received an ID



if (!isset($_GET['id'])) {
  die("No post ID provided.");
}

$postId = $_GET['id'];


// create the query 
$sql = "DELETE FROM post where id = :id";
//prepare 
$stmt = $pdo->prepare($sql);

//bind 
$stmt->bindParam(':id', $postId);

//execute

$stmt->execute();


// Redirect back to admin list
header("Location: index.php");
exit;
