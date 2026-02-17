<!DOCTYPE html>
<html lang="<?= $current_lang ?>">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?= $text['site_title'] ?? 'E-Conto' ?></title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="assets/css/styles.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column h-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-4 shadow-sm sticky-top">
        <div class="container px-5">
            
            <a class="navbar-brand" href="index.php">
                <img src="assets/img/econtologo.jpg" alt="E-Conto Logo" style="max-height: 50px; width: auto;">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-bold align-items-center" style="font-size: 0.95rem;">
                    <li class="nav-item"><a class="nav-link px-3" href="index.php?page=home"><?= $text['nav_home'] ?></a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="index.php?page=services"><?= $text['nav_services'] ?></a></li>
                    
                    <li class="nav-item ms-lg-2 me-lg-2">
                        <a class="btn btn-primary rounded-pill px-4 shadow-sm pulse-animation text-white" href="index.php?page=booking">
                            <?= $text['nav_booking'] ?>
                        </a>
                    </li>

                    <li class="nav-item"><a class="nav-link px-3" href="index.php?page=partners"><?= $text['nav_partners'] ?></a></li>
                    <li class="nav-item"><a class="nav-link px-3" href="index.php?page=contact"><?= $text['nav_contact'] ?></a></li>
                </ul>
                
                <div class="ms-lg-4 d-flex align-items-center border-start ps-3">
                    <a href="?lang=hu&page=<?= $page ?>" class="me-2 opacity-75 hover-lift"><img src="assets/img/hungaryflag.png" width="24" alt="Magyar"></a>
                    <a href="?lang=de&page=<?= $page ?>" class="opacity-75 hover-lift"><img src="assets/img/austriaflag.png" width="24" alt="Deutsch"></a>
                </div>
            </div>
        </div>
    </nav>
    <main class="flex-shrink-0">