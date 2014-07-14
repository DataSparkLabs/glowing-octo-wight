<?php

/*
 * Generates the FS Form
 * Author: Rudyard Murdough
 */
class FsFormViewValue
{
    public $name;
    public $value;
}
class FsFormView
{
    private static $TextInputType = 1;
    private static $TextAreaType = 2;
    private static $CheckInputsType = 3;
    private static $RadioInputsType = 4;
    private static $DateInputType = 5;
    private static $FileInputType = 6;
    private static $SelectInputType = 7;
    
    public static $InsideLabelType = 1;
    public static $OutsideLabelType = 2;
    
    private $template = null;
    private $calendar = null;
    private $required_marker;
    
    public function __construct()
    {
        add_shortcode( 'fs_form', array(&$this, 'RenderForm' ));  
        add_action('wp_ajax_fs_process_form', array(&$this, 'process_form'));
        add_action('wp_ajax_nopriv_fs_process_form', array(&$this, 'process_form'));
        add_action('wp_ajax_load_scheduler_slots', array(&$this, 'load_scheduler_slots'));
        add_action('wp_ajax_nopriv_load_scheduler_slots', array(&$this, 'load_scheduler_slots'));
    }
    
    function RenderForm($atts)
    {        
	extract( shortcode_atts( array(
            'form' => '',
            'privacy_url' => '',
            'submit_label' => 'Submit',
            'submit_callback' => '',
            'meta' => '',
            'values' => '',
            'required_marker' => '*',
            'send_to_address' => ''
	), $atts ) );
        
        global $fs_forms_url;
        
        global $is_IE;
        
        $this->required_marker = $required_marker;
        
        wp_enqueue_script('jquery.ui.js');  
        wp_enqueue_script('jquery.form.js');   
        wp_enqueue_script('jquery.validate.min.js');   
        wp_enqueue_script('fs-form-view-script.js', $fs_forms_url.'Forms/fs-form-view-script.js', array('jquery', 'jquery.form.js', 'jquery.validate.min.js'));
        wp_localize_script('fs-form-view-script.js', 'FsFormView', array(  
            'FsAjax' => admin_url( 'admin-ajax.php' )
        ));
        if ( $is_IE ) 
        {
            wp_enqueue_script('jquery.placeholder');
            wp_enqueue_script('fs-ie-fix');
        }
        $fields = array (
            "function" => "get_form_schema",
            "form" => $form,
        );
        $json = FsForms::CurlPost(FsForms::get_fry(), $fields);
        $schema = json_decode($json);
        
        $this->template = null;
        if($schema->template != null)
        {
            $this->template = $schema->template;
        }
        $this->calendar = null;
        if($schema->calendar != null)
        {
            $this->calendar = $schema->calendar;
        }
        $html = '';
        if($schema->calendar == null)
        {
            $html .= $this->render_form($schema, $meta, $privacy_url, $submit_label, $schema->redirect, $send_to_address);
        }
        else
        {
            $html .= '<div class="fs-scheduler-container" data-calendar="'.$schema->calendar->recnum.'">
                <div class="fs-row">
                    <div class="fs-col fs-col-12">
                        <div class="fs-scheduler-calendar"></div>
                    </div>
                </div>';
                $html .= $this->render_scheduler_form($schema, $meta, $privacy_url, $submit_label, $schema->redirect, $send_to_address);
                
            $html.='</div>';
        }
        return $html;
    }
    private function render_form($schema, $meta, $privacy_url, $submit_label, $redirect, $send_to_address)
    {
        global $fs_form_view_values;
        $html = '<div id="fs-form-container-'.$schema->recnum.'" class="fs-form-container">';               
        $html .= '<form id="fs-form-'.$schema->recnum.'" action="'.admin_url( 'admin-ajax.php' ).'" method="post" class="fs-form" data-form="'.$schema->recnum.'" enctype="multipart/form-data">
            <input type="hidden" name="action" value="fs_process_form" />
            <input type="hidden" name="form" value="'.$schema->recnum.'" />
            <input type="hidden" name="ip_address" value="'.$_SERVER['REMOTE_ADDR'].'" />
            <input type="hidden" name="from_url" value="'.$_SERVER['REQUEST_URI'].'" />
            <input type="hidden" name="referer" value="'.$_SERVER['HTTP_REFERER'].'" />
            <input type="hidden" name="send_to_address" value="'.$send_to_address.'" />
            <input class="fs-redirect" type="hidden" name="redirect" value="'.$redirect.'" />
            <input type="hidden" name="meta" value="'.$meta.'" />
            <p style="display: none;">
                <input type="text" name="username" />
            </p>';        
            foreach($schema->fields as $field)
            {
                $value = null;
                if(isset($fs_form_view_values) && count($fs_form_view_values)>0)
                {                
                    foreach($fs_form_view_values as $v)
                    {
                        if($field->name == $v->name)
                        {
                            $value = $v;
                        }                
                    }
                }
                $html .= $this->render_field($field, $value);
            }                
            $html.='
        </form>
        
        <div class="fs-form-row fs-row">            
        ';
            $submit_col = 'fs-col-sm-12';
        if(strlen($privacy_url)>0)
        {
            $submit_col = 'fs-col-sm-7';
            $html .= '<div class="fs-col fs-col-sm-5 fs-col-privacy">
                <a class="fs-privacy-link" href="'.$privacy_url.'">Privacy Link</a>
                </div>';
        }
        $html.='            
            <div class="fs-col '.$submit_col.'">
                <a class="fs-form-submit" data-form="'.$schema->recnum.'" href="#">'.$submit_label.'</a>
            </div>
        </div>
        <div class="fs-loader fs-form-loader" data-form="'.$schema->recnum.'"></div>
        <div class="fs-form-row fs-form-result" data-form="'.$schema->recnum.'"></div>';
        $html .= '</div>';
        return $html;
    }
    private function render_scheduler_form($schema, $meta, $privacy_url, $submit_label, $redirect, $send_to_address)
    {
        global $fs_form_view_values;
        $html = '<div id="fs-form-container-'.$schema->recnum.'" class="fs-form-container">';               
        $html .= '<form id="fs-form-'.$schema->recnum.'" action="'.admin_url( 'admin-ajax.php' ).'" method="post" class="fs-form" data-form="'.$schema->recnum.'" enctype="multipart/form-data">
            <input type="hidden" name="action" value="fs_process_form" />
            <input type="hidden" name="form" value="'.$schema->recnum.'" />
            <input type="hidden" name="ip_address" value="'.$_SERVER['REMOTE_ADDR'].'" />
            <input type="hidden" name="from_url" value="'.$_SERVER['REQUEST_URI'].'" />
            <input type="hidden" name="referer" value="'.$_SERVER['HTTP_REFERER'].'" />
            <input type="hidden" name="send_to_address" value="'.$send_to_address.'" />
            <input class="fs-redirect" type="hidden" name="redirect" value="'.$redirect.'" />
            <input type="hidden" name="meta" value="'.$meta.'" />
            <p style="display: none;">
                <input type="text" name="username" />
            </p>        
                                       
            <div class="fs-row">
                <div class="fs-col fs-col-7">
                    <div class="fs-scheduler-slots"><h2>Please select a date from above...</h2></div>
                    <div class="fs-scheduler-slots-loader"></div>
                </div>
                <div class="fs-col fs-col-5">';
                foreach($schema->fields as $field)
                {
                    $value = null;
                    if(isset($fs_form_view_values) && count($fs_form_view_values)>0)
                    {                
                        foreach($fs_form_view_values as $v)
                        {
                            if($field->name == $v->name)
                            {
                                $value = $v;
                            }                
                        }
                    }
                    $html .= $this->render_field($field, $value);
                } 
                $html.='
                <div class="fs-form-row fs-row">
                    <div class="fs-col fs-col-sm-5 fs-col-privacy">
                    ';
                    if(strlen($privacy_url)>0)
                    {
                        $html .= '<a class="fs-privacy-link" href="'.$privacy_url.'">Privacy Link</a>';
                    }
                    $html.='
                        </div>
                        <div class="fs-col fs-col-sm-7">
                            <a class="fs-form-submit" data-form="'.$schema->recnum.'" href="#">'.$submit_label.'</a>
                        </div>
                    </div>
                    <div class="fs-loader fs-form-loader" data-form="'.$schema->recnum.'"></div>
                    <div class="fs-form-row fs-form-result" data-form="'.$schema->recnum.'"></div>
                </div>
            </div>

        </form>        
        ';
        $html .= '</div>';
        return $html;
    }
    private function render_field($field, $value=null)
    {
        $html = '';
        if($value != null)
        {
            $html .= '<input type="hidden" name="'.$field->recnum.'_'.$field->name.'" value="'.$value->value.'" />';
        }        
        else
        {
            switch($field->type)
            {
                case self::$TextInputType:
                    $html = $this->render_text_input_field($field);
                    break;
                case self::$TextAreaType:
                    $html = $this->render_textarea_field($field);
                    break;
                case self::$CheckInputsType:
                    $html = $this->render_checks_input_field($field);
                    break;
                case self::$RadioInputsType:
                    $html = $this->render_radios_input_field($field);
                    break;
                case self::$DateInputType:
                    $html = $this->render_date_input_field($field);
                    break;
                case self::$FileInputType:
                    $html = $this->render_file_input_field($field);
                    break;
                case self::$SelectInputType:
                    $html = $this->render_select_input_field($field);
                    break;
            }
        }
        return $html;
    }
    private function render_text_input_field($field)
    {    
        if($field->required==1 && strlen($this->required_marker)>0)
        {
            $field->title.=(' '.$this->required_marker);
        }
        $class = 'fs-input';
        if($field->required==1)
        {
            $class.=' required';
        }
        $html = '<div class="fs-row fs-form-row fs-text-row">';        
        if($this->template != null && $this->template->label_type == self::$OutsideLabelType)
        {
            $html .= '<div class="fs-col fs-col-3 fs-input-label-col">
                <label for="'.$field->name.'-'.$field->recnum.'-input">'.$field->title.'</label>
            </div>
            <div class="fs-col fs-col-9">
                <input type="text" id="'.$field->name.'-'.$field->recnum.'-input" name="'.$field->recnum.'_'.$field->name.'" class="'.$class.'" data-field="'.$field->recnum.'" data-msg-required="*" />
            </div>';
        }
        else
        {
            $html .= '<div class="fs-col fs-col-12">
                <input type="text" id="'.$field->name.'-'.$field->recnum.'-input" name="'.$field->recnum.'_'.$field->name.'" placeholder="'.$field->title.'" class="'.$class.'" data-field="'.$field->recnum.'" data-msg-required="*"  />
            </div>';
        }    
        $html .= '</div>';
        return $html;
    }
    private function render_textarea_field($field)
    {
        $class = 'fs-input';
        if($field->required==1)
        {
            $class.=' required';
        }
        $html = '<div class="fs-row fs-form-row fs-textarea-row">';
        if($this->template != null && $this->template->label_type == self::$OutsideLabelType)
        {
            $html .= '<div class="fs-col fs-col-3 fs-input-label-col">
                <label for="'.$field->name.'-'.$field->recnum.'-textarea">'.$field->title.'</label>
            </div>
            <div class="fs-col fs-col-9"> 
                <textarea id="'.$field->name.'-'.$field->recnum.'-textarea" name="'.$field->recnum.'_'.$field->name.'" class="'.$class.'" data-field="'.$field->recnum.'" data-msg-required="*"></textarea>
            </div>';
        }
        else
        {
            $html .= '<div class="fs-col fs-col-12">
                <textarea id="'.$field->name.'-'.$field->recnum.'-textarea" name="'.$field->recnum.'_'.$field->name.'" placeholder="'.$field->title.'" class="'.$class.'" data-field="'.$field->recnum.'" data-msg-required="*"></textarea>
            </div>';
        }
        $html .= '</div>';
        return $html;
    }
    private function render_checks_input_field($field)
    {
        $html = '<div class="fs-row fs-form-row fs-checks-row">';
        if($this->template != null && $this->template->label_type == self::$OutsideLabelType)
        {
            $html .= '<div class="fs-col fs-col-3 fs-input-label-col">
                <label>'.$field->title.'</label>
            </div>
            <div class="fs-col fs-col-9"> 
                <div class="fs-check-options">';
                $i=0;
                foreach($field->meta->select_options as $option)
                {
                    $checked = '';
                    $html .= '<input type="checkbox" name="'.$field->recnum.'_'.$field->name.'[]" value="'.$option->value.'" '.$checked.' />'.$option->label.'<br/>';
                    $i++;
                }            
                $html .= '</div>
            </div>';
        }
        else
        {
            $html .= '<div class="fs-col fs-col-12">
                <label>'.$field->title.'</label>
                <div class="fs-check-options">';
                $i=0;
                foreach($field->meta->select_options as $option)
                {
                    $checked = '';
                    $html .= '<input type="checkbox" name="'.$field->recnum.'_'.$field->name.'[]" value="'.$option->value.'" '.$checked.' />'.$option->label.'<br/>';
                    $i++;
                }            
                $html .= '</div>
            </div>';
        }
        $html .= '</div>';
        return $html;
    }
    private function render_radios_input_field($field)
    {
        $html = '<div class="fs-row fs-form-row fs-radios-row">';
        if($this->template != null && $this->template->label_type == self::$OutsideLabelType)
        {
            $html .= '<div class="fs-col fs-col-3 fs-input-label-col">
                <label>'.$field->title.'</label>
            </div>
            <div class="fs-col fs-col-9"> 
                <div class="fs-radio-options">';            
                foreach($field->meta->select_options as $option)
                {
                    $checked = '';
                    $html .= '<div class="fs-radio-option"><input type="radio" name="'.$field->recnum.'_'.$field->name.'" value="'.$option->value.'" '.$checked.' />'.$option->label.'</div>';
                }            
                $html .= '</div>
            </div>';
        }
        else
        {
            $html .= '<div class="fs-col fs-col-12">
                <label>'.$field->title.'</label>
                <div class="fs-radio-options">';            
                foreach($field->meta->select_options as $option)
                {
                    $checked = '';
                    $html .= '<div class="fs-radio-option"><input type="radio" name="'.$field->recnum.'_'.$field->name.'" value="'.$option->value.'" '.$checked.' />'.$option->label.'</div>';
                }            
                $html .= '</div>
            </div>';
        }
        $html .= '</div>';
        return $html;
    }
    private function render_date_input_field($field)
    {    
        if($field->required==1 && strlen($this->required_marker)>0)
        {
            $field->title.=(' '.$this->required_marker);
        }
        $class = 'fs-input';
        if($field->required==1)
        {
            $class.=' required';
        }
        $html = '<div class="fs-row fs-form-row fs-text-row fs-date-row">';
        if($this->template != null && $this->template->label_type == self::$OutsideLabelType)
        {
            $html .= '<div class="fs-col fs-col-3 fs-input-label-col">
                <label for="'.$field->name.'-'.$field->recnum.'-input">'.$field->title.'</label>
            </div>
            <div class="fs-col fs-col-9">
                <input type="text" id="'.$field->name.'-'.$field->recnum.'-input" name="'.$field->recnum.'_'.$field->name.'" class="'.$class.'" data-field="'.$field->recnum.'" data-msg-required="*" />
            </div>';
        }
        else
        {
            $html .= '<div class="fs-col fs-col-12">
                <input type="text" id="'.$field->name.'-'.$field->recnum.'-input" name="'.$field->recnum.'_'.$field->name.'" placeholder="'.$field->title.'" class="'.$class.'" data-field="'.$field->recnum.'" data-msg-required="*" />
            </div>';
        }    
        $html .= '</div>';
        return $html;
    }
    private function render_file_input_field($field)
    {    
        if($field->required==1 && strlen($this->required_marker)>0)
        {
            $field->title.=(' '.$this->required_marker);
        }
        $class = 'fs-input';
        if($field->required==1)
        {
            $class.=' required';
        }
        $html = '<div class="fs-row fs-form-row fs-file-row">';        
        
            $html .= '<div class="fs-col fs-col-3 fs-input-label-col">
                <label for="'.$field->name.'-'.$field->recnum.'-input">'.$field->title.'</label>
            </div>
            <div class="fs-col fs-col-9">
                <input type="file" id="'.$field->name.'-'.$field->recnum.'-input" name="'.$field->recnum.'_'.$field->name.'" class="'.$class.'" data-field="'.$field->recnum.'" data-msg-required="*" />
            </div>';
        
        $html .= '</div>';
        return $html;
    }
    private function render_select_input_field($field)
    {
        $html = '<div class="fs-row fs-form-row fs-select-row">';
        if($field->required==1 && strlen($this->required_marker)>0)
        {
            $field->title.=(' '.$this->required_marker);
        }
        $class = 'fs-input';
        if($field->required==1)
        {
            $class.=' required';
        }
        if($this->template != null && $this->template->label_type == self::$OutsideLabelType)
        {
            $html .= '<div class="fs-col fs-col-3 fs-input-label-col">
                <label>'.$field->title.'</label>
            </div>
            <div class="fs-col fs-col-9">             
                <select id="'.$field->name.'-'.$field->recnum.'-input" name="'.$field->recnum.'_'.$field->name.'" class="'.$class.'" data-field="'.$field->recnum.'" data-msg-required="*">';            
                foreach($field->meta->select_options as $option)
                {
                    $html .= '<option value="'.$option->value.'" />'.$option->label.'</option>';
                }            
                $html .= '</select>
            </div>';
        }
        else
        {
            $html .= '<div class="fs-col fs-col-12">
                <select id="'.$field->name.'-'.$field->recnum.'-input" name="'.$field->recnum.'_'.$field->name.'" class="'.$class.'" data-field="'.$field->recnum.'" data-msg-required="*">';            
                foreach($field->meta->select_options as $option)
                {
                    $html .= '<option value="'.$option->value.'" />'.$option->label.'</option>';
                }            
                $html .= '</select>
            </div>';
        }
        $html .= '</div>';
        return $html;
    }
    
