<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FsPhoneController
{
    public function __construct()
    {
        add_action( 'init', array(&$this, 'init'));  
        add_action('wp_enqueue_scripts', array(&$this, 'wp_enqueue_scripts'));
        add_action('wp_ajax_fs_get_phone', array(&$this, 'get_phone'));
        add_action('wp_ajax_nopriv_fs_get_phone', array(&$this, 'get_phone'));
    }
    function init()
    {
        add_shortcode( 'fs_phone_route', array(&$this, 'fs_phone_route' ));   
    }
    function wp_enqueue_scripts()
    {
        global $fs_forms_url;
        $website = get_option('website_id');
        if(strlen($website)>0)
        {
            wp_enqueue_script('fs-phone-controller-script.js', $fs_forms_url . 'PhoneTracking/fs-phone-controller-script.js', array('jquery'));
            wp_localize_script('fs-phone-controller-script.js', 'FsCurrentPhone', array(  
                'FsAjax' => admin_url( 'admin-ajax.php' )
            ));
        }
    }
    function fs_phone_route($atts)
    {
        extract( shortcode_atts( array(
                'phone_route' => ''
        ), $atts ) );
        return '<span class="fs-phone-route" data-phone-route="'.$phone_route.'">Loading...</span>';
    }
    
    public function get_phone()
    {
        global $wpdb;
        try
        {
            $website = get_option('website_id');
            if(strlen($website)==0)
            {
                throw new Exception('Invalid Website!');
            }
            $visitor = FsForms::PostField('visitor');
            if(strlen($visitor)==0)
            {
                throw new Exception('Invalid Visitor!');   
            }
            $phone_route = FsForms::PostField('phone_route');
            if(strlen($phone_route)==0)
            {
                throw new Exception('Invalid Phone Route!');   
            }
            $fields = array('function' => 'get_route_number', 'phone_route' => $phone_route, 'visitor' => $visitor);
            $json = FsForms::CurlPost(FsForms::get_leela(), $fields);
            $obj = json_decode($json);
            if(strlen($obj->error)>0)
            {
                echo "(".$obj->error.")";
            }
            else
            {
                echo $obj->number;
            }
            
            
        } 
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }
        die();
    }
    
    function format_phone($phone)
    {
        $phone = preg_replace("/[^0-9]/", "", $phone);

        if(strlen($phone) == 7)
        {
            $phone = preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
        }
        elseif(strlen($phone) >= 10)
        {
            $phone = preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
        }
        return $phone;
    }
}