<?php
//TODO:
require "connect.php";

/*
  TODO:
  1. Write a SELECT query to get all subscribers
  2. Add ORDER BY subscribed_at DESC
  3. Prepare the statement
  4. Execute the statement
  5. Fetch all results into $subscribers
*/


//1. Write a SELECT query 
$sql = "SELECT * FROM post order by post_date desc";

//2. Prepare the statement
$stmt = $pdo->prepare($sql);


//4. Execute the statement
$stmt->execute();

$post = []; // placeholder

$post = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Close the connection
$pdo = null;


?>


<?php if (count($post) > 0): ?>
    <?php foreach ($post as $p): ?>
        <div class="container mx-auto text-center pt-2 bg-light rounded col-md-8 my-5 py-5" id="post">
            <div class="text-end">
                <a href=""><img class="mt-4 pe-3"  src="images/trash.png" alt=""></a>
                <a href=""><img class="mt-4 pe-5"  src="images/pencil.png" alt=""></a>
            
            </div>
            <h3 class="text-capitalize py-3"><?= htmlspecialchars($p['title']) ?></h3>
            <p class="text-capitalize"><em>By <?= htmlspecialchars($p['first_name']) ?> <?= htmlspecialchars($p['last_name']) ?></em></p>
           
            <div class="row d-flex justify-content-center">
            <div class="col-md-3">
            <p>Book: <?= htmlspecialchars($p['book_name']) ?></p>
            <p>Category: <?= htmlspecialchars($p['category']) ?></p>
           
            <?php for ($i = 0; $i < (int)$p['stars']; $i++) {
                echo '<img src="images/star.png" alt="" >';
            } ?>
            </div>
            <div class="col-md-5">
            <p class=""><em>Review: </em><?= htmlspecialchars($p['review']) ?></p>
            </div>
            </div>
             <p class=""><small><?= htmlspecialchars($p['post_date']) ?></small></p>

        </div>
    <?php endforeach; ?>

<?php endif; ?>