    public function process_form()
    {
        global $wpdb;
        try
        {
            $website = get_option('website_id');
            if(strlen($website)==0)
            {
                throw new Exception('Invalid Website!');
            }
            $visitor = FsForms::GetVisitor();
            if(strlen($visitor)==0)
            {
                throw new Exception('Visitor not set!');
            }
            $session = FsForms::GetSession();
            if(strlen($session)==0)
            {
                throw new Exception('Session not set!');
            }
            $form = FsForms::PostField('form');
            if(strlen($form)==0)
            {            
                throw new Exception('Invalid Form!');   
            }
            $schema_fields = array (
                "function" => "get_form_schema",
                "form" => $form,
            );
            $json = FsForms::CurlPost(FsForms::get_fry(), $schema_fields);
            $schema = json_decode($json);
                     
            $process_fields = array (
                "function" => "process_form",
                "form" => $form,
                "website" => $website,
                "visitor" => $visitor,
                "session" => $session,
                "ip_address"=> FsForms::PostField("ip_address"),
                "from_url"=> FsForms::PostField("from_url"),
                "meta"=> FsForms::PostField("meta"),
                "username"=> FsForms::PostField("username"),
                "send_to_address" => FsForms::PostField("send_to_address")
            );
            foreach($schema->fields as $field)
            {
                switch($field->type)
                {
                case self::$FileInputType:
                    $file_data = array();
                    if(strlen($_FILES[$field->recnum.'_'.$field->name]['tmp_name'])>0)
                    {
                        $file_data['name'] = $_FILES[$field->recnum.'_'.$field->name]['name'];                    
                        $file_data['type'] = $_FILES[$field->recnum.'_'.$field->name]['type'];
                        $file_data['size'] = $_FILES[$field->recnum.'_'.$field->name]['size']; 
                        $file_extract = fopen($_FILES[$field->recnum.'_'.$field->name]['tmp_name'], 'r');
                        $file_data['data'] = fread($file_extract, $file_data['size']);
                        $file_data['data'] = base64_encode($file_data['data']);
                        fclose($file_extract);  
                    }
                    $process_fields[$field->recnum.'_'.$field->name] = json_encode($file_data);
                    break;
                default:
                    $process_fields[$field->recnum.'_'.$field->name] = FsForms::PostField($field->recnum.'_'.$field->name);
                    break;
                }
            }         
            //scheduler
            if($schema->calendar != null)
            {
                $process_fields['scheduler_date'] = FsForms::PostField('scheduler_date');
                $scheduler_slots = array();
                foreach($_POST['scheduler_slots'] as $slot)
                {
                    $scheduler_slots[] = $slot;
                }
                $process_fields['scheduler_slots'] = json_encode($scheduler_slots);
            }
            
            $json = FsForms::CurlPost(FsForms::get_fry(), $process_fields);
            $lead = json_decode($json);
            if(strlen($lead->error_message)>0)
            {
                throw new Exception($lead->error_message);
            }
//            $fields = array(
//                'function' => 'process_form_complete', 
//                'website' => $website,
//                'visitor' => $visitor,
//                'address' => FsForms::PostField("ip_address"), 
//                'referer' => FsForms::PostField("referer"),
//                'request' => FsForms::PostField("from_url"),
//                'lead' => $lead->recnum
//            );
//            $json = FsForms::CurlPost(FsForms::get_nibbler(), $fields);
//            $analytic = json_decode($json);
            ?>
            <script type="text/javascript">                
                window.top.location = "<?php echo FsForms::PostField('redirect'); ?>";
            </script>
            <span class="result-success">Form Submited!</span>
            <?php
        } 
        catch (Exception $ex)
        {
            ?><span class="result-failure"><?php
            echo $ex->getMessage();
            ?></span><?php
        }
        die();
    }
    public function load_scheduler_slots()
    {
        global $wpdb;
        try
        {
            $date = new DateTime($_POST['date']);
            $fields = array (
                "function" => "get_form_calendar_slots",
                "calendar" => esc_attr($_POST['calendar']),
                "date" => $date->format('Y-m-d')
            );            
            $json = FsForms::CurlPost(FsForms::get_fry(), $fields);
            $schema = json_decode($json);
            if(strlen($schema->error)>0)
            {
                throw new Exception($schema->error);
            }
            
            if(count($schema->slots)==0)
            {
                throw new Exception('There are no slots available this day!');
            }
            ?>
            <h2>Now that you have a date, please select a time.</h2>
            <input type="hidden" name="scheduler_date" value="<?php echo $date->format('Y-m-d'); ?>" />

                        <?php
                        foreach($schema->slots as $slot)
                        {
                            $start = new DateTime($slot->start);
                            $end = new DateTime($slot->end);
                            ?>
                            <a href="#" class="fs-scheduler-slot">
                                <input type="checkbox" name="scheduler_slots[]" value="<?php echo $slot->recnum; ?>" />
                                <div class="fs-check"></div>
                                <?php echo $start->format('g:i A'); ?> - <?php echo $end->format('g:i A'); ?>
                            </a>
                            <?php
                        }
                        ?>
                    
            <?php
        } 
        catch (Exception $ex)
        {
            ?><h2>We have a problem...</h2><?php
            echo $ex->getMessage();
        }
        die();
    }
 
}

?>
