<?php
//  TODO: connect to the database 
require "connect.php"; 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request');
}
// access the form data and then echo on the page in a confirmation message


$firstname = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS);
$lastname = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
$posttitle = filter_input(INPUT_POST, 'post_title', FILTER_SANITIZE_SPECIAL_CHARS);
$postdate = filter_input(INPUT_POST, 'post_date', FILTER_SANITIZE_SPECIAL_CHARS);
$bookname = filter_input(INPUT_POST, 'book_name', FILTER_SANITIZE_SPECIAL_CHARS);
$category = filter_input(INPUT_POST, 'gridRadios', FILTER_SANITIZE_SPECIAL_CHARS);
$stars = filter_input(INPUT_POST, 'stars', FILTER_SANITIZE_SPECIAL_CHARS);
$review = filter_input(INPUT_POST, 'review', FILTER_SANITIZE_SPECIAL_CHARS);



//validation time = serverside

$errors = [];

//require text fields
if ($firstname === null || $firstname === '') {
    $errors[] = "First Name is Required.";
}

if ($lastname === null || $lastname === '') {
    $errors[] = "Last Name is Required.";
}

if ($posttitle === null || $posttitle === '') {
    $errors[] = "Post Title is Required.";
}

if ($postdate === null || $postdate === '') {
    $errors[] = "Post Date is Required.";
}

if ($bookname === null || $bookname === '') {
    $errors[] = "Book Name is Required.";
}

if ($category === null || $category === '') {
    $errors[] = "Category is Required.";
}

if ($review === null || $review === '') {
    $errors[] = "Review is Required.";
}


if ($stars === null || $stars === '') {
    $errors[] = "Stars is Required.";
} 


if (!empty($errors)) {
    require "includes/header.php";   
    echo "<div class='alert alert-danger'>";
    echo "<h2>Please fix the following:</h2>";
    echo "<ul>";
    foreach ($errors as $error) {
       
        echo "<li>" . htmlspecialchars($error) . "</li>";
    }
    echo "</ul>";
    echo "</div>";

    require "includes/footer.php";
    exit;
}


//1- Write an INSERT statement with named placeholders
$sql = "INSERT INTO post (first_name, last_name, title, post_date, book_name, category, stars, review) values (:first_name, :last_name, :post_title, :post_date, :book_name, :category, :stars, :review)";

//2. Prepare the statement
$stmt= $pdo->prepare($sql);

//Map the named placeholder to the user data/actual data
$stmt->bindParam(':first_name', $firstname);
$stmt->bindParam(':last_name', $lastname);
$stmt->bindParam(':post_title', $posttitle);
$stmt->bindParam(':post_date', $postdate);
$stmt->bindParam(':book_name', $bookname);
$stmt->bindParam(':category', $category);
$stmt->bindParam(':stars', $stars);
$stmt->bindParam(':review', $review);

//Execute the query
$stmt ->execute();

//Close the connection
$pdo = null;
require "index.php";
?>




