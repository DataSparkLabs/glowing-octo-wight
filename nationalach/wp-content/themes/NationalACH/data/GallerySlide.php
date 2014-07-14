<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Gallery
 *
 * @author rudyard
 */
class GallerySlide {
    public $recnum=0;    
    public $image_url;
    public $link_url;
    public $position = 0;
    
    public function Store()
    {
        $sql = '';
        if ($this->recnum > 0)
        {
            $sql = 'UPDATE gallery SET image_url=\'' . $this->image_url . '\', link_url=\'' . $this->link_url . '\', position='.$this->position.' WHERE recnum=' . $this->recnum . ';';
        } 
        else
        {
            $sql = 'INSERT INTO gallery (image_url, link_url, position) VALUES(\'' . $this->image_url . '\', \'' . $this->link_url . '\', '.$this->position.');';
        }
        mysql_query($sql);
        if ($this->recnum == 0)
        {
            $this->recnum = mysql_insert_id();
        }
        return $this->recnum;
        
    }
    public function Delete()
    {
        $sql = 'DELETE from gallery WHERE recnum=' . $this->recnum . ';';
        mysql_query($sql);            
    }
    public static function GetSlide($recnum)
    {
        $slide = new GallerySlide();
        $query = 'SELECT * FROM gallery WHERE recnum='.$recnum.';';
        $result = mysql_query($query);
        $num = mysql_numrows($result);
        $i = 0;
        if ($num != 0)
        {
            $slide = new GallerySlide();
            $slide->recnum = mysql_result($result, $i, 'recnum');
            $slide->image_url = mysql_result($result, $i, 'image_url');
            $slide->link_url = mysql_result($result, $i, 'link_url');
            $slide->position = mysql_result($result, $i, 'position');
        }
        return $slide;
    }
    public static function GetSlides()
    {
        $slides = array();
        $query = 'SELECT * FROM gallery ORDER BY position;';
        $result = mysql_query($query);
        $num = mysql_numrows($result);
        $i = 0;
        if ($num != 0)
        {
            while ($i < $num)
            {
                $slides[$i] = new GallerySlide();
                $slides[$i]->recnum = mysql_result($result, $i, 'recnum');
                $slides[$i]->image_url = mysql_result($result, $i, 'image_url');
                $slides[$i]->link_url = mysql_result($result, $i, 'link_url');
                $slides[$i]->position = mysql_result($result, $i, 'position');
                $i++;
            }
        }
        return $slides;
    }
}

?>
