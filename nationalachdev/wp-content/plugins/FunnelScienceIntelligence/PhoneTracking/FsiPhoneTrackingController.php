<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FsiPhoneTrackingController
 *
 * @author rudyard
 */
class FsiPhoneTrackingController
{
    public function FsiPhoneTrackingController()
    {
        add_action( 'init', array(&$this, 'init'));   
        add_action('wp_enqueue_scripts', array(&$this, 'wp_enqueue_scripts'));
    }
    function init()
    {
        add_shortcode( 'ifbyphone_keyword_replacement', array(&$this, 'ifbyphone_keyword_replacement' ));   
    }
    function wp_enqueue_scripts()
    {
        global $fsi_url;
        $public_key = FsiOption::GetOption(FsiOption::$IfByPhonePublicKey);
        $keyword_set = FsiOption::GetOption(FsiOption::$IfByPhoneKeywordSet);
        if(strlen($public_key->value)>0 && strlen($keyword_set->value)>0)
        {
            wp_enqueue_script('ibp_clickto_referral.js', 'https://secure.ifbyphone.com/js/ibp_clickto_referral.js');
            wp_enqueue_script('ifbyphone_init.js', $fsi_url . 'PhoneTracking/ifbyphone_init.js', array('ibp_clickto_referral.js'));
            wp_localize_script('ifbyphone_init.js', 'IfByPhone', array( 'PublicKey' => $public_key->value, 'KeywordSet'=> $keyword_set->value));
        }
    }
    function ifbyphone_keyword_replacement($atts)
    {
        return '<script type="text/JavaScript" src="https://secure.ifbyphone.com/js/keyword_replacement.js"></script>';
    }
}

?>
