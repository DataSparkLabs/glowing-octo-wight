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


class TerminalSelectionView 
{
    public function TerminalSelectionView()
    {
        add_shortcode( 'TerminalSelectionView', array(&$this, 'GetRender' ));  
    }
    public function GetRender($atts)
    {
        extract( shortcode_atts( array(
            'contact_page' => '',
	), $atts ) );
        $str = '<div class="terminal-selection-view">
            <div id="wireless-terminal" class="selection-column">
                <div class="selection-header">
                    <span class="title">Mobile</span>
                    <span class="sub-title">Credit Card Processing</span>
                </div>
                <img class="terminal-image" src="'.get_bloginfo('template_url').'/images/wireless-terminal.png" />
                <p style="color: #f38400;">Wireless<br/>Credit Card<br/>Terminal</p>
                <p style="color: #878787; font-size: 12pt;">VARIES</p>
                <p>Wireless Fees</p>
                <div class="selection-row">Pin Debit<div class="selection-value">0.00% + .0.25</div></div>
                <div class="selection-row">Visa/MC Discover<div class="selection-value">1.58%</div></div>
                <div class="selection-row">Transaction Fee<div class="selection-value"></div></div>
                <div class="selection-row">Setup Fee<div class="selection-value"></div></div>
                <div class="selection-row">Cancellation Fee<div class="selection-value"></div></div>
                <div class="selection-row">Annual Fee<div class="selection-value"></div></div>
                <div class="selection-row">Batch Fee<div class="selection-value"></div></div>
                <div class="selection-row">Monthly Statement Fee<div class="selection-value"></div></div>
                <div class="selection-row">Monthly Wireless Fee<div class="selection-value"></div></div>
                <a href="'.$contact_page.'&reference=wireless-terminal" class="select-button"></a>
            </div>
            <div id="moto-terminal" class="selection-column">
                <div class="selection-header">
                    <span class="title">MOTO</span>
                    <span class="sub-title">Credit Card Processing</span>
                </div>
                <img class="terminal-image" src="'.get_bloginfo('template_url').'/images/moto-terminal.png" />
                <p style="color: #f38400;">MOTO<br/>Credit Card<br/>Terminal</p>
                <p style="color: #878787; font-size: 12pt;">VARIES</p>
                <p>Wireless Fees</p>
                <div class="selection-row">Pin Debit<div class="selection-value">0.00% + .0.25</div></div>
                <div class="selection-row">Visa/MC Discover<div class="selection-value">1.58%</div></div>
                <div class="selection-row">Transaction Fee<div class="selection-value"></div></div>
                <div class="selection-row">Setup Fee<div class="selection-value"></div></div>
                <div class="selection-row">Cancellation Fee<div class="selection-value"></div></div>
                <div class="selection-row">Annual Fee<div class="selection-value"></div></div>
                <div class="selection-row">Batch Fee<div class="selection-value"></div></div>
                <div class="selection-row">Monthly Statement Fee<div class="selection-value"></div></div>
                <div class="selection-row">Monthly Wireless Fee<div class="selection-value"></div></div>
                <a href="'.$contact_page.'&reference=moto-terminal" class="select-button"></a>
            </div>
            <div id="internet-terminal" class="selection-column">
                <div class="selection-header">
                    <span class="title">Internet</span>
                    <span class="sub-title">Credit Card Processing</span>
                </div>
                <img class="terminal-image" src="'.get_bloginfo('template_url').'/images/internet-terminal.png" />
                <p style="color: #f38400;">Virtual<br/>Credit Card<br/>Terminal</p>
                <p style="color: #878787; font-size: 12pt;">VARIES</p>
                <p>Wireless Fees</p>
                <div class="selection-row">Pin Debit<div class="selection-value">0.00% + .0.25</div></div>
                <div class="selection-row">Visa/MC Discover<div class="selection-value">1.58%</div></div>
                <div class="selection-row">Transaction Fee<div class="selection-value"></div></div>
                <div class="selection-row">Setup Fee<div class="selection-value"></div></div>
                <div class="selection-row">Cancellation Fee<div class="selection-value"></div></div>
                <div class="selection-row">Annual Fee<div class="selection-value"></div></div>
                <div class="selection-row">Batch Fee<div class="selection-value"></div></div>
                <div class="selection-row">Monthly Statement Fee<div class="selection-value"></div></div>
                <div class="selection-row">Monthly Wireless Fee<div class="selection-value"></div></div>
                <a href="'.$contact_page.'&reference=internet-terminal" class="select-button"></a>
            </div>
        </div>';
        return $str;
    }
      
}
$terminal_selection_view = new TerminalSelectionView();

?>
