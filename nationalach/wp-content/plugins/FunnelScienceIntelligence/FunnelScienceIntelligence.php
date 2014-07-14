<?php
/**
 * @package Funnel Science Intelligence
 */
/*
  Plugin Name: Funnel Science Intelligence
  Plugin URI: http://www.funnelscience.com
  Description: Funnel Science in a Package
  Version: 0.4.0
  Author: Funnel Science
  Author URI: http://www.funnelscience.com
  License:
 */

require_once(ABSPATH."wp-includes/class-phpmailer.php");
if (!class_exists('SerializedObject'))
{
    require_once 'lib/Pear/SerializedObject.php';
}
require_once 'Data/FsiOption.php';
require_once 'Data/FsiLead.php';
require_once 'Data/FsiLeadForm.php';
require_once 'Data/FsiLeadFormField.php';

require_once 'DynamicContent/FsiDynamicContent.php';
require_once 'LeadGeneration/FsiLeadGenerationController.php';
require_once 'PhoneTracking/FsiPhoneTrackingController.php';

/*set_site_transient('update_plugins', null);
add_filter('plugins_api_result', 'aaa_result', 10, 3);
function aaa_result($res, $action, $args) {
    echo 'debug';
	print_r($res);
	return $res;
}*/

class FunnelScienceIntelligence
{

    private $api_url = 'http://updater.funnelscience.com/';
    private $plugin_slug;
    private $dynamic_content;
    private $lead_generation_controller;
    private $phone_tracking_controller;
    
    public function FunnelScienceIntelligence()
    {
        global $fsi_url;
        $fsi_url = plugins_url() . '/FunnelScienceIntelligence/';
        $this->plugin_slug = basename(dirname(__FILE__));
        add_action('admin_menu', array(&$this, 'create_menus'));
        add_action('wp_enqueue_scripts', array(&$this, 'wp_enqueue_scripts'));
        add_action('admin_enqueue_scripts', array(&$this, 'admin_enqueue_scripts'));
        add_filter('plugins_api', array(&$this, 'plugin_api_call'), 10, 3);
        add_filter('pre_set_site_transient_update_plugins', array(&$this, 'check_for_plugin_update'));


        $this->dynamic_content = new FsiDynamicContent();
        $this->lead_generation_controller = new FsiLeadGenerationController();
        $this->phone_tracking_controller = new FsiPhoneTrackingController();
        register_activation_hook(__FILE__, array(&$this, 'plugin_activate'));
    }
   
