<?php

/**
 * update.php
 */


require "includes/header.php";
require "connect.php";


/* -------------------------------------------
   STEP 1: Make sure we received an ID in the URL
   Example: update.php?id=5
-------------------------------------------- */
if (!isset($_GET['id'])) {
  die("Post id provided.");
}

$postId = $_GET['id'];

/* -------------------------------------------
   STEP 2: If form is submitted, UPDATE the row
-------------------------------------------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Basic sanitization (trim removes extra spaces)
  $firstname = trim($_POST['first_name'] ?? '');
  $lastname  = trim($_POST['last_name'] ?? '');
  $posttitle     = trim($_POST['post_title'] ?? '');
  $postdate   = trim($_POST['post_date'] ?? '');
  $bookname     = trim($_POST['book_name'] ?? '');
  $category     = trim($_POST['category'] ?? '');
  $stars   = trim($_POST['stars'] ?? '');
  $review     = trim($_POST['review'] ?? '');



  // Simple validation (beginner-friendly)
  if ($firstname === '' || $lastname === '' || $posttitle == '' || $postdate == '' || $bookname == '' || $category == '' || $stars == '') {
    $error = "First name, last name, title, post date, book name, category and stars are required.";
  } else {

    $sql = "UPDATE post
            SET first_name = :first_name,
                last_name = :last_name,
                title = :post_title,
                post_date = :post_date,
                book_name = :book_name,
                category = :category,
                stars = :stars,
                review = :review
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);


    //Map the named placeholder to the user data/actual data
    $stmt->bindParam(':first_name', $firstname);
    $stmt->bindParam(':last_name', $lastname);
    $stmt->bindParam(':post_title', $posttitle);
    $stmt->bindParam(':post_date', $postdate);
    $stmt->bindParam(':book_name', $bookname);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':stars', $stars);
    $stmt->bindParam(':review', $review);

    $stmt->bindParam(':id', $postId);

    $stmt->execute();

    // Redirect back to the posts list (prevents resubmission on refresh)
    header("Location: index.php");
    exit;
  }
}

/* -------------------------------------------
   STEP 3: Load existing post data (to echo in the form)
-------------------------------------------- */
$sql = "SELECT * FROM post WHERE id = :id";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $postId);
$stmt->execute();

$post = $stmt->fetch();

if (!$post) {
  die("Order not found.");
}
?>

<main class="container mt-4">
  <h2>Update Post #<?= htmlspecialchars($post['id']); ?></h2>

  <?php if (!empty($error)): ?>
    <p class="text-danger"><?= htmlspecialchars($error); ?></p>
  <?php endif; ?>

  <!--
    This form is pre-filled using the order data pulled from the database.
    The admin can edit the values and submit to update the row.
  -->
  <form method="post">

    <h4 class="mt-3">Post Info</h4>

    <label class="form-label">First Name</label>
    <input
      type="text"
      name="first_name"
      class="form-control mb-3"
      value="<?= htmlspecialchars($post['first_name']); ?>"
      required>

    <label class="form-label">Last Name</label>
    <input
      type="text"
      name="last_name"
      class="form-control mb-3"
      value="<?= htmlspecialchars($post['last_name']); ?>"
      required>

    <label class="form-label">Post Title</label>
    <input
      type="text"
      name="post_title"
      class="form-control mb-3"
      value="<?= htmlspecialchars($post['title']); ?>">

    <div class="my-2">
      <input type="date" class="form-control" name="post_date" id="post_date" value="<?= htmlspecialchars($post['post_date']); ?>">
    </div>

    <label class="form-label">Book Name</label>
    <input
      type="text"
      name="book_name"
      class="form-control mb-3"
      value="<?= htmlspecialchars($post['book_name']); ?>">

    <fieldset class="form-group">

      <div class="my-2">
        <label class="form-label col-md-2 col-10">Category</label>
        <div class="col-sm-10">

          <div class="form-check">
            <input class="form-check-input" type="radio" name="category"
              id="gridRadios1" value="Fiction"
              <?= ($post['category'] == 'Fiction') ? 'checked' : '' ?>>
            <label class="form-check-label" for="gridRadios1">
              Fiction
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="category"
              id="gridRadios2" value="Fantasy"
              <?= ($post['category'] == 'Fantasy') ? 'checked' : '' ?>>
            <label class="form-check-label" for="gridRadios2">
              Fantasy
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="category"
              id="gridRadios3" value="Thriller"
              <?= ($post['category'] == 'Thriller') ? 'checked' : '' ?>>
            <label class="form-check-label" for="gridRadios3">
              Thriller
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="category"
              id="gridRadios4" value="Romance"
              <?= ($post['category'] == 'Romance') ? 'checked' : '' ?>>
            <label class="form-check-label" for="gridRadios4">
              Romance
            </label>
          </div>

        </div>
      </div>

    </fieldset>

    <div class="my-2">
      <div>
        <label for="stars" class="form-label">Stars</label>
        <select id="stars" name="stars" required class="form-select">

          <option value="">Choose...</option>

          <option value="1" <?= ($post['stars'] == 1) ? 'selected' : '' ?>>1</option>
          <option value="2" <?= ($post['stars'] == 2) ? 'selected' : '' ?>>2</option>
          <option value="3" <?= ($post['stars'] == 3) ? 'selected' : '' ?>>3</option>
          <option value="4" <?= ($post['stars'] == 4) ? 'selected' : '' ?>>4</option>
          <option value="5" <?= ($post['stars'] == 5) ? 'selected' : '' ?>>5</option>

        </select>
      </div>
    </div>



    <div class="my-2">
      <label for="review" class="form-label">Review</label>
      <textarea class="form-control" name="review" id="review" rows="3" ><?= htmlspecialchars($post['review']); ?></textarea>
    </div>



    <button class="btn btn-primary">Save Changes</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>

  </form>
</main>

<?php require "includes/footer.php"; ?>