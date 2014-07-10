<?php
/*
  Template Name: Page
 */
?>
<?php get_header(); ?>
<div id="content">
    <div class="inner">
        <?php while (have_posts()) : the_post(); ?>
            <?php the_content() ?>
        <?php endwhile;?>
        <?php bottom_stamps(); ?>
    </div>
</div>
<?php get_footer(); ?> 