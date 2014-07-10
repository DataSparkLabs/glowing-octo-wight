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
            <div id="contact-top-container">
                <div class="caption">Request More Information</div>
                <div class="instruction">Fill out the information below and we will contact you shortly.</div>
                <a id="request-info-button" href="#"></a>
            </div>
            <div id="contact-bottom-container">
                <div class="contact-bottom-top">
                    <div class="contact-bottom-header">&raquo; Paynet Secure Product Demonstration</div>
                    <div class="contact-bottom-sub">Requesting a demo is easy!</div>
                </div>
                <div class="contact-bottom-middle">
                    <div class="norton-seal"><script type="text/javascript" src="https://seal.verisign.com/getseal?host_name=http://www.paynetsecure.net&amp;size=S&amp;use_flash=YES&amp;use_transparent=YES&amp;lang=en"></script></div>
                    <?php echo do_shortcode('[fs_form form="86" privacy_url="'.get_bloginfo('url').'/privacy-statement"]'); ?>
                </div>
                <div class="contact-bottom-bottom"></div>
            </div>
            <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery("li.contact-widget #request-info-button").click(function(){
                    jQuery("li.contact-widget").height("700");
                    jQuery("li.contact-widget #contact-bottom-container").slideDown();
                    jQuery("li.contact-widget a#request-info-button").hide();
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
