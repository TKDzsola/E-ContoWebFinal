<?php
header('Content-Type: application/json; charset=utf-8');

// Adatbázis kapcsolat beolvasása
require_once __DIR__ . '/../config/db.php';

// JSON adatok beolvasása a kérésből
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id']) && !empty($data['id'])) {
    try {
        // Törlés végrehajtása az ID alapján
        $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = ?");
        $stmt->execute([$data['id']]);

        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Adatbázis hiba: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Érvénytelen vagy hiányzó azonosító.']);
}