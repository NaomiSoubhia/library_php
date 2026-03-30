<?php
//  TODO: connect to the database 
require "connect.php"; 

session_start();
// Make sure the user is logged in before they can access this page
require "includes/auth.php";

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

 // This will store the image path for the database
$imagePath = null;

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

//check whether a file was uploaded
    if (isset($_FILES['review_image']) && $_FILES['review_image']['error'] !== UPLOAD_ERR_NO_FILE) {
        //make sure upload completed successfully 
        if ($_FILES['review_image']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "There was a problem uploading your file!";
        } else {
            //only allow a few file types 
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];
            //detect the real MIME type of the file 
            $detectedType = mime_content_type($_FILES['review_image']['tmp_name']);
            if (!in_array($detectedType, $allowedTypes, true)) {
                $errors[] = "Only JPG, PNG and WebP allowed";
            } else {
                //build the file name and move it to where we want it to go (uploads)
                //get the file extension 
                $extension = pathinfo($_FILES['review_image']['name'], PATHINFO_EXTENSION);
                //create a unique filename so uploaded files don't overwrite 
                $safeFilename = uniqid('product_', true) . '.' . strtolower($extension);
                //build the full server path where the file will be stored 
                $destination = __DIR__ . '/uploads/' . $safeFilename;
                if (move_uploaded_file($_FILES['review_image']['tmp_name'], $destination)) {
                    //save the relative path to the database
                    $imagePath = 'uploads/' . $safeFilename; 
                } else {
                    $errors[] = "Image uploaded failed!"; 
                }
            }
        }
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
$sql = "INSERT INTO post (first_name, last_name, title, post_date, book_name, category, stars, review, image_path) values (:first_name, :last_name, :post_title, :post_date, :book_name, :category, :stars, :review, :image_path)";

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
$stmt->bindParam(':image_path', $imagePath);

//Execute the query
$stmt ->execute();

//Close the connection
$pdo = null;
require "index.php";
?>




