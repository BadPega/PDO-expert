<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <h2></h2>

    <form action="insert-product.php" method="post" enctype="multipart/form-data">
    
        <label for="omschrijving">Omschrijving:</label>
        <input type="text" id="omschrijving" name="omschrijving" required><br><br>

        <label for="prijsPerStuk">Prijs per Stuk:</label>
        <input type="number" id="prijsPerStuk" name="prijsPerStuk" step="0.01" required><br><br>
        
        <label for="foto">Foto:</label>
        <input type="file" id="foto" name="foto" accept="image/*" required><br><br>
        
        <input type="submit" value="Product Toevoegen">
    </form>
</body>
</html>
