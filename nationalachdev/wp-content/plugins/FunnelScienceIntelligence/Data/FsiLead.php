<?php

/**
 * Defines abstract data model for an FSI lead and MySQL implementation.
 *
 * @author Rudyard Murdough
 */
class FsiLead {
    public static $EmailLeadType = 1;
    public static $PhoneLeadType = 2;
    //email fields
    public $recnum = -1;
    public $date_created;        
    public $ip_address;
    public $type = 0;
    public $form = -1;
    public $meta = null;
    
    public function FsiLead()
    {
        $this->meta = new FsiLeadMeta();
        
    }
    
    public function GetType()
    {
        $str = '';
        if($this->type == self::$EmailLeadType)
        {
            $str = 'E-Mail';
        }
        else if($this->type == self::$PhoneLeadType)
        {
            $str = 'Phone';
        }
        return $str;
    }
    
    public function Store() {
        $sql = '';
        if ($this->recnum != -1) {
            $sql = 'UPDATE fsi_leads SET                     
                    ip_address=\'' . $this->ip_address . '\',
                    type='.$this->type.',
                    form='.$this->form.',
                    meta=\''.$this->meta->Serialize().'\' 
                    WHERE recnum=' . $this->recnum . ';';
        } else {
            $sql = 'INSERT INTO fsi_leads (
                        date_created,                        
                        ip_address,
                        type,
                        form,
                        meta
                        
                    ) VALUES ( 
                        CURRENT_TIMESTAMP(),                        
                        \'' . $this->ip_address . '\',
                        '.$this->type.',
                        '.$this->form.',
                        \''.$this->meta->Serialize().'\'
                    );';
        }
        mysql_query($sql);
        if ($this->recnum == -1) {
            $this->recnum = mysql_insert_id();
        }
        return $this->recnum;
    }
    public static function GetLead($recnum)
    {
        $lead = null;
        $query = 'SELECT * FROM fsi_leads WHERE recnum='.$recnum.';';
        $result = mysql_query($query);
        $num = mysql_numrows($result);
        $i = 0;
        if ($num != 0)
        {
            $lead = self::load_lead($result, $i);
        }
        return $lead;
    }
    public static function GetLeads()
    {
        $leads = array();
        $query = 'SELECT * FROM fsi_leads ORDER BY date_created ASC;';
        $result = mysql_query($query);
        $num = mysql_numrows($result);
        $i = 0;
        if ($num != 0)
        {
            while ($i < $num)
            {
                $leads[$i] = self::load_lead($result, $i);                
                $i++;
            }
        }
        return $leads;
    }
    public static function GetLeadsForForm($form)
    {
        $leads = array();
        $query = 'SELECT * FROM fsi_leads WHERE form='.$form.' AND type=1 ORDER BY date_created ASC;';
        $result = mysql_query($query);
        $num = mysql_numrows($result);
        $i = 0;
        if ($num != 0)
        {
            while ($i < $num)
            {
                $leads[$i] = self::load_lead($result, $i);                
                $i++;
            }
        }
        return $leads;
    }
    public static function GetLeadsForPhone()
    {
        $leads = array();
        $query = 'SELECT * FROM fsi_leads WHERE type=2 ORDER BY date_created ASC;';
        $result = mysql_query($query);
        $num = mysql_numrows($result);
        $i = 0;
        if ($num != 0)
        {
            while ($i < $num)
            {
                $leads[$i] = self::load_lead($result, $i);                
                $i++;
            }
        }
        return $leads;
    }
    private static function load_lead($result, $i)
    {
        $lead = new FsiLead();
        $lead->recnum = mysql_result($result, $i, 'recnum');
        $lead->date_created = mysql_result($result, $i, 'date_created');                
        $lead->ip_address = mysql_result($result, $i, 'ip_address');
        $lead->type = mysql_result($result, $i, 'type');
        $lead->form = mysql_result($result, $i, 'form');         
        $lead->meta = FsiLeadMeta::Deserialize(mysql_result($result, $i, 'meta'));
        return $lead;
    }
}

class FsiLeadMeta extends SerializedObject
{
    
    
    public function FsiLeadMeta()
    {
        
    }
    
}

class EMailLeadMeta extends FsiLeadMeta
{
    public $field_values = array();
    public $from_page;
    public $reference;
    public $name;
    public $email;
}
class EmailLeadMetaFieldValue
{
    public $name;
    public $value;
}
class PhoneLeadMeta extends FsiLeadMeta
{
    public $caller_id;
    public $waiting_time = 0;
    public $talk_minutes = 0;
    public $transfer_type;
    public $transfered_to;
    
}

?>
