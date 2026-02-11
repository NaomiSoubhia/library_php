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

<table class="table table-bordered mt-3">
  <thead>
    <tr>
      <th>ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Title</th>
      <th>Date</th>
      <th>Book</th>
      <th>Category</th>
      <th>Stars</th>
      <th>Review</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($post as $p): ?>
      <tr>
        <td><?= htmlspecialchars($p['id']) ?></td>
        <td><?= htmlspecialchars($p['first_name']) ?></td>
        <td><?= htmlspecialchars($p['last_name']) ?></td>
        <td><?= htmlspecialchars($p['title']) ?></td>
        <td><?= htmlspecialchars($p['post_date']) ?></td>
        <td><?= htmlspecialchars($p['book_name']) ?></td>
        <td><?= htmlspecialchars($p['category']) ?></td>
        <td><?= htmlspecialchars($p['stars']) ?></td>
        <td><?= htmlspecialchars($p['review']) ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php endif; ?>
  