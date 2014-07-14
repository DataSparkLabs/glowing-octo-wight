<!DOCTYPE HTML>
<html>
    <head>
        <title>National ACH</title>
        <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />    
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />     
        <?php wp_enqueue_script("jquery"); ?>      
        <?php wp_head(); ?>  
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/script/global.js"></script> 
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-8949220-1', 'nationalach.com');
        ga('send', 'pageview');

        </script>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <div class="inner">
                    <a class="logo" href="<?php bloginfo('url'); ?>">&nbsp;</a>
                    <div class="begin-accepting">
                        <strong>Begin Accepting</strong><br/>
                        ACH Payments Today
                    </div>
                    <div class="account-approval">
                        <strong>Account Approval</strong><br/>
                        Call <?php echo do_shortcode('[fs_phone_route phone_route="16"]'); ?>
                    </div>
                </div>
            </div>
        <div id="main-nav">
            <div class="inner">
                <?php wp_nav_menu(array('theme_location' => 'header-menu', 'walker' => new ACHNavMenuWalker())); ?>
            </div>
        </div>