<?php

/**
 * Ajax callbacks for FSI admin functions.
 *
 * @author Rudyard Murdough
 */

class FsiAdminAjaxActions
{
    public function FsiAdminAjaxActions()
    {
        add_action('wp_ajax_fsi_lead_details', array(&$this, 'LeadDetails'));
        add_action('wp_ajax_fsi_save_lead_form', array(&$this, 'SaveLeadForm'));
        add_action('wp_ajax_fsi_edit_lead_form_field', array(&$this, 'EditLeadFormField'));
        add_action('wp_ajax_fsi_save_lead_form_field', array(&$this, 'SaveLeadFormField'));
        add_action('wp_ajax_fsi_delete_lead_form_field', array(&$this, 'DeleteLeadFormField'));
        add_action('wp_ajax_fsi_migrate_leads', array(&$this, 'MigrateLeads'));
    }
    
    public function LeadDetails()
    {
        global $wpdb;
        $lead = FsiLead::GetLead($_POST["recnum"]);
        if($lead != null)
        {
            ?>
            <p>Date: <?php echo $lead->date_created;?></p>
            <?php
            if($lead->type == FsiLead::$EmailLeadType)
            {
                $lead_form_fields = FsiLeadFormField::GetLeadFormFields($lead->form);
                foreach($lead_form_fields as $lead_form_field)
                {
                    foreach($lead->meta->field_values as $meta_value)
                    {
                        if($lead_form_field->name == $meta_value->name)
                        {
                            ?><p><?php echo $lead_form_field->meta->title;?>: <?php echo $meta_value->value;?></p><?php
                        }
                    }
                }
                ?>
                <p>Reference: <?php echo $lead->meta->reference;?></p>
                <?php
            }
            else if($lead->type == FsiLead::$PhoneLeadType)
            {
                ?>        
                <p>Caller ID: <?php echo $lead->meta->caller_id;?></p>
                <p>Waiting Time: <?php echo $lead->meta->waiting_time;?></p>
                <p>Talk Minutes: <?php echo $lead->meta->talk_minutes;?></p>
                <p>Transfer Type: <?php echo $lead->meta->transfer_type;?></p>
                <p>Transfered To: <?php echo $lead->meta->transfered_to;?></p>
                <?php
            }
            ?>
            <p>IP Address: <?php echo $lead->ip_address;?></p>
            <?php
        }
        die();
    }  
    public function SaveLeadForm()
    {
        global $wpdb;
        try
        {
            $lead_form = FsiLeadForm::GetLeadForm($_POST["recnum"]);
            if($lead_form == null)
            {
                $lead_form = new FsiLeadForm();
            }
            $lead_form->name = esc_attr($_POST["name"]);
            $lead_form->subject = esc_attr($_POST["subject"]);
            $lead_form->from_address = esc_attr($_POST["from_address"]);
            $lead_form->to_addresses = esc_attr($_POST["to_addresses"]);
            $lead_form->finished_redirect = esc_attr($_POST["finished_redirect"]);
            $lead_form->meta->form_html = esc_attr($_POST["form_html"]);
            $lead_form->meta->auto_responder->from_address = esc_attr($_POST['autoresponder_from_address']);            
            $lead_form->meta->auto_responder->subject = esc_attr($_POST['autoresponder_subject']);
            $lead_form->meta->auto_responder->body_html = $_POST['autoresponder_body_html'];
            $lead_form->Store();
            echo '<script type="text/javascript">window.location.href="admin.php?page=fsi-lead-forms";</script>';
        }
        catch(Exception $ex)
        {
            echo $ex->getMessage();
        }
        die();
    }
    public function EditLeadFormField()
    {
        global $wpdb;
        ?>
        <?php if($_POST["recnum"]!= -1) 
        { 
            $lead_form_field = FsiLeadFormField::GetLeadFormField($_POST["recnum"]);
            ?><p><b>Edit Field</b></p><?php         
        } 
        else 
        { 
            $lead_form_field = new FsiLeadFormField();
            $lead_form_field->lead_form = $_POST["lead_form"];
            ?><p><b>Add Field</b></p><?php         
        } 
        ?>
        <form id="edit-lead-field-form" action="" method="post">
            <input type="hidden" name="action" value="fsi_save_lead_form_field" />
            <input type="hidden" name="recnum" value="<?php echo $_POST["recnum"]; ?>" />
            <input type="hidden" name="lead_form" value="<?php echo $_POST["lead_form"]; ?>" />
            <p>Title: <input type="text" name="title" value="<?php echo $lead_form_field->meta->title; ?>" /></p>
            <p>Name: <input type="text" name="name" value="<?php echo $lead_form_field->name; ?>" /></p>
            <p>Type: <select name="type">
                    <option value="<?php echo FsiLeadFormField::$text_type; ?>" <?php if($lead_form_field->type == FsiLeadFormField::$text_type) { echo 'selected="selected"'; } ?>>Text</option>
                    <option value="<?php echo FsiLeadFormField::$check_type; ?>" <?php if($lead_form_field->type == FsiLeadFormField::$check_type) { echo 'selected="selected"'; } ?>>Checks</option>
            </select></p>
            <p>Required: <input type="checkbox" name="required" value="checked" <?php if($lead_form_field->meta->required) { echo 'checked="checked"'; } ?> /></p>
            <p>Show Column: <input type="checkbox" name="show_column" value="checked" <?php if($lead_form_field->meta->show_column) { echo 'checked="checked"'; } ?> /></p>            
            <div id="fsi-edit-lead-form-field-loader" class="fsi-loader" style="display: none;"></div>
            <p id="fsi-edit-lead-form-field-result"></p>
        </form>
        <?php if($lead_form_field->recnum!= -1) { ?>
        <form id="delete-lead-field-form" action="" method="post">
            <input type="hidden" name="action" value="fsi_delete_lead_form_field" />
            <input type="hidden" name="recnum" value="<?php echo $_POST["recnum"]; ?>" />            
            <div id="fsi-delete-lead-form-field-loader" class="fsi-loader" style="display: none;"></div>
            <p id="fsi-delete-lead-form-field-result"></p>
        </form>
        <p><a href="#" id="fsi-delete-lead-form-field-button">Delete</a></p>
        <?php } ?>
        <script type="text/javascript">
        jQuery("#edit-lead-field-form").validate({
            rules: {		
                    name: {
                            required: true
                    }
            },
            messages: {
                    name: "*"                        
            },
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#fsi-edit-lead-form-field-result",
                    url: ajaxurl,
                    beforeSubmit: function() {
                        jQuery("#fsi-edit-lead-form-field-loader").show();
                    },
                    success: function() {
                        jQuery("#fsi-edit-lead-form-field-loader").hide();
                    }
                });
            }
        });
        <?php if($lead_form_field->recnum!= -1) { ?>        
        jQuery("#delete-lead-field-form").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#fsi-delete-lead-form-field-result",
                    url: ajaxurl,
                    beforeSubmit: function() {
                        jQuery("#fsi-delete-lead-form-field-button").hide();
                        jQuery("#fsi-delete-lead-form-field-loader").show();
                    },
                    success: function() {
                        jQuery("#fsi-delete-lead-form-field-button").show();
                        jQuery("#fsi-delete-lead-form-field-loader").hide();
                    }
                        
                });
            }
        }); 
        jQuery("#fsi-delete-lead-form-field-button").button();
        jQuery("#fsi-delete-lead-form-field-button").click(function(){
            jQuery("#delete-lead-field-form").submit();
            return false;
        });
        <?php } ?>
        </script>
        <?php
        die();
    }
    
    public function SaveLeadFormField()
    {
        global $wpdb;
        try
        {
            $lead_form_field = FsiLeadFormField::GetLeadFormField(esc_attr($_POST["recnum"]));
            if($lead_form_field == null)
            {
                $lead_form_field = new FsiLeadFormField();
            }
            $lead_form_field->meta->title = esc_attr($_POST["title"]);
            $lead_form_field->name = esc_attr($_POST["name"]);
            $lead_form_field->lead_form = esc_attr($_POST["lead_form"]);
            $lead_form_field->type = esc_attr($_POST["type"]);
            $lead_form_field->meta->required = esc_attr($_POST["required"])=="checked";
            $lead_form_field->meta->show_column = esc_attr($_POST["show_column"])=="checked";
            $lead_form_field->Store();
            echo '<script type="text/javascript">window.location.reload();</script>';
        }
        catch(Exception $ex)
        {
            echo $ex->getMessage();
        }
        die();
    }
        
    public function DeleteLeadFormField()
    {
        global $wpdb;
        try
        {
            $lead_form_field = FsiLeadFormField::GetLeadFormField(esc_attr($_POST["recnum"]));
            if($lead_form_field != null)
            {
                $lead_form_field->Delete();
            }
            echo '<script type="text/javascript">window.location.reload();</script>';
        }
        catch(Exception $ex)
        {
            echo $ex->getMessage();
        }
        die();
    }
    public function MigrateLeads()
    {
        global $wpdb;
        try
        {
            $query = 'SELECT * FROM fsi_leads_old;';
            $result = mysql_query($query);
            $num = mysql_numrows($result);
            $i = 0;
            if ($num != 0)
            {
                while ($i < $num)
                {                    
                    $lead = new FsiLead();                   
                    $lead->date_created = mysql_result($result, $i, 'date_created');                
                    $lead->ip_address = mysql_result($result, $i, 'ip_address');
                    if(strlen(mysql_result($result, $i, 'caller_id'))==0)
                    {
                        $lead->type = FsiLead::$EmailLeadType;      
                        $lead->meta = new EMailLeadMeta();
                        $lead->meta->from_page = mysql_result($result, $i, 'from_page');
                        $lead->form = 4;
                        $field_value = new EmailLeadMetaFieldValue();
                        $field_value->name = 'name';
                        $field_value->value = mysql_result($result, $i, 'name');
                        $lead->meta->field_values[] = $field_value;
                        $field_value = new EmailLeadMetaFieldValue();
                        $field_value->name = 'email';
                        $field_value->value = mysql_result($result, $i, 'email');
                        $lead->meta->field_values[] = $field_value;
                        $field_value = new EmailLeadMetaFieldValue();
                        $field_value->name = 'phone';
                        $field_value->value = mysql_result($result, $i, 'phone');
                        $lead->meta->field_values[] = $field_value;
                        $field_value = new EmailLeadMetaFieldValue();
                        $field_value->name = 'message';
                        $field_value->value = mysql_result($result, $i, 'message');
                        $lead->meta->field_values[] = $field_value;
                        $field_value = new EmailLeadMetaFieldValue();
                        $field_value->name = 'businessname';
                        $field_value->value = trim(substr(mysql_result($result, $i, 'comments'),strlen('Business Name:')));
                        $lead->meta->field_values[] = $field_value;
                    }
                    else
                    {
                        $lead->type = FsiLead::$PhoneLeadType;  
                        $lead->meta = new PhoneLeadMeta();
                        $lead->meta->caller_id = mysql_result($result, $i, 'caller_id');
                        $lead->meta->waiting_time = mysql_result($result, $i, 'waiting_time');
                        $lead->meta->talk_minutes = mysql_result($result, $i, 'talk_minutes');
                        $lead->meta->transfer_type = mysql_result($result, $i, 'transfer_type');
                        $lead->meta->transfered_to = mysql_result($result, $i, 'transfered_to');
                    }
                    $sql = 'INSERT INTO fsi_leads (
                                date_created,                        
                                ip_address,
                                type,
                                form,
                                meta

                            ) VALUES ( 
                                \'' . $lead->date_created . '\',                        
                                \'' . $lead->ip_address . '\',
                                '.$lead->type.',
                                '.$lead->form.',
                                \''.$lead->meta->Serialize().'\'
                            );';
                    mysql_query($sql);
                    $i++;
                }
                echo 'Migrated '.$num.' Leads...';
            }
            else
            {
                echo 'None Migrated...';
            }
        }
        catch(Exception $ex)
        {
            echo $ex->getMessage();
        }
        die();    
    }        

}

?>