    public function plugin_activate()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `fsi_leads` (
        `recnum` int(11) NOT NULL AUTO_INCREMENT,
        `date_created` datetime NOT NULL,
        `ip_address` varchar(50) NOT NULL,
        `type` int(11) NOT NULL,
        `form` int(11) NOT NULL,
        `meta` text NOT NULL,
        PRIMARY KEY (`recnum`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;";
        mysql_query($sql);
        $sql = 'CREATE TABLE IF NOT EXISTS `fsi_lead_forms` (
        `recnum` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(50) NOT NULL,
        `from_address` varchar(50) NOT NULL,
        `to_addresses` text NOT NULL,
        `subject` varchar(50) NOT NULL,
        `finished_redirect` varchar(255) NOT NULL,
        `meta` text NOT NULL,
        PRIMARY KEY (`recnum`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;';
        mysql_query($sql);
        $sql = 'CREATE TABLE IF NOT EXISTS `fsi_lead_form_fields` (
        `recnum` int(11) NOT NULL AUTO_INCREMENT,
        `lead_form` int(11) NOT NULL,
        `name` varchar(50) NOT NULL,
        `type` int(11) NOT NULL,
        `position` int(11) NOT NULL,
        `meta` text NOT NULL,
        PRIMARY KEY (`recnum`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;';
        mysql_query($sql);
        $sql = 'CREATE TABLE IF NOT EXISTS `fsi_options` (
        `recnum` int(11) NOT NULL AUTO_INCREMENT,
        `date_updated` datetime NOT NULL,
        `name` varchar(50) NOT NULL,
        `value` text NOT NULL,
        PRIMARY KEY (`recnum`),
        UNIQUE KEY `key` (`name`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;';
        mysql_query($sql);
    }
    function wp_enqueue_scripts()
    {
        global $fsi_url;
        wp_enqueue_script('jquery.form.js', $fsi_url . 'lib/jquery.form.js', array('jquery'), '2.8.7');
        wp_enqueue_script('jquery.validate.min.js', $fsi_url . 'lib/jquery.validate.min.js', array('jquery', 'jquery.form.js'), '1.10.0');
        wp_enqueue_script('jquery.cacheimage.js', $fsi_url.'lib/jquery.cacheimage.js', array('jquery'), '0.2.1');
        wp_enqueue_script('fsi-global.js', $fsi_url . 'lib/fsi-global.js', array('jquery', 'jquery.validate.min.js', 'jquery.cacheimage.js'));
        wp_localize_script('fsi-global.js', 'FsiGlobal', array( 'FsiUrl' => $fsi_url, 'AjaxUrl' => admin_url('admin-ajax.php')));
    }

    function admin_enqueue_scripts()
    {
        global $fsi_url;
        wp_enqueue_style('jquery.ui.custom.min.css', $fsi_url . 'lib/JQueryUI/css/Funnel-Science/jquery-ui-1.9.2.custom.min.css');
        wp_enqueue_style('jquery.dataTables.themeroller.css', $fsi_url . 'lib/DataTables/css/jquery.dataTables_themeroller.css');
        wp_enqueue_script('jquery.form.js', $fsi_url . 'lib/jquery.form.js', array('jquery'), '2.8.7');
        wp_enqueue_script('jquery.validate.min.js', $fsi_url . 'lib/jquery.validate.min.js', array('jquery', 'jquery.form.js'), '1.10.0');
        wp_enqueue_script('jquery.ui.custom.min.js', $fsi_url . 'lib/JQueryUI/js/jquery-ui-1.9.2.custom.min.js', array('jquery'), '1.9.2');
        wp_enqueue_script('jquery.dataTables.min.js', $fsi_url . 'lib/DataTables/js/jquery.dataTables.min.js', array('jquery', 'jquery.ui.custom.min.js'), '1.9.4');
    }

    function create_menus()
    {
        add_menu_page('Funnel Science Intelligence', 'FS Intelligence', 'manage_options', 'fsi-main', array(&$this, 'fsi_main_page'), plugins_url() . '/FunnelScienceIntelligence/images/funnel-icon.png');
        add_submenu_page('fsi-main', 'FSI Options', 'Options', 'manage_options', 'fsi-options', array(&$this, 'fsi_options_page'));
    }

    function fsi_main_page()
    {
        if (!current_user_can('manage_options'))
        {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
        ?>
        <div class="wrap">
            <h2>Funnel Science Intelligence</h2>
        </div>
        <?php
    }

    function fsi_options_page()
    {
        if (!current_user_can('manage_options'))
        {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }
        ?>
        <div class="wrap">
            <h2>Funnel Science Options</h2>
            <?php
            if (isset($_POST["edit_options"]))
            {
                $option = FsiOption::GetOption(FsiOption::$IfByPhoneValidNumbers);
                $option->value = esc_attr($_POST["ifbyphone_valid_numbers"]);
                $option->Store();
                $option = FsiOption::GetOption(FsiOption::$IfByPhonePublicKey);
                $option->value = esc_attr($_POST["ifbyphone_public_key"]);
                $option->Store();
                $option = FsiOption::GetOption(FsiOption::$IfByPhoneKeywordSet);
                $option->value = esc_attr($_POST["ifbyphone_keyword_set"]);
                $option->Store();
                $option = FsiOption::GetOption(FsiOption::$SmtpServer);
                $option->value = esc_attr($_POST["smtp_server"]);
                $option->Store();
                $option = FsiOption::GetOption(FsiOption::$SmtpUser);
                $option->value = esc_attr($_POST["smtp_user"]);
                $option->Store();
                $option = FsiOption::GetOption(FsiOption::$SmtpPassword);
                $option->value = esc_attr($_POST["smtp_password"]);
                $option->Store();
                $option = FsiOption::GetOption(FsiOption::$SmtpPort);
                $option->value = esc_attr($_POST["smtp_port"]);
                $option->Store();
            }
            ?>
            <form method="POST" action="">  
                <input type="hidden" name="edit_options" value="Y" />  
                <table class="form-table">                      
                    <tr valign="top">  
                        <th scope="row">  
                            <label for="ifbyphone_valid_numbers">  
                                IfByPhone Valid Numbers (seperated by comma):
                            </label>   
                        </th>  
                        <td>  
        <?php $option = FsiOption::GetOption(FsiOption::$IfByPhoneValidNumbers); ?>
                            <input type="text" name="ifbyphone_valid_numbers" value="<?php echo $option->value; ?>" size="40" />  
                        </td>  
                    </tr>  
                    <tr valign="top">  
                        <th scope="row">  
                            <label for="ifbyphone_public_key">  
                                IfByPhone Public Key:
                            </label>   
                        </th>  
                        <td>  
        <?php $option = FsiOption::GetOption(FsiOption::$IfByPhonePublicKey); ?>
                            <input type="text" name="ifbyphone_public_key" value="<?php echo $option->value; ?>" size="40" />  
                        </td>  
                    </tr>  
                    <tr valign="top">  
                        <th scope="row">  
                            <label for="ifbyphone_keyword_Set">  
                                IfByPhone Keyword Set:
                            </label>   
                        </th>  
                        <td>  
        <?php $option = FsiOption::GetOption(FsiOption::$IfByPhoneKeywordSet); ?>
                            <input type="text" name="ifbyphone_keyword_set" value="<?php echo $option->value; ?>" size="40" />  
                        </td>  
                    </tr>  
                    <tr valign="top">  
                        <th scope="row">  
                            <label for="smtp_server">  
                                SMTP Server:
                            </label>   
                        </th>  
                        <td>  
        <?php $option = FsiOption::GetOption(FsiOption::$SmtpServer); ?>
                            <input type="text" name="smtp_server" value="<?php echo $option->value; ?>" size="40" />  
                        </td>  
                    </tr>  
                    <tr valign="top">  
                        <th scope="row">  
                            <label for="smtp_server">  
                                SMTP User:
                            </label>   
                        </th>  
                        <td>  
        <?php $option = FsiOption::GetOption(FsiOption::$SmtpUser); ?>
                            <input type="text" name="smtp_user" value="<?php echo $option->value; ?>" size="40" />  
                        </td>  
                    </tr>  
                    <tr valign="top">  
                        <th scope="row">  
                            <label for="smtp_password">  
                                SMTP Password:
                            </label>   
                        </th>  
                        <td>  
        <?php $option = FsiOption::GetOption(FsiOption::$SmtpPassword); ?>
                            <input type="text" name="smtp_password" value="<?php echo $option->value; ?>" size="40" />  
                        </td>  
                    </tr>  
                    <tr valign="top">  
                        <th scope="row">  
                            <label for="smtp_port">  
                                SMTP Port:
                            </label>   
                        </th>  
                        <td>  
        <?php $option = FsiOption::GetOption(FsiOption::$SmtpPort); ?>
                            <input type="text" name="smtp_port" value="<?php echo $option->value; ?>" size="40" />  
                        </td>  
                    </tr>  
                    <tr valign="top">  
                        <th scope="row">  
                        </th>  
                        <td>  
                            <input type="submit" value="Update" class="button-primary"/> 
                        </td>  
                    </tr> 
                </table>  

            </form>  
        </div>
        <?php
    }

    function check_for_plugin_update($checked_data)
    {
        //Comment out these two lines during testing.
        if (empty($checked_data->checked))
        {
            return $checked_data;
        }

        $args = array(
            'slug' => $this->plugin_slug,
            'version' => $checked_data->checked[$this->plugin_slug . '/' . $this->plugin_slug . '.php'],
        );
        $request_string = array(
            'body' => array(
                'action' => 'basic_check',
                'request' => serialize($args),
                'api-key' => md5(get_bloginfo('url'))
            ),
            'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
        );

        // Start checking for an update
        $raw_response = wp_remote_post($this->api_url, $request_string);

        if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
        {
            $response = unserialize($raw_response['body']);
        }
        
        if (is_object($response) && !empty($response)) // Feed the update data into WP updater
        {
            $checked_data->response[$this->plugin_slug . '/' . $this->plugin_slug . '.php'] = $response;
        }

        return $checked_data;
    }

// Take over the Plugin info screen

    function plugin_api_call($def, $action, $args)
    {
        if ($args->slug != $this->plugin_slug)
        {
            return false;
        }
        // Get the current version
        $plugin_info = get_site_transient('update_plugins');
        $current_version = $plugin_info->checked[$this->plugin_slug . '/' . $this->plugin_slug . '.php'];
        $args->version = $current_version;

        $request_string = array(
            'body' => array(
                'action' => $action,
                'request' => serialize($args),
                'api-key' => md5(get_bloginfo('url'))
            ),
            'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
        );

        $request = wp_remote_post($this->api_url, $request_string);

        if (is_wp_error($request))
        {
            $res = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
        } 
        else
        {
            $res = unserialize($request['body']);

            if ($res === false)
            {
                $res = new WP_Error('plugins_api_failed', __('An unknown error occurred'), $request['body']);
            }
        }

        return $res;
    }

}

$fsi = new FunnelScienceIntelligence();
?>