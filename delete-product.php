<?php
session_start();
if (isset($_SESSION['is_logged_in']) && $_SESSION['role'] == 'admin' || !isset($_GET['productCode'])) {
    header('Location:insert-product.php');
} 

try {
    require "db.php";
    $db = new DB();
    $db->deleteProduct($_GET['productCode']);
    echo "Product deleted successfully. You will be redirected to the homepage in 5 seconds.";
    header("refresh:5; url=insert-product.php");
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>