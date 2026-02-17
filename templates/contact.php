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

        <div class="row gx-5">
            
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="card h-100 border-0 shadow-sm rounded-4 hover-lift" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(15px);">
                    <div class="card-body p-5">
                        
                        <div class="d-flex mb-4">
                            <div class="feature bg-gradient-primary-to-secondary text-white rounded-3 me-3 p-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 54px; height: 54px; min-width: 54px;">
                                <i class="bi bi-geo-alt-fill fs-4"></i>
                            </div>
                            <div>
                                <div class="fw-bolder text-dark h6 mb-1"><?= $text['contact_address_label'] ?></div>
                                <div class="text-muted"><?= $text['contact_address'] ?></div>
                            </div>
                        </div>

                        <div class="d-flex mb-4">
                            <div class="feature bg-gradient-primary-to-secondary text-white rounded-3 me-3 p-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 54px; height: 54px; min-width: 54px;">
                                <i class="bi bi-telephone-fill fs-4"></i>
                            </div>
                            <div>
                                <div class="fw-bolder text-dark h6 mb-1"><?= $text['contact_phone_label'] ?></div>
                                <a href="tel:<?= str_replace(' ', '', $text['contact_phone']) ?>" class="text-decoration-none text-muted hover-link">
                                    <?= $text['contact_phone'] ?>
                                </a>
                            </div>
                        </div>

                        <div class="d-flex mb-4">
                            <div class="feature bg-gradient-primary-to-secondary text-white rounded-3 me-3 p-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 54px; height: 54px; min-width: 54px;">
                                <i class="bi bi-phone-fill fs-4"></i>
                            </div>
                            <div>
                                <div class="fw-bolder text-dark h6 mb-1"><?= $text['contact_mobile_label'] ?></div>
                                <a href="tel:<?= str_replace(' ', '', $text['contact_mobile_1']) ?>" class="text-decoration-none text-muted d-block mb-1 hover-link">
                                    <?= $text['contact_mobile_1'] ?>
                                </a>
                                <a href="tel:<?= str_replace(' ', '', $text['contact_mobile_2']) ?>" class="text-decoration-none text-muted d-block hover-link">
                                    <?= $text['contact_mobile_2'] ?>
                                </a>
                            </div>
                        </div>

                        <div class="d-flex mb-4">
                            <div class="feature bg-gradient-primary-to-secondary text-white rounded-3 me-3 p-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 54px; height: 54px; min-width: 54px;">
                                <i class="bi bi-envelope-fill fs-4"></i>
                            </div>
                            <div>
                                <div class="fw-bolder text-dark h6 mb-1"><?= $text['contact_email_label'] ?></div>
                                <a href="mailto:<?= $text['contact_email'] ?>" class="text-decoration-none text-primary fw-bold hover-link"><?= $text['contact_email'] ?></a>
                            </div>
                        </div>

                        <div class="p-4 bg-white rounded-3 shadow-sm border-start border-4 border-primary mt-5">
                            <div class="fw-bold text-primary mb-2 text-uppercase small d-flex align-items-center">
                                <i class="bi bi-clock-fill me-2 fs-5"></i>
                                <?= $text['contact_hours_label'] ?>
                            </div>
                            <div class="text-dark fw-bold"><?= $text['contact_hours_text'] ?></div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm rounded-4" style="background: rgba(255, 255, 255, 0.95);">
                    <div class="card-body p-5">
                        <h3 class="h4 fw-bold mb-4"><?= $text['form_title'] ?></h3>
                        <form>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" placeholder="<?= $text['form_name'] ?>" />
                                <label for="name"><?= $text['form_name'] ?></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="<?= $text['form_email'] ?>" />
                                <label for="email"><?= $text['form_email'] ?></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="phone" type="tel" placeholder="<?= $text['form_phone'] ?>" />
                                <label for="phone"><?= $text['form_phone'] ?></label>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" placeholder="<?= $text['form_message'] ?>" style="height: 120px"></textarea>
                                <label for="message"><?= $text['form_message'] ?></label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-lg rounded-pill pulse-animation bg-gradient-primary-to-secondary border-0" type="submit">
                                    <?= $text['form_send'] ?> <i class="bi bi-send-fill ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow rounded-4 overflow-hidden hover-lift">
                    <iframe 
                        width="100%" 
                        height="450" 
                        frameborder="0" 
                        scrolling="no" 
                        marginheight="0" 
                        marginwidth="0" 
                        src="http://googleusercontent.com/maps.google.com/maps?q=Europastra%C3%9Fe%201%2C%20G%C3%BCssing&t=&z=15&ie=UTF8&iwloc=&output=embed">
                    </iframe>
                </div>
            </div>
        </div>

    </div>
</section>