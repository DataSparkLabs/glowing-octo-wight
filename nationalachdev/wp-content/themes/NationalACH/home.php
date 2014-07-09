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
                <?php while (have_posts()) : the_post(); ?> 
                <div class="excerpt">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="meta">
                        <div class="meta-block">
                            <img src="<?php bloginfo('template_url'); ?>/images/cal.gif" />
                            <?php the_date(); ?>
                        </div>
                        <div class="meta-block">
                            <img src="<?php bloginfo('template_url'); ?>/images/user.gif" />
                            <?php the_author();?>
                        </div>
                        <div class="meta-block">
                            <img src="<?php bloginfo('template_url'); ?>/images/cat.gif" />
                            <?php the_category(', ');?>
                        </div>
                    </div>
                    <?php
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail();
                        } 
                    ?>
                    <?php the_excerpt(); ?>                                
                    <p><a href="<?php the_permalink();?>">Read More...</a></p>
                </div>
                <?php endwhile;?>
                <?php wp_paginate(); ?>   
        </div>
        <div class="content-bottom"></div>
    </div>
</div>
<?php get_footer(); ?> 
