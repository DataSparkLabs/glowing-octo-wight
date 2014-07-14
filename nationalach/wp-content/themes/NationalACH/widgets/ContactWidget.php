<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContactWidget
 *
 * @author rudyard
 */
class ContactWidget extends WP_Widget
{
    function ContactWidget()
    {
        // Instantiate the parent object
        parent::__construct(false, 'Contact Widget');
    }

    function widget($args, $instance)
    {
        ?><li class="widget contact-widget">
            <div class="contact-top-container">
                <div class="contact-header">GET MORE SALES</div>
                <div class="contact-sub-header">with eCommerce & MOTO Payment Solutions</div>
                <ul>
                    <li>ACH & EFT Payments</li>
                    <li>High Risk Industry Approved</li>
                    <li>International Electronic Transfers</li>
                </ul>
                <div class="contact-top-phone">
                    
                </div>
                <a class="request-demo" href="#"></a>
            </div>
            <div class="contact-bottom-container">
                <div class="contact-bottom-header">&raquo; NationalACH Product Demonstration</div>
                <div class="contact-bottom-sub">Requesting here, or call <?php echo do_shortcode('[fs_phone_route phone_route="16"]'); ?> for a demo.</div>
                <div class="norton-seal"><script type="text/javascript" src="https://seal.verisign.com/getseal?host_name=http://www.nationalach.com&amp;size=S&amp;use_flash=YES&amp;use_transparent=YES&amp;lang=en"></script></div>
                <?php echo do_shortcode('[fs_form form="83" privacy_url="'.get_bloginfo('url').'/privacy"]'); ?>
            </div>
            <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery("a.request-demo").click(function(){
                    jQuery(".contact-bottom-container").slideDown();
                    jQuery("a.request-demo").addClass("request-demo-black");
                    return false;
                });              
            });
            </script>
        </li>
        <?php
    }

    function update($new_instance, $old_instance)
    {
        // Save widget options
    }

    function form($instance)
    {
        // Output admin widget options form
    }
}
register_widget('ContactWidget');

?>
