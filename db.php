<?php
Class DB {
    public $dbh;
    public function __construct($db = "winkel", $user="root", $pwd="", $host="localhost") {
        try {
            $this->dbh = new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
    public function insertProduct($naam, $prijs) {
        $sql = "INSERT INTO product (naam, prijs) VALUES (?,?)";
        $stmt = $this->dbh->prepare($sql);
        $placeholders = [$naam, $prijs];
        $stmt->execute([$placeholders]);
    }
    public function register($name,$email, $password) {
        $stmt = $this->dbh->prepare("INSERT INTO user (name, email, password, role) VALUES (?,?,?,'admin')");
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([$name,$email, $password]);
    }
    public function login($email) {
        $stmt = $this->dbh->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetch();
        return $result;
    }
    public function selectProducts() {
        $stmt = $this->dbh->query("SELECT * FROM product");
        $result = $stmt->fetchAll();
        return $result;
    }
    public function editProduct($naam, $prijs, $productCode) {
        $stmt = $this->dbh->prepare("UPDATE product SET naam = ?, prijs = ? WHERE productCode = ?");
        $stmt->execute([$naam, $prijs, $productCode]);
    }
    public function deleteProduct($productCode) {
        $stmt = $this->dbh->prepare("DELETE FROM product WHERE productCode = ?");
        $stmt->execute([$productCode]);
    }
}
