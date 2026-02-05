<!-- scrollbar progress -->
<div class="mil-progress-track">
    <div class="mil-progress"></div>
</div>
<!-- scrollbar progress end -->

<!-- menu -->
<div class="mil-menu-frame">
    <!-- frame clone -->
    <div class="mil-frame-top ">
        <a href="index.php" class="mil-logo">ARDENA.</a>
        <div class="mil-menu-btn">
            <span></span>
        </div>
    </div>
    <style>
        .animated-logo {
            font-family: Arial, sans-serif;
            font-size: 24px;
            font-weight: bold;
            color: #ff7a00;
            /* Orange shade */
            white-space: nowrap;
            overflow: hidden;
            display: inline-block;
        }

        #logo-text::after {
            content: "ARDENA";
            animation: logoAnimation 3s steps(7) infinite;
        }

        @keyframes logoAnimation {
            0% {
                content: "A";
            }

            14% {
                content: "AR";
            }

            28% {
                content: "ARD";
            }

            42% {
                content: "ARDE";
            }

            56% {
                content: "ARDEN";
            }

            70% {
                content: "ARDENA";
            }

            85% {
                content: "ARDEN";
            }

            100% {
                content: "ARDE";
            }
        }
    </style>
    <!-- frame clone end -->
    <div class="container">
        <div class="mil-menu-content">
            <div class="row">
                <div class="col-xl-5">

                    <nav class="mil-main-menu" id="swupMenu">
                        <ul>
                            <li class="mil-has-children mil-active">
                                <a href="/">Homepage</a>

                            </li>
                            <li class="mil-has-children">
                                <a href="/portfolios">Portfolio</a>

                            </li>
                            <li class="mil-has-children">
                                <a href="/services">Services</a>

                            </li>
                            <li class="mil-has-children">
                                <a href="/industries">Industries</a>

                            </li>
                            <li class="mil-has-children">
                                <a href="/blog">Journal</a>

                            </li>
                            <li class="mil-has-children">
                                <a href="/contact-us">Contact</a>
                            </li>
                        </ul>
                    </nav>

                </div>
                <div class="col-xl-7">

                    <div class="mil-menu-right-frame">
                        <div class="mil-animation-in">
                            <div class="mil-animation-frame">
                                <div class="mil-animation mil-position-1 mil-scale" data-value-1="2" data-value-2="2"></div>
                            </div>
                        </div>
                        <div class="mil-menu-right">
                            <div class="row">
                                <div class="col-lg-8 mil-mb-60">

                                    <!-- <h6 class="mil-muted mil-mb-30">Projects</h6> -->

                                    <!-- <ul class="mil-menu-list">
                                        <li><a href="/portfolios.php" class="mil-light-soft">Moglix</a></li>
                                        <li><a href="/portfolios.php" class="mil-light-soft">Credlix</a></li>
                                        <li><a href="/portfolios.php" class="mil-light-soft">Cotton2Catwalk</a></li>
                                        <li><a href="/portfolios.php" class="mil-light-soft">Injection Care</a></li>
                                        <li><a href="/portfolios.php" class="mil-light-soft">MakeMyTrip</a></li>
                                        <li><a href="/portfolios.php" class="mil-light-soft">Infosys</a></li> 
                                    </ul> -->

                                </div>
                                <div class="col-lg-4 mil-mb-60">

                                    <h6 class="mil-muted mil-mb-30">Useful links</h6>

                                    <ul class="mil-menu-list">
                                        <li><a href="/privacy-policy" class="mil-light-soft">Privacy Policy</a></li>
                                        <li><a href="/terms-and-conditions" class="mil-light-soft">Terms and conditions</a></li>
                                        <li><a href="/cookie-policy" class="mil-light-soft">Cookie Policy</a></li>
                                        <li><a href="/careers" class="mil-light-soft">Careers</a></li>
                                    </ul>

                                </div>
                            </div>
                            <div class="mil-divider mil-mb-60"></div>
                            <div class="row justify-content-between">

                                <div class="col-lg-4 mil-mb-60">

                                    <h6 class="mil-muted mil-mb-30">India</h6>

                                    <p class="mil-light-soft mil-up">412, PP Tower, Netaji Subhash Place, Shakurpur, Delhi, 110034 <span class="mil-no-wrap">+91 81782 37744</span></p>

                                </div>
                                <div class="col-lg-4 mil-mb-60">

                                    <h6 class="mil-muted mil-mb-30">UK</h6>

                                    <p class="mil-light-soft">Stonedean, 13 Ashley Drive, Walton on Thames, Surrey, KT121JL <span class="mil-no-wrap">+44 74961 04537</span></p>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- menu -->

<!-- curtain -->
<div class="mil-curtain"></div>
<!-- curtain end -->
