<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!DOCTYPE HTML>
<html>
<head>
    <title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />    
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/smoothness/jquery-ui-1.9.2.custom.min.css" />     
    <?php wp_enqueue_script("jquery"); ?>      
    <?php wp_head(); ?>  
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script/jquery-ui-1.9.2.custom.min.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script/global.js"></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-8949265-1', 'paynetsecure.net');
        ga('send', 'pageview');

        (function ($) {
            $( document ).ready(function() {
                $("#menu-item-39").hover(function() {
                    $("#faqrolldownbox").css("display","block");
                }, function(){
                    $("#faqrolldownbox").css("display","none");
                });
                $("#faqrolldownbox").hover(function() {
                    $("#faqrolldownbox").css("display","block");
                }, function(){
                    $("#faqrolldownbox").css("display","none");
                });
            });
        }(jQuery));



    </script>
</head>
<body>
    <div id="container">
        <div id="header">
            <div class="inner">
                <a href="<?php bloginfo('url'); ?>" class="logo"></a>
                <div class="begin-accepting">
                    <a href="#" style="text-decoration: none;"><span style="color: black; font-weight: bold;">Begin Accepting</span><br/><span style="color: #00508a;">Credit Cards Today</span></a>
                </div>
                <div class="account-approval">
                    <span style="color: #ff7300;">Account Approval</span><br/><span style="color: #00508a;">Call <?php echo do_shortcode('[fs_phone_route phone_route="17"]'); ?></span>
                </div>
            </div>
        </div>
        <div id="menu">
            <div class="inner">
                <?php wp_nav_menu(array('theme_location' => 'header-menu')); ?>
            </div>
        </div>

        <div id="faqrolldownboxcontainer">
            <div id="faqrolldownbox">
                <div id="faqrolldownboxinnerleft">
                    <div class="faqtitle">
                        &nbsp;&nbsp;&nbsp;High Risk Merchant Accounts FAQ
                    </div>
                    <div class="faqentries">
                        <ul class="lcp_catlist">
                        <?php
                            $query = new WP_Query( array( 'post_type' => 'faq', 'faq_tax' => 'high-risk-merchant-accounts-faq' ) );

                            while ( $query->have_posts() ) : $query->the_post();
                                echo '<li><a href="';
                                the_permalink();
                                echo '">';
                                the_title();
                                echo '</a></li>';
                            endwhile;
                        ?>
                        </ul>
                    </div>
                    </br></br>
                    <div class="faqtitle">
                        &nbsp;&nbsp;&nbsp;Global FAQ
                    </div>
                    <div class="faqentries">
                        <ul class="lcp_catlist">
                         <?php
                        $query = new WP_Query( array( 'post_type' => 'faq', 'faq_tax' => 'global-faq' ) );

                        while ( $query->have_posts() ) : $query->the_post();
                            echo '<li><a href="';
                            the_permalink();
                            echo '">';
                            the_title();
                            echo '</a></li>';
                        endwhile;
                        ?>
                        </ul>
                    </div>
                </div>
                <div id="faqrolldownboxinnerright">
                    <div class="faqtitle">
                        &nbsp;&nbsp;&nbsp;Create Offshore FAQ
                    </div>
                    <div class="faqentries">
                         <ul class="lcp_catlist">
                         <?php
                        $query = new WP_Query( array( 'post_type' => 'faq', 'faq_tax' => 'create-offshore-faq' ) );

                        while ( $query->have_posts() ) : $query->the_post();
                            echo '<li><a href="';
                            the_permalink();
                            echo '">';
                            the_title();
                            echo '</a></li>';
                        endwhile;
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>



