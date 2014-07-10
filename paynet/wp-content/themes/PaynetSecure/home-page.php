<?php
/*
  Template Name: Home Page
 */
?>
<?php get_header(); ?>
<div id="home-buckets">
    <div class="inner">
        <div id="bucket1" class="bucket">
            <div class="bucket-title">
                High Risk Merchant Account
            </div>
            <ul class="bucket-list">
                <li>PCI Compliant</li>
                <li>Easy Application</li>
                <li>Quick Approval</li>
                <li>Competitive Rates</li>
            </ul>
            <a class="read-more" href="?page_id=17"></a>
        </div>
        <div id="bucket2" class="bucket">
            <div class="bucket-title">
                Global Payments
            </div>
            <ul class="bucket-list">
                <li>World-Wide Banking Network</li>
                <li>Direct Merchant Accounts</li>
                <li>High Volume</li>
                <li>Safe & Secure</li>
            </ul>
            <a class="read-more" href="?page_id=27"></a>
        </div>
        <div id="bucket3" class="bucket">
            <div class="bucket-title">
                International Merchant Accounts
            </div>
            <ul class="bucket-list">
                <li>Guaranteed Payments</li>
                <li>No Chargebacks</li>
                <li>Increase Sales up to 40%</li>
                <li>Fast Settlement</li>
            </ul>
            <a class="read-more" href="?page_id=21"></a>
        </div>
    </div>
</div>
<div id="content" class="home-content">
    <div class="inner">
        <div class="sidebar">
            <ul>
                <?php dynamic_sidebar('Page Sidebar') ?>
            </ul>
        </div>
        <div class="content-left">
            <?php while (have_posts()) : the_post(); ?>
                <?php the_content() ?>
            <?php endwhile;?>
        </div>
    </div>
</div>
<?php get_footer(); ?> 