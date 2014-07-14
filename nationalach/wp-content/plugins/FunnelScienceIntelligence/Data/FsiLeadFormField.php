<?php

/**
 * Defines abstract data model for an FSI Lead Form Field and MySQL implementation.
 *
 * @author Rudyard Murdough
 */

class FsiLeadFormField {
    public static $text_type = 0;
    public static $check_type = 1;
    
    public $recnum=-1;
    public $lead_form=-1;
    public $name;
    public $type=-1;
    public $position=0;
    public $meta;
    
    public function FsiLeadFormField()
    {
        $this->meta = new FsiLeadFormFieldMeta();
    }
    public function GetType()
    {
        $str = '';
        if($this->type == self::$text_type)
        {
            $str = 'Text';
        }
        else if($this->type == self::$check_type)
        {
            $str = 'Checks';
        }
        return $str;
    }
    public function GetMetaFieldValue()
    {
        $field_value = new EmailLeadMetaFieldValue();
        $field_value->name = $this->name;
        if($this->type == self::$text_type)
        {            
            $field_value->value = esc_attr($_POST[$this->name]);;
        }
        else if($this->type == self::$check_type)
        {
            $field_value->value = implode(', ', $_POST[$this->name]);
        }
        return $field_value;
    }
    
    public function Store() {
        $sql = '';
        if ($this->recnum > 0) {
            $sql = 'UPDATE fsi_lead_form_fields SET                     
                    lead_form=' . $this->lead_form . ',
                    name=\'' . $this->name . '\',
                    type=' . $this->type . ',
                    position=' . $this->position . ',
                    meta=\''.$this->meta->Serialize().'\' 
                    WHERE recnum=' . $this->recnum . ';';
        } else {
            $sql = 'INSERT INTO fsi_lead_form_fields (
                        lead_form,                        
                        name,
                        type,
                        position,
                        meta
                        
                    ) VALUES (                        
                        ' . $this->lead_form . ',
                        \'' . $this->name . '\',
                        ' . $this->type . ',
                        ' . $this->position . ',
                        \''.$this->meta->Serialize().'\'
                    );';
        }
        mysql_query($sql);
        if ($this->recnum == 0) {
            $this->recnum = mysql_insert_id();
        }
        return $this->recnum;
    }
    public function Delete()
    {
        if ($this->recnum > 0) 
        {
            $sql = 'DELETE FROM fsi_lead_form_fields WHERE recnum=' . $this->recnum . ';';
            mysql_query($sql);
        }
    }
    public static function GetLeadFormField($recnum)
    {
        $lead_form_field = null;
        $query = 'SELECT * FROM fsi_lead_form_fields WHERE recnum='.$recnum.';';
        $result = mysql_query($query);
        $num = mysql_numrows($result);
        $i = 0;
        if ($num != 0)
        {
            $lead_form_field = self::load_lead_form_field($result, $i);
        }
        return $lead_form_field;
    }
    public static function GetLeadFormFields($lead_form)
    {
        $lead_form_fields = array();
        $query = 'SELECT * FROM fsi_lead_form_fields WHERE lead_form='.$lead_form.' ORDER BY position;';
        $result = mysql_query($query);
        $num = mysql_numrows($result);
        $i = 0;
        if ($num != 0)
        {
            while ($i < $num)
            {
                $lead_form_fields[$i] = self::load_lead_form_field($result, $i);
                $i++;
            }
        }
        return $lead_form_fields;
    }
    private static function load_lead_form_field($result, $i)
    {
        $lead_form_field = new FsiLeadFormField();
        $lead_form_field->recnum = mysql_result($result, $i, 'recnum');
        $lead_form_field->lead_form = mysql_result($result, $i, 'lead_form');                
        $lead_form_field->name = mysql_result($result, $i, 'name');
        $lead_form_field->type = mysql_result($result, $i, 'type');          
        $lead_form_field->position = mysql_result($result, $i, 'position');    
        $lead_form_field->meta = FsiLeadFormMeta::Deserialize(mysql_result($result, $i, 'meta'));
        return $lead_form_field;
    }
}
class FsiLeadFormFieldMeta extends SerializedObject
{
    public $title;
    public $required = false;
    public $show_column = false;
    
    public function GetRequired()
    {
        $str = "No";
        if($this->required)
        {
            $str = "Yes";
        }
        return $str;
    }
    public function GetShowColumn()
    {
        $str = "No";
        if($this->show_column)
        {
            $str = "Yes";
        }
        return $str;
    }
}

?>
