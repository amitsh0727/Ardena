<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ardena</title>
    <?php require_once("includes/header.php") ?>
</head>

<body>

    <!-- wrapper -->
    <div class="mil-wrapper" id="top">

        <!-- cursor -->
        <div class="mil-ball">
            <span class="mil-icon-1">
                <svg viewBox="0 0 128 128">
                    <path d="M106.1,41.9c-1.2-1.2-3.1-1.2-4.2,0c-1.2,1.2-1.2,3.1,0,4.2L116.8,61H11.2l14.9-14.9c1.2-1.2,1.2-3.1,0-4.2	c-1.2-1.2-3.1-1.2-4.2,0l-20,20c-1.2,1.2-1.2,3.1,0,4.2l20,20c0.6,0.6,1.4,0.9,2.1,0.9s1.5-0.3,2.1-0.9c1.2-1.2,1.2-3.1,0-4.2	L11.2,67h105.5l-14.9,14.9c-1.2,1.2-1.2,3.1,0,4.2c0.6,0.6,1.4,0.9,2.1,0.9s1.5-0.3,2.1-0.9l20-20c1.2-1.2,1.2-3.1,0-4.2L106.1,41.9	z" />
                </svg>
            </span>
            <div class="mil-more-text">More</div>
            <div class="mil-choose-text">Сhoose</div>
        </div>
        <!-- cursor end -->

        <?php require_once("includes/preloader.php") ?>
        <?php require_once("includes/navbar.php") ?>
        <?php require_once("includes/overlayframe.php") ?>

        <!-- content -->
        <div class="mil-content">
            <div id="swupMain" class="mil-main-transition">

                <!-- banner -->
                <div class="mil-inner-banner mil-p-0-120">
                    <div class="mil-banner-content mil-center mil-up">
                        <div class="container">
                            <ul class="mil-breadcrumbs mil-center mil-mb-60">
                                <li><a href="index.php">Homepage</a></li>
                                <li><a href="/contact-us.php">Contact</a></li>
                            </ul>
                            <h1 class="mil-mb-60">Get in touch!</h1>
                            <!-- <a href="#contact" class="mil-link mil-dark mil-arrow-place mil-down-arrow">
                                <span>Send message</span>
                            </a> -->
                        </div>
                    </div>
                </div>
                <!-- banner end -->

                <!-- map -->
                <!-- <div class="mil-map-frame mil-up">
                    <div class="mil-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1396.5769090312324!2d-73.6519672!3d45.5673453!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cc91f8abc30e0ff%3A0xfc6d9cbb49022e9c!2sManoir%20Saint-Joseph!5e0!3m2!1sen!2sua!4v1685485811069!5m2!1sen!2sua" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div> -->
                <!-- map end -->

                <!-- contact form -->
                <section id="contact">
                    <div class="container mil-p-120-90">
                        <h3 class="mil-center mil-up mil-mb-120">Let's <span class="mil-thin">Talk</span></h3>
                        <form name="contact" method="POST" data-netlify="true" netlify-honeypot="bot-field" class="row align-items-center">
                            <input type="hidden" name="form-name" value="contact">
                            <p class="hidden" style="display:none;"><label>Don't fill this out: <input name="bot-field"></label></p>
                            <div class="col-lg-6 mil-up">
                                <input name="name" type="text" placeholder="What's your name">
                            </div>
                            <div class="col-lg-6 mil-up">
                                <input name="email" type="email" placeholder="Your Email">
                            </div>
                            <div class="col-lg-6 mil-up">
                                <input name="phone" type="text" placeholder="Your Phone">
                            </div>
                            <div class="col-lg-12 mil-up">
                                <textarea name="message" placeholder="Tell us about our project"></textarea>
                            </div>
                            <div class="col-lg-8">
                                <p class="mil-up mil-mb-30"><span class="mil-accent">*</span> We promise not to disclose your personal information to third parties.</p>
                            </div>
                            <div class="col-lg-4">
                                <div class="mil-adaptive-right mil-up mil-mb-30">
                                    <button type="submit" class="mil-button mil-arrow-place">
                                        <span>Send message</span>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
                <!-- contact form end -->

                <?php require_once("includes/footermenu.php") ?>



            </div>
        </div>
        <!-- content -->
    </div>
    <!-- wrapper end -->

    <?php require_once("includes/footer.php") ?>

</body>

</html>