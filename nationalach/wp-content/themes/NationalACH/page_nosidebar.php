<?php
/*
  Template Name: Page No Sidebar
 */
?>
<?php get_header(); ?>
<div id="content">
    <div class="inner">
        <div class="content-top-full"></div>
        <div class="content-full">
            <?php while (have_posts()) : the_post(); ?>
                <?php the_content() ?>
            <?php endwhile; ?>
        </div>
        <div class="content-bottom-full"></div>
    </div>
</div>
<?php get_footer(); ?> 