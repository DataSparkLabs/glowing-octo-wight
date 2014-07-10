<?php

require_once 'theme_config.php';

require_once 'views/CreditCardAcceptanceView.php';
require_once 'views/TerminalSelectionView.php';
require_once 'views/ContactView.php';
require_once 'views/OnlineAppView.php';
require_once 'views/GlobalBanksView.php';
require_once 'views/HighRiskRatesView.php';
require_once 'widgets/ContactWidget.php';
require_once 'widgets/RiskChartWidget.php';

show_admin_bar(false);
add_theme_support('post-thumbnails');
set_post_thumbnail_size(150, 9999);
register_nav_menus(array('header-menu' => 'Header Menu', 'footer-menu' => 'Footer Menu'));
register_sidebar(array('name' => 'Page Sidebar'));
register_sidebar(array('name' => 'Quote Sidebar'));
register_sidebar(array('name' => 'Blog Sidebar'));
function bottom_stamps()
{
    ?>
    <div class="bottom-stamps">
        <div class="trustguard">
            <a name="trustlink" href="http://secure.trust-guard.com/certificates/5533" target="_blank"
               onclick="var nonwin=navigator.appName!='Microsoft Internet Explorer'?'yes':'no'; window.open(this.href.replace('http', 'https'),'welcome','location='+nonwin+',scrollbars=yes,width=517,height='+screen.availHeight+',menubar=no,toolbar=no'); return false;"
               oncontextmenu="var d = new Date(); alert('Copying Prohibited by Law - This image and all included logos are copyrighted by trust-guard \251 '+d.getFullYear()+'.'); return false;">
                <img name="trustseal" alt="Privacy Verified" style="border: 0;" src="https://secure.trust-guard.com/seals/5533/privacy/header/" /></a>
        </div><!-- sb-trustguard -->
        <div class="verisign">
            <script src="https://seal.verisign.com/getseal?host_name=www.PayNetSecure.net&amp;size=S&amp;use_flash=YES&amp;use_transparent=YES&amp;lang=en"></script>
<!--                <a id="vsign-seal" href="http://www.verisign.com/verisign-trust-seal" title="Click to Verify - This site chose VeriSign Trust Seal to promote trust online with consumers.">ABOUT TRUST ONLINE</a>-->
        </div>
    </div>
    <?php
}
?>
