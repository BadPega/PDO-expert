<?php
require "db.php";
$db = new DB();

session_start();
if (!isset($_SESSION['is_logged_in']) && $_SESSION['role'] != 'admin') {
    header('Location:login.php');
} 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $db->insertProduct($_POST['naamProduct'],$_POST['prijsProduct']);
        echo "Product inserted successfully";
    } catch (Exception $e) {
        echo "Error: ".$e->getMessage();
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
    <div class="d-flex justify-content-between align-items-center">
        <div class="container">
        <h2>Product Toevoegen</h2>
        <form method="POST" class="w-50">
            <div class="form-group">
                <input type="text" name="naamProduct" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Naam">
            </div>
            <br>
            <div class="form-group">
                <input type="number" name="prijsProduct" step="0.10" class="form-control" name="prijsProduct" placeholder="Prijs">
            </div>
            <input type="submit" class="btn btn-primary">
        </form>
        </div>

        <div class="uitloggen">
                <a class="btn btn-danger" href="uitloggen.php">Uitloggen</a>
        </div>
    </div>

    <h2>Overzicht producten</h2>
    <table class="table table-success table-striped">
        <tr>
            <th>Product Code</th>
            <th>Naam</th>
            <th>Prijs</th>
            <th colspan="2">Action</th>
        </tr>

        <?php 
        $producten = $db->selectProducts();
        foreach ($producten as $product) {
            echo "<tr>";
            echo "<td>".$product['productCode']."</td>";
            echo "<td>".$product['naam']."</td>";
            echo "<td>".$product['prijs']."</td>";
            echo "<td> <a class='btn btn-primary' href='edit-product.php?productCode=".$product['productCode']."&name=".$product['naam']."&prijs=".$product['prijs']."'>Edit</a></td>";
            echo "<td> <a class='btn btn-danger' href='delete-product.php?productCode=".$product['productCode']."'>Delete</a></td>";
            echo "</tr>";
        } ?>
            
    </table>
</body>
</html>