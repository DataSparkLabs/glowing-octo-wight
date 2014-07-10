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
        add_action( 'init', array(&$this, 'init'));  
        add_action('wp_enqueue_scripts', array(&$this, 'wp_enqueue_scripts'));
        
        add_action('wp_ajax_fs_get_visitor', array(&$this, 'get_visitor'));
        add_action('wp_ajax_nopriv_fs_get_visitor', array(&$this, 'get_visitor'));
        
        add_action('wp_ajax_fs_page_view', array(&$this, 'page_view'));
        add_action('wp_ajax_nopriv_fs_page_view', array(&$this, 'page_view'));
        
        add_action('wp_ajax_fs_form_view', array(&$this, 'form_view'));
        add_action('wp_ajax_nopriv_fs_form_view', array(&$this, 'form_view'));
        
        add_action('wp_ajax_fs_form_update', array(&$this, 'form_update'));
        add_action('wp_ajax_nopriv_fs_form_update', array(&$this, 'form_update'));
        
        add_action('wp_ajax_fs_form_complete', array(&$this, 'form_complete'));
        add_action('wp_ajax_nopriv_fs_form_complete', array(&$this, 'form_complete'));
    }
    function init()
    {
        
    }
    function wp_enqueue_scripts()
    {
        global $fs_forms_url;
        $website = get_option('website_id');
        if(strlen($website)>0)
        {
            wp_enqueue_script('fs-analytics-controller-script.js', $fs_forms_url . 'Analytics/fs-analytics-controller-script.js', array('jquery'));
            wp_localize_script('fs-analytics-controller-script.js', 'FsCurrentAnalytics', array(  
                'FsAjax' => admin_url( 'admin-ajax.php' )
            ));
        }
    }
    
    function ga_parse_cookie() 
    {
        if (isset($_COOKIE['_ga'])) 
        {
	    list($version,$domainDepth, $cid1, $cid2) = split('[\.]', $_COOKIE["_ga"],4);
	    $contents = array('version' => $version, 'domainDepth' => $domainDepth, 'cid' => $cid1.'.'.$cid2);
            $cid = $contents['cid'];
        }
        //else $cid = gaGenUUID();
        return $cid;
    }
    public function get_visitor()
    {
        global $wpdb;
        try
        {
            $website = get_option('website_id');
            if(strlen($website)==0)
            {
                throw new Exception('Invalid Website!');
            }
            $visitor = FsForms::GetVisitor();
            if(strlen($visitor)==0)
            {            
                $fields = array(
                    'function' => 'process_visitor', 
                    'website' => $website,
                    'address' => $_SERVER['REMOTE_ADDR'], 
                    'referer' => $_POST['referer'],
                    'request' => $_POST['request'],
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'google_cid' => $_POST['google_cid']
                );
                $json = FsForms::CurlPost(FsForms::get_nibbler(), $fields);
                $schema = json_decode($json);
                $visitor = $schema->recnum;
                setcookie('FsVisitorId', $visitor, time() + 60 * 60 * 24 * 30, '/');  
            }
            
            echo $visitor;
            
        } 
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }
        die();
    }
    public function page_view()
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
            $fields = array(
                'function' => 'process_page_view', 
                'website' => $website,
                'visitor' => $visitor,
                'address' => $_SERVER['REMOTE_ADDR'], 
                'referer' => $_POST['referer'],
                'request' => $_POST['request'],
                'google_cid' => $_POST['google_cid']
             );
             $json = FsForms::CurlPost(FsForms::get_nibbler(), $fields);
             echo $json;            
        } 
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }
        die();
    }
    
    public function form_view()
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
            $fields = array(
                'function' => 'process_form_view', 
                'website' => $website,
                'visitor' => $visitor,
                'address' => $_SERVER['REMOTE_ADDR'], 
                'referer' => $_POST['referer'],
                'request' => $_POST['request'],
                'form' => $_POST['form']
            );
            $json = FsForms::CurlPost(FsForms::get_nibbler(), $fields);
            echo $json;            
        } 
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }
        die();
    }
    
    public function form_update()
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
            $fields = array(
                'function' => 'process_form_update', 
                'website' => $website,
                'visitor' => $visitor,
                'address' => $_SERVER['REMOTE_ADDR'], 
                'referer' => $_POST['referer'],
                'request' => $_POST['request'],
                'field' => $_POST['field'],
                'value' => $_POST['value']
             );
             $json = FsForms::CurlPost(FsForms::get_nibbler(), $fields);
             echo $json;            
        } 
        catch (Exception $ex)
        {
            echo $ex->getMessage();
        }
        die();
    }
        
}