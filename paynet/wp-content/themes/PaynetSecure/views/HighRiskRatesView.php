<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HighRiskRatesView
 *
 * @author rudyard
 */
class HighRiskRatesView
{
    public function HighRiskRatesView()
    {
        add_shortcode( 'HighRiskRatesView', array(&$this, 'GetRender' ));  
    }
    public function GetRender($atts)
    {
        $str = '<div class="high-risk-rates-view">
            <div class="caption">
                Accept Online Payments from smart phones, tablets, laptops, desktops & MOTO Virtual Terminal.
            </div>
            <table class="rates" cellspacing="10px">
                <tr class="images"><td></td><td style="text-align: center;"><img src="'.get_bloginfo('template_url').'/images/states.png" /></td><td></td><td style="text-align: center;"><img src="'.get_bloginfo('template_url').'/images/offshore.png" /></td></tr>
                <tr><th class="first"></th><th>US High Risk</th><th class="space"></th><th>Offshore High Risk</th></tr>
                <tr class="alt"><td class="first">Discount Rate</td><td>2.75-4.5%</td><td class="space"></td><td>3.5-6.95%</td></tr>
                <tr><td class="first">Transaction</td><td>0.25-0.30</td><td class="space"></td><td>0-0.60</td></tr>
                <tr class="alt"><td class="first">Reserves</td><td>0-10%</td><td class="space"></td><td>5-10%</td></tr>
                <tr><td class="first">Monthly</td><td>10-20</td><td class="space"></td><td>0-50</td></tr>
                <tr class="alt"><td class="first">Set Up</td><td>$0</td><td class="space"></td><td>$0-299</td></tr>
                <tr><td class="first">Application</td><td>FREE</td><td class="space"></td><td>FREE</td></tr>
            </table>
        </div>';
        return $str;
    }
}
$high_risk_rates_view = new HighRiskRatesView();
?>
