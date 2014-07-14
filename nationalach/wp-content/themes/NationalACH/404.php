<?php
/*
  Template Name: Page
 */
?>
<?php get_header(); ?>
<div id="content">
    <div class="inner">
        <div class="sidebar">
             <ul>
                <?php dynamic_sidebar('Page Sidebar') ?>
            </ul>
        </div>
        <div class="content-top"></div>
        <div class="content-left">
            <div class="oops-container">
                YOU MAY HAVE REACHED THIS PAGE IN ERROR, PLEASE USE THE NAVIGATION ABOVE TO CONTINUE BROWSING
            </div>
        </div>
        <div class="content-bottom"></div>
    </div>
</div>
<?php get_footer(); ?> 