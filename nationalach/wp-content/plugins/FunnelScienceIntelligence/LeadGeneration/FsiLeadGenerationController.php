<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LeadTrackingController
 *
 * @author rudyard
 */

require_once 'FsiLeadFormProcessor.php';
require_once 'FsiLeadFormView.php';
require_once 'FsiIfByPhoneProcessor.php';
require_once 'FsiManageLeadForms.php';
require_once 'FsiManageLeads.php';
require_once 'FsiAdminAjaxActions.php';
require_once 'FsiClientAjaxActions.php';

class FsiLeadGenerationController {
    
    private $admin_ajax_actions = null;
    private $client_ajax_actions = null;
    private $manage_lead_forms = null;
    private $manage_leads = null;
    private $lead_form_view = null;
    
    public function FsiLeadGenerationController()
    {                
        add_action( 'init', array(&$this, 'init'));      
        add_action('wp_enqueue_scripts', array(&$this, 'wp_enqueue_scripts'));
        add_action('admin_enqueue_scripts', array(&$this, 'admin_enqueue_scripts'));
    }
    function init()
    {
        if( is_admin() )
        {
            $this->admin_ajax_actions = new FsiAdminAjaxActions();
            $this->client_ajax_actions = new FsiClientAjaxActions();
            $this->manage_lead_forms = new FsiManageLeadForms();
            $this->manage_leads = new FsiManageLeads();
        }
        else
        {
            $this->lead_form_view = new FsiLeadFormView();
        }
    }
    function wp_enqueue_scripts()
    {
        global $fsi_url;
        wp_enqueue_style('lead-tracking-frontend-style.css', $fsi_url.'LeadGeneration/lead-tracking-frontend-style.css');
        
    }
    function admin_enqueue_scripts()
    {
        global $fsi_url;
        wp_enqueue_style('lead-tracking-backend-style.css', $fsi_url.'LeadGeneration/lead-tracking-backend-style.css');
    }
   
    
    
}

?>
