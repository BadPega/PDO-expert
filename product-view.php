<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten Overzicht</title>
</head>
<body>

    <h1>Producten Overzicht</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Productnaam</th>
                <th>Prijs</th>
                <th>Categorie</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['price']; ?> €</td>
                        <td><?php echo $product['category']; ?></td>
                        <td class="action-buttons">
                            <a href="edit-product.php?id=<?php echo $product['id']; ?>">Bewerken</a>
                            <a href="delete-product.php?id=<?php echo $product['id']; ?>" class="delete-button">Verwijderen</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Geen producten gevonden.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
