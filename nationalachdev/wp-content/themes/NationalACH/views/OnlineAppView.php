<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ContactView
 *
 * @author rudyard
 */
class OnlineAppView {
    public function __construct()
    {
        add_shortcode( 'OnlineAppView', array(&$this, 'RenderView' ));  
    }
    public function RenderView($atts)
    {
        $html = '<div class="online-app-view">
            '.do_shortcode('[fs_form form="84" privacy_url="'.get_bloginfo('url').'/privacy"]').'
        </div>';
        return $html;
    }
}
$view = new OnlineAppView();

?>
