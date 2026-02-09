<?php
declare(strict_types=1);

// Névterek használata az osztályokhoz
use App\Core\Autoloader;
use App\Controller\PageController;

// 1. Visszalépünk egy szintet (../), hogy elérjük az src mappát
require_once __DIR__ . '/../src/Core/Autoloader.php';

// 2. Beindítjuk az automatikus betöltőt
Autoloader::register();

// 3. Létrehozzuk a vezérlőt (ez a főnök)
$controller = new PageController();
$page = $_GET['page'] ?? 'home';

// 4. Meghívjuk a megfelelő oldalt
if (method_exists($controller, $page)) {
    $controller->$page();
} else {
    // Ha ismeretlen az oldal, a főoldalt töltjük be
    $controller->home();
}
?>