<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
        <div id="footer">
            <div class="inner">
                <div id="footer-menu">
                    <?php wp_nav_menu(array('theme_location' => 'footer-menu')); ?>
                </div>
                <div id="footer-meta">
                    <p>&copy; 2011 PAYNETSECURE.NET. All rights reserved. No part of this website may be reused commercially without the expressed written consent of <a href="http://www.paynetsecure.net">PAYNETSECURE.NET</a></p>
                    <p>Contact Us or Call Us Free at: <?php echo do_shortcode('[fs_phone_route phone_route="17"]'); ?></p>
                </div>
                <div id="footer-bottom">
                    <a id="footer-logo" href="<?php bloginfo('url'); ?>"></a>
                    1802 N. Carson St., Carson City, NV 89701
                </div>
            </div>
        </div>
    </div>
    <?php wp_footer() ?>
  </body>
</html>  