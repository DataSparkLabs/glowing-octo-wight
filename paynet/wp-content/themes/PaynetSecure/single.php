<?php get_header(); ?>
<div id="content">
    <div class="inner">
        <div class="sidebar">
            <ul>
                <?php dynamic_sidebar('Blog Sidebar') ?>
            </ul>
        </div>
        <div class="content-left">
            <?php while (have_posts()) : the_post(); ?>
            <div class="blog-post">
                <h3><?php the_title(); ?></h3>
                <div class="blog-meta">
                    <div class="meta-block">
                        <img src="<?php bloginfo('template_url'); ?>/images/cal.gif" />
                        <?php echo get_the_date(); ?>
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
                <p><a href="https://plus.google.com/110803138752037680972?rel=author">Google+</a></p>
            </div>
            <?php endwhile;?>
        </div>
    </div>
</div>
<?php get_footer(); ?> 