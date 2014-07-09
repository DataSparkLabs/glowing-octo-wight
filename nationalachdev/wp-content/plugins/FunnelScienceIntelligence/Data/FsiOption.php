<?php

/**
 * Defines abstract data model for an FSI Option and MySQL implementation.
 *
 * @author Rudyard Murdough
 */

class FsiOption {

    public static $IfByPhoneValidNumbers = 'IfByPhoneValidNumbers';
    public static $IfByPhonePublicKey = 'IfByPhonePublicKey';
    public static $IfByPhoneKeywordSet = 'IfByPhoneKeywordSet';
    public static $SmtpServer = 'SmtpServer';
    public static $SmtpUser = 'SmtpUser';
    public static $SmtpPassword = 'SmtpPassword';
    public static $SmtpPort = 'SmtpPort';
    
    public $recnum=-1;
    public $date_updated;
    public $name;
    public $value;
    
    public function Store() {
        $sql = '';
        if ($this->recnum > 0) 
        {
            $sql = 'UPDATE fsi_options SET             
                    date_updated=CURRENT_TIMESTAMP(),
                    name=\'' . $this->name . '\',
                    value=\''.$this->value.'\' 
                    WHERE recnum=' . $this->recnum . ';';
        } 
        else 
        {
            $sql = 'INSERT INTO fsi_options (
                        date_updated,
                        name,                        
                        value                                                
                    ) VALUES ( 
                        CURRENT_TIMESTAMP(),                        
                        \'' . $this->name . '\',                        
                        \''.$this->value.'\'
                    );';
        }
        mysql_query($sql);
        if ($this->recnum == 0) {
            $this->recnum = mysql_insert_id();
        }
        return $this->recnum;
    }
    public static function GetOption($name)
    {
        $option = new FsiOption();
        $option->name = $name;
        $query = 'SELECT * FROM fsi_options WHERE name=\''.$name.'\';';
        $result = mysql_query($query);
        $num = mysql_numrows($result);
        $i = 0;
        if ($num != 0)
        {
            $option->recnum = mysql_result($result, $i, 'recnum');
            $option->date_updated = mysql_result($result, $i, 'date_updated');                
            $option->name = mysql_result($result, $i, 'name');
            $option->value = mysql_result($result, $i, 'value');                
        }
        return $option;
    }
}

?>
