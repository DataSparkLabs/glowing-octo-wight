<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FsiManageLeadForms
 *
 * @author rudyard
 */
class FsiManageLeadForms {
    
    public function FsiManageLeadForms()
    {
        add_action('admin_menu', array(&$this, 'AdminMenu'));
    }
    function AdminMenu()
    {
        add_submenu_page('fsi-main', 'FSI Lead Forms', 'Lead Forms', 'manage_options', 'fsi-lead-forms', array(&$this, 'ManageLeadFormsMain'));
    }
    
    function ManageLeadFormsMain()
    {
        switch($_GET['sub'])
        {
            case 'edit_lead_form':
                $this->EditLeadFormPage();
                break;
            default:
                $this->ManageLeadForms();
                break;
        }
    }
    
    function EditLeadFormPage()
    {
        global $fsi_url;
        if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
        ?>
        <div class="wrap">            
            <?php
            $lead_form = FsiLeadForm::GetLeadForm($_GET["recnum"]);
            if($lead_form == null)
            {
                $lead_form = new FsiLeadForm();
            }
            ?>
            <h2><?php 
            if($lead_form->recnum!=-1)
            {
                echo $lead_form->name;
            }
            else
            {
                echo 'New Lead Form';
            }   
            ?></h2>
            <form id="edit-lead-form-form" action="" method="post">
                <input type="hidden" name="recnum" value="<?php echo $lead_form->recnum; ?>"/>
                <input type="hidden" name="action" value="fsi_save_lead_form" /> 
                <div class="row"><b>E-Mail Settings</b></div>
                <div class="row"><div class="label">Name:</div><input type="text" name="name" value="<?php echo $lead_form->name; ?>" /></div>
                <div class="row"><div class="label">Subject:</div><input type="text" name="subject" value="<?php echo $lead_form->subject; ?>" /></div>
                <div class="row"><div class="label">From Address:</div><input type="text" name="from_address" value="<?php echo $lead_form->from_address; ?>" /></div>
                <div class="row" style="margin-bottom: 0;"><div class="label">To Addresses:</div><input type="text" name="to_addresses" value="<?php echo $lead_form->to_addresses; ?>" size="50" /></div>
                <div class="row" style="margin-top: 0;"><div class="label"></div>(Separate Each Address by a Comma)</div>
                <div class="row"><div class="label">Finished Redirect:</div><input type="text" name="finished_redirect" value="<?php echo $lead_form->finished_redirect; ?>" /></div>            
                <div class="row"><b>Form HTML</b></br><textarea name="form_html" rows="10" cols="60"><?php echo $lead_form->meta->form_html; ?></textarea></div>                                          
                <div class="row"><b>Auto-Responder Settings</b></div>
                <div class="row"><div class="label">Subject:</div><input type="text" name="autoresponder_subject" value="<?php echo $lead_form->meta->auto_responder->subject; ?>" /></div>
                <div class="row"><div class="label">From Address:</div><input type="text" name="autoresponder_from_address" value="<?php echo $lead_form->meta->auto_responder->from_address; ?>" /></div>
                <div class="row">Auto-Responder E-Mail HTML</br><textarea name="autoresponder_body_html" rows="10" cols="60"><?php echo $lead_form->meta->auto_responder->body_html; ?></textarea></div>                                          
               
            </form>
            <div id="fsi-edit-lead-form-loader" class="fsi-loader" style="display: none;"></div>
            <p id="fsi-edit-lead-form-result"></div>  
            <div class="row"><a href="#" id="save-lead-form-button">Save</a></p>
            <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery("#save-lead-form-button").button();
                jQuery("#save-lead-form-button").click(function(){
                    jQuery("#edit-lead-form-form").submit();
                    jQuery("#save-lead-form-button").button("disable");
                    return false;
                });
                
                jQuery("#edit-lead-form-form").validate({
                    rules: {		
                            name: {
                                    required: true
                            },
                            subject: {
                                    required: true
                            },
                            from_address: {
                                    required: true
                            },
                            to_addresses: {
                                    required: true
                            },
                            finished_redirect: {
                                    required: true
                            }
                    },
                    messages: {
                            name: "*",
                            subject: "*",
                            from_address: "*",
                            to_addresses: "*",
                            finished_redirect: "*" 
                    },
                    submitHandler: function(form) {
                        jQuery(form).ajaxSubmit({
                                target: "#fsi-edit-lead-form-result",
                                url: ajaxurl,
                                beforeSubmit: function() {
                                    jQuery("#fsi-edit-lead-form-loader").show();
                                    jQuery("#save-lead-form-button").hide();
                                },
                                success: function() {
                                    jQuery("#fsi-edit-lead-form-loader").hide();
                                    jQuery("#save-lead-form-button").show();
                                }
                        });
                    }
                }); 
            });
            </script>
            <?php if($lead_form->recnum!=-1) { ?>            
                <p><b>Fields</b></p>
                <table border="1">
                <tr><th>Title</th><th>Name</th><th>Type</th><th>Required</th><th>Show Column</th><th>Edit</th></tr>
                <?php $lead_form_fields = FsiLeadFormField::GetLeadFormFields($lead_form->recnum);?>
                <?php foreach($lead_form_fields as $lead_form_field) { ?>
                <tr>
                    <td><?php echo $lead_form_field->meta->title; ?></td>
                    <td><?php echo $lead_form_field->name; ?></td>
                    <td><?php echo $lead_form_field->GetType(); ?></td>
                    <td><?php echo $lead_form_field->meta->GetRequired(); ?></td>
                    <td><?php echo $lead_form_field->meta->GetShowColumn(); ?></td>
                    <td><a href="#" class="edit-lead-form-field-button" onclick="return edit_lead_form_field(<?php echo $lead_form_field->recnum; ?>, <?php echo $lead_form->recnum; ?>);">Edit</a></td>
                </tr>
                <?php } ?>
                </table>            
                <p><a href="#" id="add-lead-form-field-button">Add Field</a></p>
                <div id="edit-lead-form-field-div" style="display: none">
                    <div class="fsi-loader"></div>
                </div>
                <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery("#add-lead-form-field-button").button();
                    jQuery("#add-lead-form-field-button").click(function(){
                        return edit_lead_form_field(-1,<?php echo $lead_form->recnum; ?>);
                    });
                });
                    
                function edit_lead_form_field(recnum, lead_form)
                {                   
                    jQuery("#edit-lead-form-field-div").dialog({                     
                        title:"Lead Form Field",
                        width: 400,
                        buttons: { 
                            "Save": function()
                            {
                                jQuery("#edit-lead-field-form").submit();
                            },
                            Cancel: function() 
                            { 
                                jQuery( this ).dialog( "close" ); 
                            } 
                        },
                        open: function() {
                            jQuery("#edit-lead-form-field-div").html('<div class="fsi-loader"></div>');       
                            var data = {
                                action: 'fsi_edit_lead_form_field',
                                recnum: recnum,
                                lead_form: lead_form
                            };
                            jQuery.post(ajaxurl, data, function(data){
                                jQuery("#edit-lead-form-field-div").html(data);
                            });
                        }
                    });
                    return false;
                }
                            
                </script>
            <?php } ?>   
        </div>
        <?php        
    }    
    
    function ManageLeadForms()
    {
        global $fsi_url;
        if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
        ?>
        <div class="wrap">
            <h2>Funnel Science Lead Forms</h2>
            <p><table border="0" id="fsi-lead-forms-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>From Address</th>
                        <th>To Addresses</th>                        
                        <th>Open</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $lead_forms = FsiLeadForm::GetLeadForms();
                    foreach($lead_forms as $lead_form)
                    {
                        ?>
                        <tr>
                            <td><?php echo $lead_form->name; ?></td>
                            <td><?php echo $lead_form->subject; ?></td>
                            <td><?php echo $lead_form->from_address; ?></td>
                            <td><?php echo $lead_form->to_addresses; ?></td>
                            <td><a href="admin.php?page=fsi-lead-forms&sub=edit_lead_form&recnum=<?php echo $lead_form->recnum; ?>">Open</a></td>
                        </tr>
                        <?php
                    }
                ?>
                </tbody>
            </table>
            <br/>
            <p><a id="create-lead-form-button" href="admin.php?page=fsi-lead-forms&sub=edit_lead_form">Create Form</a></p>
            <div id="fsi-lead-form-dialog" style="display: none;">
                <div class="fsi-loader"></div>
            </div>
            <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery("#create-lead-form-button").button();
                jQuery('#fsi-lead-forms-table').dataTable({
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers"
                });                
            });
            </script>
<!--            
            <p><b>Migrate Leads</b></p>
            <p><a id="migrate_leads_button" href="#">Migrate Now</a></p>
            <p id="migrate_leads_result"></p>
            <script type="text/javascript">
                jQuery("#migrate_leads_button").click(function(){
                    var data = {
                        action: 'fsi_migrate_leads'
                    };
                    jQuery.post(ajaxurl, data, function(data){
                        jQuery("#migrate_leads_result").html(data);
                    });
                });
            </script>-->
        </div>   
        <?php
    }
    
}

?>
