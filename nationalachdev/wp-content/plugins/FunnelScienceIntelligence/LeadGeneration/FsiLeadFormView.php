<?php

/*
 * Generates the FSI Lead Form
 * Author: Rudyard Murdough
 */

class FsiLeadFormView
{
    public function FsiLeadFormView()
    {
        add_shortcode( 'lead_form', array(&$this, 'RenderLeadForm' ));   
    }
    
    function RenderLeadForm($atts)
    {
        global $fsi_url;
	extract( shortcode_atts( array(
		'name' => '',
	), $atts ) );
        $lead_form = FsiLeadForm::GetLeadFormByName($name);
        $html = '';
        if($lead_form != null)
        {
            $form_id = 'fsi-lead-form-'.$lead_form->recnum;
            $html = html_entity_decode($lead_form->meta->form_html);
            $html = str_replace('[form_action]', '<input type="hidden" name="action" value="fsi_process_lead_form"/>',$html);
            $html = str_replace('[from_page]', '<input type="hidden" name="from_page" value="'.$_SERVER['REQUEST_URI'].'" />', $html);
            $html = str_replace('[ip_address]', '<input type="hidden" name="ip_address" value="'.$_SERVER['REMOTE_ADDR'].'" />',$html);
            $html = str_replace('[reference]', '<input type="hidden" name="reference" value="'.$_GET["reference"].'" />',$html);            
            $html = str_replace('[honeypot]','<p style="display: none;"><input type="text" name="username" /></p>',$html);
            $html = str_replace('[recnum]','<input type="hidden" name="recnum" value="'.$lead_form->recnum.'" />',$html);
            $html = str_replace('[form_id]', $form_id,$html);
            $html = str_replace('[loader]', '<div class="fsi-loader" style="display: none;"></div>',$html);
            $html = $this->get_lead_form_submit_button($html,$form_id,$lead_form->recnum);
            
                  
            $form_fields = FsiLeadFormField::GetLeadFormFields($lead_form->recnum);
            $html .= '<script type="text/javascript">
                fsi_prep_validator();
                fsi_init_form_titles("fsi-lead-form-'.$lead_form->recnum.'");  
                jQuery("#'.$form_id.'").validate({
                rules: {';
            $rules = array();
            foreach($form_fields as $form_field)
            {
                $rule =  $form_field->name.': {';
                if($form_field->meta->required)
                {
                     $rule .= 'fsi_required: true';
                }
                $rule .= '}';
                $rules[] = $rule;
            }
            $html .= implode(',',$rules);
            $html .= '},
                messages: {';
            $messages = array();
            foreach($form_fields as $form_field)
            {
                if($form_field->meta->required)
                {
                    $messages[] = $form_field->name.': "*"';
                }
            }
            $html .= implode(',', $messages);
            $html .= '},
                submitHandler: function(form) {
                    jQuery(form).ajaxSubmit({
                            target: "#'.$form_id.' .result",
                            url: FsiGlobal.AjaxUrl,
                            beforeSubmit: function() {
                                jQuery("#fsi-lead-form-submit-'.$lead_form->recnum.'").hide();
                                jQuery("#'.$form_id.' div.fsi-loader").show();
                            },
                            success: function() {
                                jQuery("#'.$form_id.' div.fsi-loader").hide();
                                jQuery("#fsi-lead-form-submit-'.$lead_form->recnum.'").show();
                            }
                    });
                }
            });
            </script>';
        }
        
	return $html;
    }
    private function get_lead_form_submit_button($html,$form_id,$recnum)
    {
        $start = strpos($html,'[submit_button');
        $end = strpos($html,']', $start);
        if($start != false && $end != false)
        {
            $title = '';
            $shortcode = substr($html, $start, ($end-$start)+1);
            if(strpos($shortcode, 'title') != false)
            {
                $start = strpos($shortcode,'title');
                $start = strpos($shortcode, '"',$start);
                $end = strpos($shortcode,'"',$start+1);
                $title = substr($shortcode,$start+1, ($end-$start)-1);
            }
            $submit_button = '<a href="#" id="fsi-lead-form-submit-'.$recnum.'" class="fsi-lead-form-submit">'.$title.'</a>';
            $submit_button .= '<script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery("#fsi-lead-form-submit-'.$recnum.'").click(function(){
                    jQuery("#'.$form_id.'").submit();
                    return false;
                });                
            });
            </script>';
            $html = str_replace($shortcode, $submit_button,$html);   
        }
           
        return $html;
    }
}

?>
