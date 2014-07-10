<?php
/*
  Template Name: Sitemap
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
        <div id="content-left">
            <h2>Sitemap</h2>
            <ul>
            <?php
            // Add pages you'd like to exclude in the exclude here
            wp_list_pages(
              array(
                'exclude' => '',
                'title_li' => '',
              )
            );
            ?>
            </ul>
            <?php while (have_posts()) : the_post(); ?>
                <?php the_content() ?>
            <?php endwhile;?>  
        </div>
    </div>
</div>
<?php get_footer(); ?> 