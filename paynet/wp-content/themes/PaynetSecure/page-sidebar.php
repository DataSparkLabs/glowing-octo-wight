<?php
/*
  Template Name: Page with Sidebar
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
        <div class="content-left">
            <?php while (have_posts()) : the_post(); ?>
                <?php the_content() ?>
            <?php endwhile;?>
        </div>
        <?php bottom_stamps(); ?>
    </div>
</div>
<?php get_footer(); ?> 