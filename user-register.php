<?php
// db class includen.
require "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    try {
        $db = new DB();
        $db->register($_POST['name'], $_POST['email'], $_POST['password']);
        echo "Registered successfully. You will be redirected to login in 5 seconds.";
        header("refresh:5; url=login.php");
    } catch (Exception $e) {
        echo "error: ".$e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="name" placeholder="Naam">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="submit">
    </form>
</body>
</html>