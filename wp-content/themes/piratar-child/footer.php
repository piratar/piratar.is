<footer>
    <div class="wrapper">
        <div class="box first">
            <h3>Píratapartýið</h3>
            <p>Píratar eru stjórnmálaafl sem berst fyrir raunverulegu gegnsæi og ábyrgð í stjórnkerfinu, auknu aðgengi að upplýsingum, beinu lýðræði, upplýsingafrelsi og endurskoðun höfundarréttar.</p>
	    </div>
        <div class="box">
            <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'depth'          => 1,
                ) );
            ?>
        </div>
        <div class="box last">
           
        </div>
        <div class="splitter h20"></div>
        <div class="info-box"><strong>© Píratar - Tortuga:</strong> Fiskislóð 31, 101 Reykjavík, <a href="mailto:piratar@piratar.is">piratar@piratar.is</a> Sími: 546-2000, Póstfang: Pósthólf 42, 121 Reykjavík</div>
        <!-- <div class="creator-box fr">Kóðað af <a target="_blank" href="http://www.gre.is/">gre</a> ~ <a target="_blank" href="mailto:arnarvalur88@gmail.com">avj</a></div> -->
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

<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/piratar_framework.js?v=0002"></script>

<div class="instagram tag"></div>
<?php wp_footer(); ?>
</body>
</html>