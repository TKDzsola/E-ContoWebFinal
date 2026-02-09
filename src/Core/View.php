<?php
declare(strict_types=1);
namespace App\Core;

class View {
    private string $templatesPath;
    private array $data = [];

    public function __construct() {
        // Fontos: a templates a gyökérben van, 2 szinttel feljebb az src/Core-tól
        $this->templatesPath = __DIR__ . '/../../templates/';
    }
    public function assign(string $key, mixed $value): void {
        $this->data[$key] = $value;
    }
    public function render(string $viewName): void {
        extract($this->data);
        $header = $this->templatesPath . 'header.php';
        $content = $this->templatesPath . $viewName . '.php';
        $footer = $this->templatesPath . 'footer.php';
        
        if (file_exists($header)) require $header;
        if (file_exists($content)) require $content;
        else echo "Hiba: A nézet nem található ($viewName)";
        if (file_exists($footer)) require $footer;
    }
}