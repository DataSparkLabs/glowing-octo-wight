<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RiskChartWidget
 *
 * @author rudyard
 */
class RiskChartWidget extends WP_Widget
{
   function RiskChartWidget()
    {
        // Instantiate the parent object
        parent::__construct(false, 'Risk Chart Widget');
    }

    function widget($args, $instance)
    {
        extract( $args );
        if ( isset( $instance[ 'rows' ] ) ) {
                $rows = $instance[ 'rows' ];
        }
        ?><li class="widget risk-chart-widget">
            <div class="risk-chart-header">
                Accept Online Payments from any web-enabled devise including smart phones, tablets, laptops, and desktops.
            </div>
            <div class="risk-chart-content">
                <table>
                    <tr><th class="not-accepted"></th><th class="accepted">US High Risk</th><th class="accepted">Offshore High Risk </th></tr>
                    <tr><td class="not-accepted">Discount rate</td><td class="accepted">2.75-4.5%</td><td class="accepted">3.5-6.95%</td></tr>
                    <tr><td class="not-accepted">Transaction</td><td class="accepted">0.25 – 0.30</td><td class="accepted">0 – 0.60</td></tr>
                    <tr><td class="not-accepted">Reserves</td><td class="accepted">0-10%</td><td class="accepted">5-10%</td></tr>
                    <tr><td class="not-accepted">Monthly</td><td class="accepted">10-20</td><td class="accepted">0-50</td></tr>
                    <tr><td class="not-accepted">Set Up</td><td class="accepted">$0</td><td class="accepted">$0-299</td></tr>
                    <tr><td class="not-accepted">Application</td><td class="accepted">FREE</td><td class="accepted">FREE</td></tr>

     
                </table>
            </div>
            <div class="risk-chart-footer">
                
            </div>
        </li>
        <?php
    }

   
}
register_widget('RiskChartWidget');

?>
