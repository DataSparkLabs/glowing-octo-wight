<?php
/*
  Template Name: ACH FAQ Overview
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
          <div class="whowhat-container">

        <? $query = new WP_Query( array( 'post_type' => 'faq', 'faq_tax' => 'ach-faq' ) ); ?>
            
               <?php while($query->have_posts() ) : $query->the_post(); ?>
          <div class="post"> 
               <h1><?php the_title(); ?></h1>
               <div class="entry">    
                    <?php the_content(); ?>
                    
                    <?php  wp_reset_postdata(); ?>
                    
              </div>
          </div>
          
   </div>
     <?php endwhile; ?>

        </div>
        <div class="content-bottom"></div>
    </div>
</div>
<?php get_footer(); ?> 