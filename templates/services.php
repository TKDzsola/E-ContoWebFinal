<section class="py-5 hero-section">
    <div class="hero-blob hero-blob-1" style="top: 10%; right: 20%;"></div>
    <div class="hero-blob hero-blob-2" style="bottom: 10%; left: 10%;"></div>

    <div class="container px-5 my-5 position-relative" style="z-index: 2;">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bolder mb-3">
                <span class="text-gradient d-inline"><?= $text['nav_services'] ?></span>
            </h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-5" style="background: rgba(255, 255, 255, 0.95);">
                    <div class="card-body p-5">
                        <h3 class="h4 fw-bold mb-4 text-center"><?= $text['services_list_title'] ?></h3>
                        <ul class="list-unstyled fs-5 lh-lg">
                            <?php 
                            // Dinamikus link a régi oldal alapján
                            $fidas_link = "https://www.google.com/search?q=fidas+s%C3%BCd+steuerberatungskanzlei+jennersdorf";
                            
                            for($i=1; $i<=11; $i++): 
                                if(!empty($text['service_item_'.$i])): ?>
                                    <li class="mb-2 d-flex align-items-start">
                                        <i class="bi bi-check2-circle text-primary me-3 mt-1"></i> 
                                        <span>
                                            <?php if($i === 9 || $i === 10): // Könyvvizsgálat és Adótanácsadás linkkel ?>
                                                <a href="<?= $fidas_link ?>" class="text-decoration-none fw-bold" target="_blank" title="Jennersdorf">
                                                    <?= $text['service_item_'.$i] ?>
                                                </a>
                                            <?php else: ?>
                                                <?= $text['service_item_'.$i] ?>
                                            <?php endif; ?>
                                        </span>
                                    </li>
                                <?php endif; 
                            endfor; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5 bg-gradient-primary-to-secondary text-white">
    <div class="container px-5 my-5 text-center">
        <a class="btn btn-outline-light btn-lg px-5 py-3 fs-2 fw-bolder pulse-animation" href="index.php?page=contact&lang=<?= $lang ?>">
            <?= $text['services_cta'] ?>
        </a>
    </div>
</section>