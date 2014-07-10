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


class CreditCardAcceptanceView 
{
    public function CreditCardAcceptanceView()
    {
        add_shortcode( 'CreditCardAcceptance', array(&$this, 'GetRender' ));  
    }
    public function GetRender($atts)
    {
        $str = '<div class="credit-card-acceptance">
            <span class="title">Start Accepting Credit Cards</span>
            <div class="cc-content">
                Call us today at '.do_shortcode('[fs_phone_route phone_route="17"]').' or use the form to the right to get started.
            </div>
        </div>';
        return $str;
    }
      
}
$credit_card_acceptance = new CreditCardAcceptanceView();

?>
