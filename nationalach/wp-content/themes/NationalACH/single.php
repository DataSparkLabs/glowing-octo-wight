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
            <div class="excerpt">
                <?php if (have_posts()) while (have_posts()) : the_post(); ?>
                    <h1><?php the_title(); ?></h1>
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
                    <?php the_content(); ?>          
                    <p>
                    <?php if (function_exists('selfserv_shareaholic'))
                    {
                        selfserv_shareaholic();
                    } ?>
                    </p>
                    <div class="navigation">
                        <ol class="wp-paginate">
                            <li><?php previous_post_link('%link', 'Previous'); ?></li>
                            <li><?php next_post_link('%link', 'Next'); ?></li>
                        </ol>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <div class="content-bottom"></div>
    </div>
</div>
<?php get_footer(); ?> 