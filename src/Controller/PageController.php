<?php
declare(strict_types=1);

namespace App\Controller;

use App\Core\View;
use App\Service\LanguageService;

class PageController
{
    private View $view;
    private LanguageService $languageService;

    public function __construct()
    {
        // Inicializáljuk a nézetet és a nyelvi szolgáltatást
        $this->view = new View();
        $this->languageService = new LanguageService();
        
        // Ezeket az adatokat MINDEN oldal megkapja (fejléc, lábléc miatt)
        $this->view->assign('text', $this->languageService->getAll());
        $this->view->assign('current_lang', $this->languageService->getCurrentLang());
        $this->view->assign('page', $_GET['page'] ?? 'home');
    }

    public function home(): void
    {
        // Itt később lekérhetnénk adatokat adatbázisból is...
        // De most csak rendereljük a 'home' sablont
        $this->view->render('home');
    }

    public function services(): void
    {
        $this->view->render('services');
    }

    public function booking(): void
    {
        $this->view->render('booking');
    }
    
    public function partners(): void
    {
        $this->view->render('partners');
    }

    public function contact(): void
    {
        $this->view->render('contact');
    }
}