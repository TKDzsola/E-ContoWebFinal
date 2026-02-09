<?php
declare(strict_types=1);
namespace App\Service;

class LanguageService {
    private array $translations = [];
    private string $currentLang;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if (isset($_GET['lang']) && in_array($_GET['lang'], ['hu', 'de'])) {
            $_SESSION['lang'] = $_GET['lang'];
        }
        $this->currentLang = $_SESSION['lang'] ?? 'hu';
        
        // Nyelvi fájl betöltése
        $file = __DIR__ . '/../../lang/' . $this->currentLang . '.php';
        $this->translations = file_exists($file) ? require $file : require __DIR__ . '/../../lang/hu.php';
    }
    public function getAll(): array { return $this->translations; }
    public function getCurrentLang(): string { return $this->currentLang; }
}