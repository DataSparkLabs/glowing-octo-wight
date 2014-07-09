<?php
/*
  Template Name: Home Page
 */
?>
<?php get_header(); ?>
<div id="slideshow">
    <a class="left" href="#"></a>
    <a class="right" href="#"></a>
    <?php $slides = GallerySlide::GetSlides(); ?>
    <div id="slideshow-images">        
        <?php             
            foreach($slides as $slide)
            {
              ?><div class="slideshow-image" style="background-image: url('<?php echo $slide->image_url; ?>');"></div><?php  
            }
        ?>
    </div>
    <div id="slideshow-nav">
    <?php             
        foreach($slides as $slide)
        {
          ?><a href="#" class="indicator">&nbsp;</a><?php  
        }
    ?>
    </div>
</div>
<script type="text/javascript">
    init_slideshow_indicator("#slideshow", "a.left", "a.right", "#slideshow-images .slideshow-image", "#slideshow-nav a.indicator");
</script>
<div id="buckets">
    <div class="inner">
        <div class="bucket" id="bucket1">
            <h2>Electronic Check<br/>ECheck</h2>
            <ul>
                <li>20% More Orders</li>
                <li>Collect Payments Faster</li>
                <li>Low Processing Rates</li>
            </ul>
            <p>Helping eCommerce, MOTO, High Risk Merchants Process eChecks and ACH Payments around the world.</p>
            <a class="bucket-button" href="<?php bloginfo('url'); ?>/?page_id=38">&nbsp;</a>
        </div>
        <div class="bucket" id="bucket2">
            <h2>ACH Payment<br/>Processing</h2>
            <ul>
                <li>Automate Cash Flow</li>
                <li>Quick Settlements</li>
                <li>Recurring Billing Option</li>
            </ul>
            <p>U.S. business can process through the Automated Clearing House payment gateway.</p>
            <a class="bucket-button" href="<?php bloginfo('url'); ?>/?page_id=30">&nbsp;</a>
        </div>
        <div class="bucket" id="bucket3">
            <h2>High Risk ACH<br/>Merchant Account</h2>
            <ul>
                <li>Get More Sales</li>
                <li>Increase Your Profits</li>
                <li>Quick Account Approval</li>
            </ul>
            <p>High risk merchants trust our banking network to process their electronic payments.</p>
            <a class="bucket-button" href="<?php bloginfo('url'); ?>/?page_id=40">&nbsp;</a>
        </div>
        <div class="ipad-left">
            <h2>MERCHANT SOLUTIONS</h2>
            <p><img style="float: left; margin-right: 10px;" alt="cart" src="<?php bloginfo('template_url'); ?>/images/cartIcon.png" />Payments Gateway delivers with a complete line of solutions designed from the ground up to help organizations automate and manage their payment acceptance and disbursement needs.</p>
            <h2>DEVELOPER SOLUTIONS</h2>
            <p><img style="float: left; margin-right: 10px;" alt="gear" src="<?php bloginfo('template_url'); ?>/images/gearIcon.png" />Designed by developers for developers, Payments Gateway is the ideal solution for adding payments handling capabilities to any application. There is no cost to become a developer and you'll get:</p>
        </div>
        <div class="ipad">
            <a class="request-demo" href="<?php bloginfo('url'); ?>/get-a-quote/"></a>
        </div>
    </div>
</div>
<?php get_footer(); ?> 