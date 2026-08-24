<!-- FOOTER -->
<footer id="footer">
    {{-- Tune --footer-extra-gray / --footer-logo-height in public/css/style.css --}}
    <div id="footer-banner">
        {{--
          Red strip = full logo height (not the header 53% split).
          On the footer the logo is on the RIGHT, so the rail curve sits above the flat
          yellow divider — the left red band must rise to match that curve top.
          Do not use SVG viewBox hacks to tune this; height is CSS-only.
        --}}
        <div class="footer-red-strip" aria-hidden="true"></div>

        <a href="{{ route('home') }}" class="footer-logo-link">
            <img src="{{ asset('img/logo-onrails.svg') }}?v=5" alt="On Rails">
        </a>
    </div>

    <!-- bottom footer -->
    <div id="bottom-footer" class="section">
        <div class="container">
            <ul class="footer-contact-links">
                <li><a href="https://maps.app.goo.gl/bRiM7xGBLpvTq4TA9" target="_blank"><i class="fa fa-map-marker"></i>Río Cuarto, Córdoba</a></li>
                <li><a href="https://wa.me/5493584022516" target="_blank"><i class="fa fa-phone"></i>+54 9 3584 02-2516</a></li>
                <li><a href="mailto:info@onrails.com.ar" target="_blank"><i class="fa fa-envelope-o"></i>info@onrails.com.ar</a></li>
            </ul>
            <div class="row">
                <div class="col-md-12 text-center">
                    <span class="copyright">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> Derechos reservados | Desarrollado y administrado por <a href="https://lampminds.com" target="_blank"><img src="img/lampminds_logo.jpg" alt="Lampminds.com"></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- /bottom footer -->
</footer>
<!-- /FOOTER -->

<!-- jQuery Plugins -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/nouislider.min.js') }}"></script>
<script src="{{ asset('js/jquery.zoom.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
