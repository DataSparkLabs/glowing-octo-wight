<?php
/*
  Template Name: Quote Page
 */
?>
<?php get_header(); ?>
<div id="content">
    <div class="inner">
        <div class="sidebar">
            <ul>
                <?php dynamic_sidebar('Quote Sidebar') ?>
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