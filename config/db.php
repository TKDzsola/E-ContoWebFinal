<?php
// Adatbázis beállítások (XAMPP alapértelmezett)
$host = 'localhost';
$db_name = 'e_conto_db'; // Fontos: Ide azt írd, ami az adatbázisod neve a phpMyAdminban!
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
    // Hibaüzenetek bekapcsolása
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Adatbázis hiba: " . $e->getMessage());
}
?>