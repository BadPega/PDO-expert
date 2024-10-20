<?php
require "db.php";
$db = new DB();
session_start();
if (isset($_SESSION['is_logged_in']) && $_SESSION['role'] == 'admin') {
    header('Location:insert-product.php');
} 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $user = $db->login($_POST['email']);
    if ($user && password_verify($_POST['password'],$user['password'])) {
        $_SESSION['is_logged_in'];
        switch ($user['role']) {
            case 'admin':
                $_SESSION['role'] = 'admin';
                header("Location: insert-product.php");
                break;
            case 'customer':
                $_SESSION['role'] = 'customer';
                header("Location: customer.php");
                break;
        }
    } else {
        echo "verkeerde email of wachtwoord";
        exit();
    }
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" class="card">
    <h2>Inloggen</h2>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <input type="submit" class="btn btn-primary" value="Login">
    </form>
</body>
</html>