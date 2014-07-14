<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FsAnalyticsController
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array(&$this, 'wp_enqueue_scripts'));
        

    }
   
    function wp_enqueue_scripts()
    {
        global $fs_forms_url;
        $website = get_option('website_id');
        if(strlen($website)>0)
        {
            wp_enqueue_script('fs-analytics-controller-script.js', $fs_forms_url . 'Analytics/fs-analytics-controller-script.js', array('jquery','jquery.cookie.js'));
            wp_localize_script('fs-analytics-controller-script.js', 'FsCurrentAnalytics', array(  
                'Website' => $website
            ));
        }
    }
        
}