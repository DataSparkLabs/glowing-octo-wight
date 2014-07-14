<?php

/**
 * This class is provided by FSI and designed to be instantiated and have 'ProcessCallback' called by script in IfByPhone implementation.
 *
 * @author Rudyard Murdough
 */
class FsiIfByPhoneProcessor {
    
    public function FsiIfByPhoneProcessor()
    {
        
    }
    
    public function ProcessCallback()
    {
        $option = FsiOption::GetOption(FsiOption::$IfByPhoneValidNumbers);        
        $valid_numbers = array();
        foreach(explode(',',$option->value) as $valid_number)
        {
            $valid_numbers[] = trim($valid_number);
        }
        if(in_array($_POST["callednumber"], $valid_numbers))
        {  
            $lead = new FsiLead();
            $lead->meta = new PhoneLeadMeta();
            $lead->meta->caller_id = trim($_POST['callerid']);
            $lead->meta->waiting_time = trim($_POST['waitingtime']);
            $lead->meta->talk_minutes = trim($_POST['talkminutes']);
            $lead->meta->transfer_type = trim($_POST['transfertype']);
            $lead->meta->transfered_to = trim($_POST['transferedto']);
            $lead->ip_address = trim($_POST['st_ip_address']);
            $lead->type = FsiLead::$PhoneLeadType;
            $lead->form = -1;
            $lead->Store();
        }
        else
        {
          echo 'Invalid Called Number';
        }
    }
}

?>
