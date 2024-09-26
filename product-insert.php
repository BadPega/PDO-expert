<?php
require "product.php";
$product = new Product($pdo);
try {
    if ($_SERVER ['REQUEST_METHOD'] == 'POST')  
    $product->insertProduct($_POST ['naam'], $_POST['prijs']);
    echo "successfully inserted product";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
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
        <input type="text" name="naam" placeholder="Naam">
        <input type="number" name="prijs" placeholder="prijs">
        <input type="submit">
</form>
</body>
</html>