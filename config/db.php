<?php
$host = 'localhost';
$db   = 'econtoatweb';  // <--- ITT A VÁLTOZÁS!
$user = 'zsola_econtodb'; // A felhasználónév maradt a régi.
$pass = 'E-conto.atdbpass2025'; // A jelszó is maradt
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Élesben sose írd ki a hibát, de most a fejlesztéshez látnunk kell, ha baj van:
    die('Adatbázis hiba: ' . $e->getMessage());
}
?>