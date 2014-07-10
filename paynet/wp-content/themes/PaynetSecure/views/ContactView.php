<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductView
 *
 * @author rudyard
 */

class ContactView {
    public function ContactView()
    {
        add_shortcode( 'ContactView', array(&$this, 'RenderView' ));  
    }
    public function RenderView($atts)
    {
        $html = '<div class="contact-view">
            <h3>Contact Us</h3>
            <p>Call us at '.do_shortcode('[fs_phone_route phone_route="17"]').' or fill out the form below. We will respond within 24 hours of the next business day.</p>
            '.do_shortcode('[fs_form form="85" privacy_url="'.get_bloginfo('url').'/privacy-statement"]').'
        </div>';
        return $html;
    }
}
$view = new ContactView();

?>
