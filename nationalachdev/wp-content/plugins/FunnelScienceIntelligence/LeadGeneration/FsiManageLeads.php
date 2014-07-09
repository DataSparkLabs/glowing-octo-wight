<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FsiManageLeads
 *
 * @author rudyard
 */
class FsiManageLeads {
    
    public function FsiManageLeads()
    {
        add_action('admin_menu', array(&$this, 'AdminMenu'));
    }
    
    function AdminMenu()
    {
        add_submenu_page('fsi-main', 'FSI Lead Tracking', 'Lead Tracking', 'manage_options', 'fsi-lead-tracking', array(&$this, 'ManageLeadsMain'));        
    }

    function ManageLeadsMain()
    {
        global $fsi_url;
        if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	?>
        <div class="wrap">
            <h2>Funnel Science Lead Tracking</h2>
            <p>Select a Lead Form:
                <?php
                $lead_forms = FsiLeadForm::GetLeadForms();
                foreach($lead_forms as $lead_form)
                {
                    ?><a href="<?php echo get_admin_url().'admin.php?page=fsi-lead-tracking&form='.$lead_form->recnum; ?>">[<?php echo $lead_form->name; ?>]</a>&nbsp;&nbsp;<?php
                }
                ?>
                    <a href="<?php echo get_admin_url(); ?>admin.php?page=fsi-lead-tracking&phone=1">[Phone Calls]</a>
            </p>
            <?php
            if(isset($_GET['form']))
            {           
                $form = FsiLeadForm::GetLeadForm($_GET['form']);
                if($form != null) 
                { 
                    $lead_form_fields = FsiLeadFormField::GetLeadFormFields($form->recnum);
                ?>
                <h3><?php echo $form->name; ?></h3>   
                <table border="0" id="fsi-lead-table">
                    <thead>
                        <tr>
                            <th>Date</th>                  
                            <?php
                                foreach($lead_form_fields as $lead_form_field)
                                {
                                    if($lead_form_field->meta->show_column)
                                    {
                                        ?><th><?php echo $lead_form_field->meta->title; ?></th><?php
                                    }
                                }
                            ?>
                            <th>Reference</th>
                            <th>IP Address</th> 
                            <th>Open</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $leads = FsiLead::GetLeadsForForm($form->recnum);
                        foreach($leads as $lead)
                        {
                            ?>
                                <tr>
                                    <td><?php echo date("m/d/y g:i A", strtotime($lead->date_created)); ?></td>
                                    <?php
                                        foreach($lead_form_fields as $lead_form_field)
                                        {
                                            if($lead_form_field->meta->show_column)
                                            {
                                                foreach($lead->meta->field_values as $meta_value)
                                                {
                                                    if($lead_form_field->name == $meta_value->name)
                                                    {
                                                        ?><td><?php echo $meta_value->value;?></td><?php
                                                    }
                                                }
                                            }
                                        }
                                    ?>
                                    <td><?php echo $lead->meta->reference; ?></td>
                                    <td><?php echo $lead->ip_address; ?></td>
                                    <td><a href="#" onclick="return open_lead(<?php echo $lead->recnum; ?>);">Open</a></td>
                                </tr>
                            <?php                        
                        }
                    ?>
                    </tbody>
                </table>
                <?php
                }
            }
            if(isset($_GET['phone']))
            { 
                ?>
                <h3>Phone Tracking</h3>   
                <table border="0" id="fsi-lead-table">
                    <thead>
                        <tr>
                            <th>Date</th>                
                            <th>Caller ID</th>
                            <th>Waiting Time</th>
                            <th>Talk Minutes</th>
                            <th>Transfer Type</th>
                            <th>Transfered To</th>
                            <th>Reference</th>
                            <th>IP Address</th> 
                            <th>Open</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $leads = FsiLead::GetLeadsForPhone();
                        foreach($leads as $lead)
                        {
                            ?>
                                <tr>
                                    <td><?php echo date("m/d/y g:i A", strtotime($lead->date_created)); ?></td>
                                    <td><?php echo $lead->meta->caller_id; ?></td>
                                    <td><?php echo $lead->meta->waiting_time; ?></td>
                                    <td><?php echo $lead->meta->talk_minutes; ?></td>
                                    <td><?php echo $lead->meta->transfer_type; ?></td>
                                    <td><?php echo $lead->meta->transfered_to; ?></td>
                                    <td><?php echo $lead->meta->reference; ?></td>
                                    <td><?php echo $lead->ip_address; ?></td>
                                    <td><a href="#" onclick="return open_lead(<?php echo $lead->recnum; ?>);">Open</a></td>
                                </tr>
                            <?php                        
                        }
                    ?>
                    </tbody>
                </table>
                <?php
            }
            ?>
            <div id="fsi-lead-dialog" style="display: none;">
                <div class="fsi-loader"></div>
            </div>
            <script type="text/javascript">
                jQuery(document).ready(function(){
                    jQuery('#fsi-lead-table').dataTable({
                        "aaSorting": [[ 0, "desc" ]],
                        "bJQueryUI": true,
                        "sPaginationType": "full_numbers"
                    });                
                });
                function open_lead(recnum)
                {
                    jQuery("#fsi-lead-dialog").dialog({                     
                        title:"Lead Details",
                        width: 400,
                        buttons: { 
                            Ok: function() 
                            { 
                                jQuery( this ).dialog( "close" ); 
                            } 
                        },
                        open: function() {
                            jQuery("#fsi-lead-dialog").html('<div class="fsi-loader"></div>');       
                            var data = {
                                action: 'fsi_lead_details',
                                recnum: recnum
                            };
                            jQuery.post(ajaxurl, data, function(data){
                                jQuery("#fsi-lead-dialog").html(data);
                            });
                        }
                    });
                    return false;
                }
            </script>
	</div>        
        
        <?php
    }
}

?>
