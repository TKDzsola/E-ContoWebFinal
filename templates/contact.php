<section class="py-5 hero-section">
    <div class="hero-blob hero-blob-1" style="top: 10%; left: -5%;"></div>
    <div class="hero-blob hero-blob-2" style="bottom: 5%; right: -5%;"></div>

    <div class="container px-5 my-5 position-relative" style="z-index: 2;">
        
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bolder mb-3">
                <span class="text-gradient d-inline"><?= $text['contact_title'] ?></span>
            </h1>
            <p class="lead fw-light text-muted mb-0"><?= $text['contact_subtitle'] ?></p>
        </div>

        <div class="row justify-content-center">
            
            <div class="col-lg-8">
                <div class="card h-100 border-0 shadow-sm rounded-4 hover-lift" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(15px);">
                    <div class="card-body p-5">
                        
                        <div class="d-flex mb-4 border-bottom pb-4">
                            <div class="feature bg-gradient-primary-to-secondary text-white rounded-3 me-4 p-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; min-width: 60px;">
                                <i class="bi bi-geo-alt-fill fs-3"></i>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <div class="fw-bolder text-dark h5 mb-1"><?= $text['contact_address_label'] ?></div>
                                <div class="text-muted fs-5"><?= $text['contact_address'] ?></div>
                            </div>
                        </div>

                        <div class="d-flex mb-4 border-bottom pb-4">
                            <div class="feature bg-gradient-primary-to-secondary text-white rounded-3 me-4 p-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; min-width: 60px;">
                                <i class="bi bi-telephone-fill fs-3"></i>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <div class="fw-bolder text-dark h5 mb-1"><?= $text['contact_phone_label'] ?></div>
                                <a href="tel:<?= str_replace(' ', '', $text['contact_phone']) ?>" class="text-decoration-none text-muted fs-5 hover-link">
                                    <?= $text['contact_phone'] ?>
                                </a>
                            </div>
                        </div>

                        <div class="d-flex mb-4 border-bottom pb-4">
                            <div class="feature bg-gradient-primary-to-secondary text-white rounded-3 me-4 p-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; min-width: 60px;">
                                <i class="bi bi-phone-fill fs-3"></i>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <div class="fw-bolder text-dark h5 mb-1"><?= $text['contact_mobile_label'] ?></div>
                                <a href="tel:<?= str_replace(' ', '', $text['contact_mobile_1']) ?>" class="text-decoration-none text-muted fs-5 d-block mb-1 hover-link">
                                    <?= $text['contact_mobile_1'] ?>
                                </a>
                                <a href="tel:<?= str_replace(' ', '', $text['contact_mobile_2']) ?>" class="text-decoration-none text-muted fs-5 d-block hover-link">
                                    <?= $text['contact_mobile_2'] ?>
                                </a>
                            </div>
                        </div>

                        <div class="d-flex mb-4 pb-2">
                            <div class="feature bg-gradient-primary-to-secondary text-white rounded-3 me-4 p-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px; min-width: 60px;">
                                <i class="bi bi-envelope-fill fs-3"></i>
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <div class="fw-bolder text-dark h5 mb-1"><?= $text['contact_email_label'] ?></div>
                                <a href="mailto:<?= $text['contact_email'] ?>" class="text-decoration-none text-primary fw-bold fs-5 hover-link"><?= $text['contact_email'] ?></a>
                            </div>
                        </div>

                        <div class="p-4 bg-white rounded-3 shadow-sm border-start border-4 border-primary mt-4">
                            <div class="fw-bold text-primary mb-2 text-uppercase small d-flex align-items-center">
                                <i class="bi bi-clock-fill me-2 fs-5"></i>
                                <?= $text['contact_hours_label'] ?>
                            </div>
                            <div class="text-dark fw-bold fs-5"><?= $text['contact_hours_text'] ?></div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-5 justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow rounded-4 overflow-hidden hover-lift">
                    <iframe 
                        width="100%" 
                        height="450" 
                        frameborder="0" 
                        scrolling="no" 
                        marginheight="0" 
                        marginwidth="0" 
                        src="https://maps.google.com/maps?q=Europastra%C3%9Fe+1,+7540+G%C3%BCssing&t=&z=15&ie=UTF8&iwloc=&output=embed">
                    </iframe>
                </div>
            </div>
        </div>

    </div>
</section>