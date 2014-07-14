<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SerializedObject
 *
 * @author rudyard
 */
require_once 'Serializer.php';
require_once 'Unserializer.php';

class SerializedObject 
{
    public function SerializedObject()
    {
        
    }
    private static function get_xml_options()
    {
        return array(XML_SERIALIZER_OPTION_INDENT      => '    ',
                XML_SERIALIZER_OPTION_LINEBREAKS  => "\r\n",
                XML_SERIALIZER_OPTION_DEFAULT_TAG => 'unnamedItem',
                XML_SERIALIZER_OPTION_TYPEHINTS   => true);
    }
    public function Serialize()
    {
        $xml = "";
        $serializer = &new XML_Serializer(self::get_xml_options());
        if($serializer->serialize($this))
        {
                $xml = $serializer->getSerializedData();
        }
        return $xml;
    }
    public static function Deserialize($xml)
    {
        $object = null;
        $unserializer = &new XML_Unserializer();
        $status = $unserializer->unserialize($xml);
        if (PEAR::isError($status))
        {
            echo 'Error: ' . $status->getMessage();
        } 
        else
        {
            $object = $unserializer->getUnserializedData();
        }
        return $object;
    }
}

?>
