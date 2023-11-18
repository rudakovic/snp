<!-- footer -->
<footer id="footer" class="footer" role="contentinfo">
    <section class="company">
        <div class="company-contact-adress">
            <div class="footer-logo-img" style="background-image: url(<?php echo get_field( 'logo', 10 ); ?>)"></div>
            <div class="adress">
                <h4><span>Organizator: </span><?php echo get_field( 'naziv_organizatora', 47 ); ?></h4>
                <p><span>E-pošta: </span><a href="mailto:<?php echo get_field( 'e-posta', 47 ); ?>"><?php echo get_field( 'e-posta', 47 ); ?></a></p>
                <?php if(get_field( 'adresa', 47 )) : ?><p><span>Adresa: </span><?php echo get_field( 'adresa', 47 ); ?></p><?php endif; ?>
            </div>
            <div class="contact-container">
                <a href="<?php echo get_field( 'facebook_url', 47 ); ?>" class="glyph-icon flaticon-001-facebook"></a>
                <a href="<?php echo get_field( 'messenger_url', 47 ); ?>" class="glyph-icon flaticon-012-messenger"></a>
                <a href="<?php echo get_field( 'instagram_url', 47 ); ?>" class="glyph-icon flaticon-011-instagram"></a>
                <a href="<?php echo get_field( 'youtube_url', 47 ); ?>" class="glyph-icon flaticon-008-youtube"></a>
            </div>
        </div>
        <div class="sendMail">
            <h4>Pišite nam!</h4>
            <form id="sendThisMail" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
                <div>
                    <label for="nameM">Ime</label>
                    <input type="text" id="nameM" name="name" required>
                </div>
                <div>
                    <label for="emailM">E-mail</label>
                    <input type="email" id="emailM" name="email" required>
                </div>
                <div>
                    <label for="numberM">Br. telefona</label>
                    <input type="tel" id="numberM" name="number">
                </div>
                <div>
                    <label for="messageM">Poruka</label>
                    <textarea id="messageM" name="message" maxlength="560" required></textarea>
                </div>
                <button type="submit">Pošalji mail</button>
                <p class="ajax-msgM"></p>
            </form>
        </div>
    </section>
    <section class="contact">
<!--    <h2>Kontakt</h2>-->

    </section>
    <section class="copy">
        <p><?php echo get_field( 'footer_text', 47 ); ?></p>
    </section>
</footer>
<!-- /footer -->

</div>
<!-- /wrapper -->
<!--<script type="text/javascript" src="<?php /*echo get_template_directory_uri(); */?>/js/jquery-3.4.1.min.js"></script>
<script async type="text/javascript" src="<?php /*echo get_template_directory_uri(); */?>/js/video.js"></script>
-->
<?php wp_footer(); ?>

</body>
</html>