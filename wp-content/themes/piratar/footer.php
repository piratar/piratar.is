<footer>
    <div class="wrapper">
        <div class="box first">
            <h3>Píratapartýið</h3>
            <p>Píratar eru stjórnmálaafl sem berst fyrir raunverulegu gegnsæi og ábyrgð í stjórnkerfinu, auknu aðgengi að upplýsingum, beinu lýðræði, upplýsingafrelsi og endurskoðun höfundarréttar.</p>
        </div>
        <div class="box">
            <h3>Samfélagsmiðlar</h3>
            <p>Skoðaðu okkur líkaðu við okkur til að nýjustu fréttir af okkur.</p>
            <ul>
                <li><a href="https://www.facebook.com/Piratar.Island" target="_blank"><i class="fa fa-facebook-square"></i> Piratar.Island</a></li>
                <li><a href="https://twitter.com/PiratePartyIS" target="_blank"><i class="fa fa-twitter-square"></i> PiratePartyIS</a></li>
                <li><a href="https://www.youtube.com/user/PiratepartyIceland" target="_blank"><i class="fa fa-youtube-play"></i> PiratepartyIceland</a></li>
            </ul>
        </div>
        <div class="box last">
           <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo"><?php bloginfo( 'name' ); ?></a>
        </div>
        <div class="splitter h20"></div>
        <div class="info-box"><strong>© Píratar - Tortuga:</strong> Fiskislóð 31, 101 Reykjavík, <a href="mailto:piratar@piratar.is">piratar@piratar.is</a> Sími: 546-2000, Póstfang: Pósthólf 42, 121 Reykjavík</div>
    </div>
    <div style="display:none;">
        <?php
            wp_nav_menu( array(
                'theme_location' => 'mobile',
                'depth'          => 3,
            ) );
        ?>
    </div>
</footer>

<div class="overlayer"></div>

<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/piratar.min.js"></script>

<div class="instagram tag"></div>
<?php wp_footer(); ?>
</body>
</html>
