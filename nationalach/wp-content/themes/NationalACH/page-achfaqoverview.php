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
          <h1>ACH FAQ</h1>

        <? $query = new WP_Query( array( 'post_type' => 'faq', 'faq_tax' => 'ach-faq' ) ); ?>
            
               <?php while($query->have_posts() ) : $query->the_post(); ?>
          <div class="post"> 
               <h2 style="font-size:.9em; font-weight: bold;"><?php the_title(); ?></h2>
               <div class="entry" style="font-size: .8em;">    
                    <?php the_content(); ?>
                    
                    <?php  wp_reset_postdata(); ?>
                    
              </div>
          </div>
        <?php endwhile; ?>  
   </div>
     

        </div>
        <div class="content-bottom"></div>
    </div>
</div>
<?php get_footer(); ?> 