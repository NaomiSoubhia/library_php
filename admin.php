<?php
session_start();
// Make sure the user is logged in before they can access this page
require "includes/auth.php";

require "includes/header.php";
require "connect.php";




require __DIR__ . "/includes/main_admin.php";

require __DIR__ . "/includes/footer.php";

?>

