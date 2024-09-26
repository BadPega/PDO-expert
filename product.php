<?php


// Controleer of het formulier correct is verstuurd
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize inputs
    $code = filter_input(INPUT_POST, 'code', );
    $omschrijving = filter_input(INPUT_POST, 'omschrijving', );
    $prijsPerStuk = filter_input(INPUT_POST, 'prijsPerStuk', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Verwerken van de geüploade foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoTmpPath = $_FILES['foto']['tmp_name'];
        $fotoNaam = basename($_FILES['foto']['name']); // Ensure we only get the filename
        $fotoNaam = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", $fotoNaam); // Sanitize file name
        $fotoBestemming = 'uploads/' . $fotoNaam;

        // Avoid overwriting by checking if file already exists and renaming if needed
        $fotoBestemming = getUniqueFileName($fotoBestemming);

        // Verplaats het geüploade bestand naar de bestemming
        if (move_uploaded_file($fotoTmpPath, $fotoBestemming)) {
            // Voeg het product toe aan de database
            $result = $productModel->insertProduct($code, $omschrijving, $fotoBestemming, $prijsPerStuk);

            if ($result) {
                echo "Product succesvol toegevoegd!";
            } else {
                echo "Er ging iets mis bij het toevoegen van het product.";
            }
        } else {
            echo "Fout bij het uploaden van de foto.";
        }
    } else {
        echo "Geen foto geüpload of er is een fout opgetreden.";
    }
}

// Helper function to get a unique filename if the file already exists
function getUniqueFileName($filePath) {
    $fileDir = pathinfo($filePath, PATHINFO_DIRNAME);
    $fileName = pathinfo($filePath, PATHINFO_FILENAME);
    $fileExt = pathinfo($filePath, PATHINFO_EXTENSION);

    $counter = 1;
    while (file_exists($filePath)) {
        $filePath = $fileDir . '/' . $fileName . '_' . $counter . '.' . $fileExt;
        $counter++;
    }

    return $filePath;
}
?>
