<?php
/**
 * @package Funnel Science Forms
 */
/*
Plugin Name: Funnel Science Forms
Plugin URI: http://www.funnelscience.com
Description: Plugin for integration with the Funnel Science CRM
Version: 0.5.0
Author: Funnel Science
Author URI: http://www.funnelscience.com
License: 
*/
require_once 'wp_auto_update.php';
require_once 'Forms/FsFormView.php';
require_once 'PhoneTracking/FsPhoneController.php';
require_once 'Analytics/FsAnalyticsController.php';

class FsForms
{
    private static $plugin_slug = 'FsForms';
    private static $brand_prefix = 'FS';
    
    private $form_view = null;
    private $phone_controller = null;
    private $analytics_controller = null;
    
    function __construct()
    {
        global $fs_forms_url;
        $fs_forms_url = plugins_url() . '/'.self::$plugin_slug.'/';

        if(is_admin())
        {        
            add_action('admin_init', array(&$this, 'admin_init'));
            add_action('admin_menu', array(&$this, 'create_menus'));
        }  
        add_action('init', array(&$this, 'init'));     
        $this->form_view = new FsFormView();
        $this->phone_controller = new FsPhoneController();
        $this->analytics_controller = new FsAnalyticsController();
    }
    private static function get_crm_url()
    {
        $str = rtrim(get_option('crm_url'),'/');
        if(strlen($str)==0)
        {
            $str = 'http://crm.funnelscience.com';
        }
        $str .= '/';
        return $str;
    }

    public static function get_fry()
    {
        return self::get_crm_url().'fry.php';
    }
    
    function init()
    {
        $wptuts_plugin_current_version = '0.5.0';
        $wptuts_plugin_remote_path = 'http://crm.funnelscience.com/WPUpdater/index.php';
        $wptuts_plugin_slug = plugin_basename(__FILE__);
        $updater = new wp_auto_update ($wptuts_plugin_current_version, $wptuts_plugin_remote_path, $wptuts_plugin_slug);
        
        global $fs_forms_url;
        wp_enqueue_style('fs-forms-style.css', $fs_forms_url.'style/fs-forms-style.css'); 
        wp_enqueue_style('fs-form-view-style.css', $fs_forms_url.'style/fs-form-view-style.css');    
        wp_enqueue_style('jquery.ui.css', $fs_forms_url.'lib/jQueryUI/css/smoothness/jquery-ui-1.10.4.custom.min.css');  
        wp_enqueue_script('jquery.cookie.js', $fs_forms_url.'lib/jquery.cookie.js', array('jquery'));   
        wp_register_script('jquery.ui.js', $fs_forms_url.'lib/jQueryUI/js/jquery-ui-1.10.4.custom.min.js', array('jquery'));  
        wp_register_script('jquery.form.js', $fs_forms_url.'lib/jquery.form.js', array('jquery'));   
        wp_register_script('jquery.validate.min.js', $fs_forms_url.'lib/jquery.validate.min.js', array('jquery', 'jquery.form.js')); 
        wp_register_script('jquery.placeholder', $fs_forms_url.'lib/jquery.placeholder.js', array('jquery'), '2.0.7');
        wp_register_script('fs-ie-fix', $fs_forms_url.'script/fs-ie-fix.js', array('jquery.placeholder'), '0.1');
        
    }
    
    function create_menus()
    {
        add_menu_page( self::$brand_prefix.' Forms', self::$brand_prefix.' Forms', 'manage_options', 'fs-forms', array(&$this, 'forms_main_page')); 
        add_submenu_page('fs-forms', 'Options', 'Options', 'manage_options', 'fs-options', array(&$this, 'options_page'));
    }
    
    function options_page()
    {
        if (!current_user_can('manage_options'))
        {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
        ?>
        <div class="wrap">
	    <?php screen_icon(); ?>
	    <h2>Settings</h2>			
            <form method="post" action="options.php">
                <?php settings_fields( 'fs-forms-options' ); ?>
                <table class="form-table">
                    <tr valign="top">
                    <th scope="row">Website ID</th>
                    <td><input type="text" name="website_id" value="<?php echo get_option('website_id'); ?>" /></td>
                    </tr>                    
                   <tr valign="top">
                    <th scope="row">CRM Url</th>
                    <td><input type="text" name="crm_url" value="<?php echo get_option('crm_url'); ?>" /></td>
                    </tr>  
                    <tr valign="top">
                    <th scope="row">Fallback Phone</th>
                    <td><input type="text" name="fallback_phone" value="<?php echo get_option('fallback_phone'); ?>" /></td>
                    </tr>
                </table>

                <?php submit_button(); ?>

            </form>
	</div>
        <?php
        
    }
    function admin_init()
    {
        register_setting( 'fs-forms-options', 'website_id' );
        register_setting( 'fs-forms-options', 'crm_url' );
        register_setting( 'fs-forms-options', 'fallback_phone' );
    }
    
    function forms_main_page()
    {
        if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	?>
        <div class="wrap">
            <?php screen_icon('themes'); ?> <h2><?php echo self::$brand_prefix; ?> Forms</h2>
           
	</div>
        <?php
    }
    
    
    public static function CurlPost($url, $fields=array())
    {
            // Initiate the curl session
            $ch = curl_init();

            // Set the URL
            curl_setopt($ch, CURLOPT_URL, $url);

            // Removes the headers from the output
            curl_setopt($ch, CURLOPT_HEADER, 0);

            // Return the output instead of displaying it directly
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt ($ch, CURLOPT_POST, true);
            curl_setopt ($ch, CURLOPT_POSTFIELDS, $fields);
            // Execute the curl session
            $output = curl_exec($ch);

            // Close the curl session
            curl_close($ch);

            // Return the output as a variable
            return $output;
    }
    
    public static function GetVisitor()
    {
        $visitor = '';
        if(isset($_COOKIE['FsVisitorId']) && strlen($_COOKIE['FsVisitorId'])>0)
        {
            $visitor = $_COOKIE['FsVisitorId'];
        }
        return $visitor;
    }
    public static function GetSession()
    {
        $visitor = '';
        if(isset($_COOKIE['FsSessionId']) && strlen($_COOKIE['FsSessionId'])>0)
        {
            $visitor = $_COOKIE['FsSessionId'];
        }
        return $visitor;
    }
    public static function PostField($field)
    {
        $value = '';
        if(isset($_POST[$field]))
        {
            $value = $_POST[$field];
        }
        return $value;
    }
}

$p = new FsForms();
?>
