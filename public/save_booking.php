<?php
/**
 * save_booking.php - Véglegesen javítva
 */
error_reporting(0);
ini_set('display_errors', 0);

header('Content-Type: application/json; charset=utf-8');

try {
    $db_file = __DIR__ . '/config/db.php';
    if (!file_exists($db_file)) {
        $db_file = dirname(__DIR__) . '/config/db.php';
    }
    require_once $db_file;

    $input = json_decode(file_get_contents('php://input'), true);

    if (empty($input['name']) || empty($input['email']) || empty($input['date']) || empty($input['time'])) {
        throw new Exception('Hiányzó adatok.');
    }

    $name    = htmlspecialchars($input['name']);
    $email   = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
    $phone   = htmlspecialchars($input['phone'] ?? '');
    $service = htmlspecialchars($input['service'] ?? '');
    $date    = htmlspecialchars($input['date']);
    $time    = htmlspecialchars($input['time']);
    $message = htmlspecialchars($input['message'] ?? '');
    $lang    = $input['lang'] ?? 'hu'; // EZT OLVASSA BE

    // Mentés
    $sql = "INSERT INTO bookings (name, email, phone, service, booking_date, booking_time, message) 
            VALUES (:name, :email, :phone, :service, :b_date, :b_time, :message)";
    
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([
        ':name'    => $name,
        ':email'   => $email,
        ':phone'   => $phone,
        ':service' => $service,
        ':b_date'  => $date,
        ':b_time'  => $time,
        ':message' => $message
    ]);

    if ($result) {
        $admin_email = "farkasneborerika@gmail.com";
        $from = "info@e-conto.at";

        if ($lang === 'de') {
            // NÉMET SZÖVEG
            $subject = "Terminbestätigung | E-Conto";
            $msg_body = "Sehr geehrte(r) " . $name . ",\n\n";
            $msg_body .= "Vielen Dank für Ihre Terminbuchung. Hier sind die Details:\n\n";
            $msg_body .= "Datum: " . $date . "\n";
            $msg_body .= "Uhrzeit: " . $time . "\n";
            $msg_body .= "Anliegen: " . $service . "\n";
            if(!empty($message)) $msg_body .= "Anmerkung: " . $message . "\n";
            $msg_body .= "\nBei Fragen erreichen Sie uns unter: +36 70 518 2811\n\n";
            $msg_body .= "Mit freundlichen Grüßen,\nErika Farkasné Bor - E-Conto";
        } else {
            // MAGYAR SZÖVEG
            $subject = "Időpontfoglalás visszaigazolása | E-Conto";
            $msg_body = "Tisztelt " . $name . "!\n\n";
            $msg_body .= "Köszönjük időpontfoglalását. A foglalás részletei:\n\n";
            $msg_body .= "Időpont: " . $date . " " . $time . "\n";
            $msg_body .= "Ügytípus: " . $service . "\n";
            if(!empty($message)) $msg_body .= "Megjegyzés: " . $message . "\n";
            $msg_body .= "\nAmennyiben bármi kérdése van, kérjük keressen minket az alábbi elérhetőségen: +36 70 518 2811\n\n";
            $msg_body .= "Üdvözlettel:\nFarkasné Bor Erika - E-Conto";
        }

        $headers = "From: " . $from . "\r\n" .
                   "Reply-To: " . $from . "\r\n" .
                   "Content-Type: text/plain; charset=utf-8" . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        mail($email, $subject, $msg_body, $headers);
        mail($admin_email, "MÁSOLAT: " . $subject, "Ügyfél adatai:\n" . $msg_body, $headers);

        echo json_encode(['success' => true]);
    } else {
        throw new Exception('Hiba a mentésnél.');
    }

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}