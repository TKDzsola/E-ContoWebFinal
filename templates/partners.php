<section class="py-5 hero-section">
    <div class="hero-blob hero-blob-1" style="top: 15%; right: -5%;"></div>
    <div class="hero-blob hero-blob-2" style="bottom: 15%; left: -5%;"></div>

    <div class="container px-5 my-5 position-relative" style="z-index: 2;">
        
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bolder mb-3">
                <span class="text-gradient d-inline"><?= $text['partners_title'] ?></span>
            </h1>
            <p class="lead fw-light text-muted mb-0"><?= $text['partners_subtitle'] ?></p>
        </div>

        <div class="row gx-5 justify-content-center">
            
            <div class="col-lg-6 mb-5">
                <div class="card h-100 border-0 shadow-sm rounded-4 hover-lift" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(15px);">
                    <div class="card-body p-5 text-center">
                        
                        <div class="mb-4 d-flex justify-content-center align-items-center" style="height: 100px;">
                            <?php 
                                // Nyelvfüggő képválasztás
                                // Ha a nyelv német ('de'), akkor a német logót tölti be, egyébként a magyart
                                $nyelvhatar_img = ($current_lang == 'de') ? 'nyelvforditoirodade.jpg' : 'nyelvforditoirodahun.jpg';
                            ?>
                            <img src="assets/img/<?= $nyelvhatar_img ?>" alt="<?= $text['partner_1_name'] ?>" class="img-fluid" style="max-height: 100%; width: auto;">
                        </div>
                        
                        <h2 class="h4 fw-bold mb-3"><?= $text['partner_1_name'] ?></h2>
                        <p class="text-muted mb-4"><?= $text['partner_1_desc'] ?></p>
                        
                        <a href="http://www.nyelvhatar.hu" target="_blank" class="btn btn-outline-primary rounded-pill px-4">
                            <?= $text['partner_1_btn'] ?> <i class="bi bi-box-arrow-up-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-5">
                <div class="card h-100 border-0 shadow-sm rounded-4 hover-lift" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(15px);">
                    <div class="card-body p-5 text-center">
                        
                        <div class="mb-4 d-flex justify-content-center align-items-center" style="height: 100px;">
                            <img src="assets/img/fidas.gif" alt="<?= $text['partner_2_name'] ?>" class="img-fluid" style="max-height: 100%; width: auto;">
                        </div>
                        
                        <h2 class="h4 fw-bold mb-3"><?= $text['partner_2_name'] ?></h2>
                        <p class="text-muted mb-4"><?= $text['partner_2_desc'] ?></p>
                        
                        <a href="https://www.fidas.at" target="_blank" class="btn btn-outline-primary rounded-pill px-4">
                            <?= $text['partner_2_btn'] ?> <i class="bi bi-box-arrow-up-right ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        
        <div class="text-center mt-4">
            <p class="lead fw-light text-muted mb-4"><?= $text['partner_cta_text'] ?></p>
            <a class="btn btn-primary btn-lg rounded-pill pulse-animation bg-gradient-primary-to-secondary border-0 text-white" href="index.php?page=contact">
                <?= $text['partner_cta_btn'] ?>
            </a>
        </div>

    </div>
</section>