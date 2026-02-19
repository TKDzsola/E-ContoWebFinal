<?php
$host = 'localhost';
$db   = 'econtoat';  
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
    // ÉLES KÖRNYEZET: Biztonsági okokból és a JSON válaszok miatt 
    // itt már nem szabad kiírni a pontos hibaüzenetet!
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Adatbázis csatlakozási hiba történt. Kérjük, próbálja újra később!']);
    exit;
}
?>