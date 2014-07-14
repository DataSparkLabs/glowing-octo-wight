<?php

/**
 * Defines abstract data model for an FSI Lead Form and MySQL implementation.
 *
 * @author Rudyard Murdough
 */

class FsiLeadForm {
    public $recnum=-1;
    public $name;
    public $from_address;
    public $to_addresses;
    public $subject;
    public $finished_redirect;
    public $meta;
    
    public function FsiLeadForm()
    {
        $this->meta = new FsiLeadFormMeta();
    }
    
    public function Store() {
        $sql = '';
        if ($this->recnum > 0) {
            $sql = 'UPDATE fsi_lead_forms SET                     
                    name=\'' . $this->name . '\',
                    from_address=\'' . $this->from_address . '\',
                    to_addresses=\'' . $this->to_addresses . '\',
                    subject=\'' . $this->subject . '\',
                    finished_redirect=\'' . $this->finished_redirect . '\',
                    meta=\''.$this->meta->Serialize().'\' 
                    WHERE recnum=' . $this->recnum . ';';
        } else {
            $sql = 'INSERT INTO fsi_lead_forms (
                        name,                        
                        from_address,
                        to_addresses,
                        subject,
                        finished_redirect,
                        meta
                        
                    ) VALUES (                        
                        \'' . $this->name . '\',
                        \'' . $this->from_address . '\',
                        \'' . $this->to_addresses . '\',
                        \'' . $this->subject . '\',
                        \'' . $this->finished_redirect . '\',
                        \''.$this->meta->Serialize().'\'
                    );';
        }
        mysql_query($sql);
        if ($this->recnum == 0) {
            $this->recnum = mysql_insert_id();
        }
        return $this->recnum;
    }
    public static function GetLeadForm($recnum)
    {
        $lead_form = null;
        if(strlen($recnum)>0)
        {
            $query = 'SELECT * FROM fsi_lead_forms WHERE recnum='.$recnum.';';
            $result = mysql_query($query);
            $num = mysql_numrows($result);
            $i = 0;
            if ($num != 0)
            {
                $lead_form = new FsiLeadForm();
                $lead_form->recnum = mysql_result($result, $i, 'recnum');
                $lead_form->name = mysql_result($result, $i, 'name');                
                $lead_form->from_address = mysql_result($result, $i, 'from_address');
                $lead_form->to_addresses = mysql_result($result, $i, 'to_addresses');          
                $lead_form->subject = mysql_result($result, $i, 'subject');      
                $lead_form->finished_redirect = mysql_result($result, $i, 'finished_redirect');      
                $lead_form->meta = FsiLeadFormMeta::Deserialize(mysql_result($result, $i, 'meta'));
            }
        }
        return $lead_form;
    }
    public static function GetLeadFormByName($name)
    {
        $lead_form = null;
        $query = 'SELECT * FROM fsi_lead_forms WHERE name=\''.$name.'\';';
        $result = mysql_query($query);
        $num = mysql_numrows($result);
        $i = 0;
        if ($num != 0)
        {
            $lead_form = new FsiLeadForm();
            $lead_form->recnum = mysql_result($result, $i, 'recnum');
            $lead_form->name = mysql_result($result, $i, 'name');                
            $lead_form->from_address = mysql_result($result, $i, 'from_address');
            $lead_form->to_addresses = mysql_result($result, $i, 'to_addresses');          
            $lead_form->subject = mysql_result($result, $i, 'subject');      
            $lead_form->finished_redirect = mysql_result($result, $i, 'finished_redirect');      
            $lead_form->meta = FsiLeadFormMeta::Deserialize(mysql_result($result, $i, 'meta'));
        }
        return $lead_form;
    }
    public static function GetLeadForms()
    {
        $lead_forms = array();
        $query = 'SELECT * FROM fsi_lead_forms;';
        $result = mysql_query($query);
        $num = mysql_numrows($result);
        $i = 0;
        if ($num != 0)
        {
            while ($i < $num)
            {
                $lead_forms[$i] = new FsiLeadForm();
                $lead_forms[$i]->recnum = mysql_result($result, $i, 'recnum');
                $lead_forms[$i]->name = mysql_result($result, $i, 'name');                
                $lead_forms[$i]->from_address = mysql_result($result, $i, 'from_address');
                $lead_forms[$i]->to_addresses = mysql_result($result, $i, 'to_addresses');          
                $lead_forms[$i]->subject = mysql_result($result, $i, 'subject');      
                $lead_forms[$i]->finished_redirect = mysql_result($result, $i, 'finished_redirect');      
                $lead_forms[$i]->meta = FsiLeadFormMeta::Deserialize(mysql_result($result, $i, 'meta'));
                $i++;
            }
        }
        return $lead_forms;
    }
}
class FsiLeadFormMeta extends SerializedObject
{
    public $form_html;
    public $auto_responder = null;
    
    public function FsiLeadFormMeta()
    {
        $this->auto_responder = new FsiLeadFormAutoResponder();
    }
}
class FsiLeadFormAutoResponder
{
    public $from_address;
    public $subject;
    public $body_html;
}

?>
