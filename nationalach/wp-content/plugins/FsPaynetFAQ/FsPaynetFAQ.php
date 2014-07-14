<?php
/*
Plugin Name: Funnel Science FAQ System
Plugin URI: http://funnelscience.com/
Description: Helps you create an FAQ section for your WordPress website. Shortcode usage: <code>[faq]</code>. Adopted from Tuts Plus Article http://code.tutsplus.com/tutorials/using-wordpress-to-create-a-faq-system-with-custom-post-types--cms-20062 
Version: 1.0
Author: Funnel Science
Author URI: http://funnelscience.com
License: Public Domain
*/
 
if ( ! function_exists( 'fs_faq_cpt' ) ) {
 
// register custom post type
    function faq_cpt() {
 
        // these are the labels in the admin interface, edit them as you like
        $labels = array(
            'name'                => _x( 'FAQs', 'Post Type General Name', 'faq' ),
            'singular_name'       => _x( 'FAQ', 'Post Type Singular Name', 'faq' ),
            'menu_name'           => __( 'FAQ', 'faq' ),
            'parent_item_colon'   => __( 'Parent Item:', 'faq' ),
            'all_items'           => __( 'All Items', 'faq' ),
            'view_item'           => __( 'View Item', 'faq' ),
            'add_new_item'        => __( 'Add New FAQ Item', 'faq' ),
            'add_new'             => __( 'Add New', 'faq' ),
            'edit_item'           => __( 'Edit Item', 'faq' ),
            'update_item'         => __( 'Update Item', 'faq' ),
            'search_items'        => __( 'Search Item', 'faq' ),
            'not_found'           => __( 'Not found', 'faq' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'faq' ),
        );
        $args = array(
            // use the labels above
            'labels'              => $labels,
            // we'll only need the title, the Visual editor and the excerpt fields for our post type
            'supports'            => array( 'title', 'editor', 'excerpt', ),
            // we're going to create this taxonomy in the next section, but we need to link our post type to it now
            'taxonomies'          => array( 'faq_tax' ),
            // make it public so we can see it in the admin panel and show it in the front-end
            'public'              => true,
            // show the menu item under the Pages item
            'menu_position'       => 20,
            // show archives, if you don't need the shortcode
            'has_archive'         => true,
        );
        register_post_type( 'faq', $args );
 
    }
 
    // hook into the 'init' action
    add_action( 'init', 'faq_cpt', 0 );
 
}
 
if ( ! function_exists( 'faq_tax' ) ) {
 
    // register custom taxonomy
    function faq_tax() {
 
        // again, labels for the admin panel
        $labels = array(
            'name'                       => _x( 'FAQ Categories', 'Taxonomy General Name', 'faq' ),
            'singular_name'              => _x( 'FAQ Category', 'Taxonomy Singular Name', 'faq' ),
            'menu_name'                  => __( 'FAQ Categories', 'faq' ),
            'all_items'                  => __( 'All FAQ Cats', 'faq' ),
            'parent_item'                => __( 'Parent FAQ Cat', 'faq' ),
            'parent_item_colon'          => __( 'Parent FAQ Cat:', 'faq' ),
            'new_item_name'              => __( 'New FAQ Cat', 'faq' ),
            'add_new_item'               => __( 'Add New FAQ Cat', 'faq' ),
            'edit_item'                  => __( 'Edit FAQ Cat', 'faq' ),
            'update_item'                => __( 'Update FAQ Cat', 'faq' ),
            'separate_items_with_commas' => __( 'Separate items with commas', 'faq' ),
            'search_items'               => __( 'Search Items', 'faq' ),
            'add_or_remove_items'        => __( 'Add or remove items', 'faq' ),
            'choose_from_most_used'      => __( 'Choose from the most used items', 'faq' ),
            'not_found'                  => __( 'Not Found', 'faq' ),
        );
        $args = array(
            // use the labels above
            'labels'                     => $labels,
            // taxonomy should be hierarchial so we can display it like a category section
            'hierarchical'               => true,
            // again, make the taxonomy public (like the post type)
            'public'                     => true,
        );
        // the contents of the array below specifies which post types should the taxonomy be linked to
        register_taxonomy( 'faq_tax', array( 'faq' ), $args );
 
    }
 
    // hook into the 'init' action
    add_action( 'init', 'faq_tax', 0 );
 
}
 
if ( ! function_exists( 'faq_shortcode' ) ) {
 
    function faq_shortcode( $atts ) {
        extract( shortcode_atts(
                array(
                    // category slug attribute - defaults to blank
                    'category' => '',
                    // full content or excerpt attribute - defaults to full content
                    'excerpt' => 'false',
                ), $atts )
        );
         
        $output = '';
         
        // set the query arguments
        $query_args = array(
            // show all posts matching this query
            'posts_per_page'    =>   -1,
            // show the 'faq' custom post type
            'post_type'         =>   'faq',
            // show the posts matching the slug of the FAQ category specified with the shortcode's attribute
            'tax_query'         =>   array(
                array(
                    'taxonomy'  =>   'faq_tax',
                    'field'     =>   'slug',
                    'terms'     =>   $category,
                )
            ),
            // tell WordPress that it doesn't need to count total rows - this little trick reduces load on the database if you don't need pagination
            'no_found_rows'     =>   true,
        );
         
        // get the posts with our query arguments
        $faq_posts = get_posts( $query_args );
        $output .= '<div class="faq">';
         
        // handle our custom loop
        foreach ( $faq_posts as $post ) {
            setup_postdata( $post );
            $faq_item_title = get_the_title( $post->ID );
            $faq_item_permalink = get_permalink( $post->ID );
            $faq_item_content = get_the_content();
            if( $excerpt == 'true' )
                $faq_item_content = get_the_excerpt() . '<a href="' . $faq_item_permalink . '">' . __( 'More...', 'faq' ) . '</a>';
             
            $output .= '<div class="faq-item">';
            $output .= '<h2 class="faq-item-title">' . $faq_item_title . '</h2>';
            $output .= '<div class="faq-item-content">' . $faq_item_content . '</div>';
            $output .= '</div>';
        }
         
        wp_reset_postdata();
         
        $output .= '</div>';
         
        return $output;
    }
 
    add_shortcode( 'faq', 'faq_shortcode' );
 
}
 
function faq_activate() {
    faq_cpt();
    flush_rewrite_rules();
}
 
register_activation_hook( __FILE__, 'faq_activate' );
 
function faq_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'faq_deactivate' );
 
?>