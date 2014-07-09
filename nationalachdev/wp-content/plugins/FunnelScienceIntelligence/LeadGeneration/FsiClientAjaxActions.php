<?php

/**
 * Ajax callbacks for FSI client implementation.
 *
 * @author Rudyard Murdough
 */

class FsiClientAjaxActions
{
    public function FsiClientAjaxActions()
    {
        add_action('wp_ajax_fsi_process_lead_form', array(&$this, 'ProcessLeadForm'));
        add_action('wp_ajax_nopriv_fsi_process_lead_form', array(&$this, 'ProcessLeadForm'));
    }
       
    public function ProcessLeadForm()
    {
        global $wpdb;
        $processor = new FsiLeadFormProcessor();
        $processor->ProcessEmail();
        die();  
    }
}

?>
