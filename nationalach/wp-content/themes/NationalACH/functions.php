<?php

include 'data/GallerySlide.php';
include 'admin/GalleryManager.php';
include 'widgets/ContactWidget.php';
include 'views/OnlineAppView.php';

show_admin_bar(false);
add_theme_support('post-thumbnails');
set_post_thumbnail_size(150, 9999);
register_nav_menus(array('header-menu' => 'Header Menu', 'footer-menu' => 'Footer Menu'));
register_sidebar(array('name' => 'Page Sidebar'));

add_action("admin_menu", "setup_theme_admin_menus");
add_action('admin_enqueue_scripts', 'theme_option_enqueue_scripts');

function setup_theme_admin_menus() {
    add_submenu_page('themes.php', 'Gallery Manager', 'Gallery Manager', 'manage_options', 'gallery-manager', 'gallery_manager');
}

function theme_option_enqueue_scripts($suffix) {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_script('my-upload');
    wp_enqueue_style('thickbox');
}

function gallery_manager() {
    $manager = new GalleryManager();
    $manager->Render();
}

function the_breadcrumb() {
    echo '<a href="';
    echo get_option('home');
    echo '">Home</a>';
    if (!is_front_page()) {
        if (is_home()) {
            echo " » ACH Blog ";
        }
        if (is_category() || is_single()) {
            echo " » ";
            the_category('title_li=');
            if (is_single()) {
                echo " » ";
                the_title();
            }
        } else if (is_page()) {
            echo " » ";
            the_title();
        }
    }
}

class ACHNavMenuWalker extends Walker {
	/**
	 * @see Walker::$tree_type
	 * @since 3.0.0
	 * @var string
	 */
	var $tree_type = array( 'post_type', 'taxonomy', 'custom' );

	/**
	 * @see Walker::$db_fields
	 * @since 3.0.0
	 * @todo Decouple this.
	 * @var array
	 */
	var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<div class=\"sub-menu-container\"><div class=\"sub-menu-header\"></div><ul class=\"sub-menu\">\n";
	}

	/**
	 * @see Walker::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul><div class=\"sub-menu-footer\"></div></div>\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Page data object. Not used.
	 * @param int $depth Depth of page. Not Used.
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		$output .= "</li>\n";
	}
	
}

function get_rates_table($atts) {
	$url = home_url();
	$somethint = '<a href="' .$url .'/services/ach-processing/"">something</a>';
		$table = '<table>
				<tr>
					<th>SERVICE
					</th>
					<th>FEATURES
					</th>
					<th>BENEFITS
					</th>
					<th>RATE RANGE
					</th>
				</tr>

				<tfoot>
					<tr>
						<td colspan="4"></td>
					</tr>
				</tfoot>
				<tr>
					<td>						
						<a href="' .$url .'/services/ach-processing/">ACH Payments</a>
					</td>
					<td>
						<ul>
							<li>ACH debits</li>
							<li>ACH credits</li>
							<li>One time and recurring payments</li>
						</ul>
					</td>
					<td>
						<ul>
							<li>Get Your Money Faster Automate Cash Flow</li>
							<li>Receive/send funds easily</li>
							<li>Automation increases profits</li>
						</ul>
					</td>
					<td>Per transaction 25-65 cents
					</td>
				</tr>
				<tr>
					<td>
						<a href="' .$url .'/services/ach-processing/">Electronic Checks</a>
					</td>
					<td>
						<ul>
							<li>Accept echecks online</li>
							<li>Take checks by phone, mail or fax</li>
							<li>Recurring payments included</li>
							<li>Easy integration to your checkout page</li>
						</ul>
					</td>
					<td>
						<ul>
							<li>Increase sales up to 20%</li>
							<li>Get new customers</li>
							<li>Expanded payment options boost business</li>
							<li>Competitive advantage</li>
						</ul>
					</td>
					<td>Per transaction 35-45 cents 
						Discount rate 0.5% – 1.5% 
						(flat rate pricing also available)
					</td>
				</tr>
				<tr>
					<td>
						<a href="' .$url .'/services/high-risk-processing/">High Risk Merchant Accounts</a>
					</td>
					<td>
						<ul>
							<li>Alternative to card payments</li>
							<li>Easier to obtain than card accounts</li>
							<li>All high risk accepted</li>
						</ul>
					</td>
					<td>
						<ul>
							<li>Fast approval</li>
							<li>Get more orders</li>
							<li>Save money compared to card rates</li>
							<li>Perfect for subscriptions & membership</li>
						</ul>
					</td>
					<td>Per transaction 25-50 cents
						Discount rate
						1.95%-2.95%
						(flat rate pricing also available)
					</td>
				</tr>
				<tr>
					<td>
						<a href="' .$url .'/services/international-payments/">International Payments</a>
					</td>
					<td>
						<ul>
							<li>Localized payments</li>
							<li>Customize country coverage</li>
							<li>Save money on foreign exchange conversion</li>
							<li>Settle in any currency</li>
						</ul>
					</td>
					<td>
						<ul>
							<li>Expand target markets</li>
							<li>Increase sales up to 40%</li>
							<li>No chargebacks </li>
							<li>Trusted & familiar payment expands profits.</li>
						</ul>
					</td>
					<td>Based on chosen countries.  
						Call today to get your free quotation.
					</td>
				</tr>
			</table>';

			return $table;

	}

 add_shortcode('ratestable', 'get_rates_table');

?>
