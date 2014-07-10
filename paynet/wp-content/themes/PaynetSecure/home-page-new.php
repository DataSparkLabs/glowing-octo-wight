<?php
/*
  Template Name: Home Page New
 */
?>
<?php get_header(); ?>
<div id="content">
    <div class="inner new-home-content-inner">
        <div class="home-top"></div>
        <div class="new-home-buckets">
            <div id="bucket1" class="new-bucket">
                <span class="title">High Risk Merchant Accounts</span>
                <div class="inner-image"></div>
                <div class="bucket-rollover">
                    <strong>High Risk Merchant Account</strong>
                    <ul>
                        <li>PCI Compliant</li>
                        <li>Easy Application</li>
                        <li>Quick Approval</li>
                        <li>Competitive Rates</li>
                    </ul>
                    <a class="read-more" href="?page_id=17"></a>
                </div>
            </div>
            <div id="bucket2" class="new-bucket">
                <span class="title">Global<br/>Payments</span>
                <div class="inner-image"></div>
                <div class="bucket-rollover">
                    <strong>Global Payments</strong>
                    <ul>
                        <li>Guaranteed Payments</li>
                        <li>No Chargebacks</li>
                        <li>Increase Sales up to 40%</li>
                        <li>Fast Settlement</li>
                    </ul>
                    <a class="read-more" href="?page_id=27"></a>
                </div>
            </div>
            <div id="bucket3" class="new-bucket">
                <span class="title">International Accounts</span>
                <div class="inner-image"></div>
                <div class="bucket-rollover">
                    <strong>International Merchant Account</strong>
                    <ul>
                        <li>World-Wide Banking Network</li>
                        <li>Direct Merchant Accounts</li>
                        <li>High Volume</li>
                        <li>Safe & Secure</li>
                    </ul>
                    <a class="read-more" href="?page_id=21"></a>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery(".new-bucket").hover(function(){
                    jQuery(this).find(".bucket-rollover").show();
                    jQuery(this).find(".inner-image").hide();
                }, function(){
                    jQuery(this).find(".bucket-rollover").hide();
                    jQuery(this).find(".inner-image").show();
                });
            });
        </script>
        <div style="margin: 0 35px;">
            <?php while (have_posts()) : the_post(); ?>
                <?php the_content() ?>
            <?php endwhile; ?>
        </div>
        <?php bottom_stamps(); ?>
    </div>
</div>
<?php get_footer(); ?> 