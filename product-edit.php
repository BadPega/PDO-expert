<?php
require "../db.php";
Class Product {
    private $pdo;
    public function __construct(DB $pdo) {
        $this->pdo = $pdo;
}

public function insertProduct($naam, $prijs) {
    return $this->pdo->execute("INSERT INTO product (naam, prijs) VALUES (?,?)",[$naam,$prijs]);
}
    
public function selectProducts() {
    return $this->pdo->execute("SELECT * FROM product")->fetchAll();
}

}

?>
