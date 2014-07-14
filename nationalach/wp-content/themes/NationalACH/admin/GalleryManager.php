<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductCategoryManager
 *
 * @author rudyard
 */
class GalleryManager
{
    public function Render()
    {
        if (!current_user_can('manage_options')) {  
            wp_die('You do not have sufficient permissions to access this page.');  
        } 
        if (isset($_POST["add_slide"])) {  
            $slide = new GallerySlide();
            $slide->recnum = esc_attr($_POST["recnum"]);
            $slide->image_url = esc_attr($_POST["image_url"]);
            $slide->link_url = esc_attr($_POST["link_url"]);
            $slide->position = esc_attr($_POST["position"]);
            $slide->Store();
        }
        $current_slide = new GallerySlide();
        if (isset($_POST["edit_slide"])) {  
            $current_slide = GallerySlide::GetSlide(esc_attr($_POST["recnum"]));
        }
        if (isset($_POST["delete_slide"])) {
            $delete_slide = GallerySlide::GetSlide(esc_attr($_POST["recnum"]));
            $delete_slide->Delete();
        }
        ?>
        <div class="wrap">
            <?php screen_icon('themes'); ?> <h2>Gallery Manager</h2>
            <?php if($current_slide->recnum >0) { ?>
            <h3>Edit Slide</h3>
            <?php } else { ?>
            <h3>Add Slide</h3>
            <?php } ?>
            <form method="POST" action="">  
                <input type="hidden" name="add_slide" value="Y" />  
                <input type="hidden" name="recnum" value="<?php echo $current_slide->recnum; ?>" />
                <table class="form-table">  
                    <tr valign="top">  
                        <th scope="row">  
                            <label for="image_url">  
                                Image Url:
                            </label>   
                        </th>  
                        <td>  
                            <input id="image_url_input" type="text" name="image_url" size="20" value="<?php echo $current_slide->image_url; ?>" />  
                            <input id="image_url_button" type="button" value="Upload Image" />
                        </td>  
                    </tr>  
                    <tr valign="top">  
                        <th scope="row">  
                            <label for="link_url">  
                                Link Url:
                            </label>   
                        </th>  
                        <td>  
                            <input id="link_url_input" type="text" name="link_url" size="20" value="<?php echo $current_slide->link_url; ?>" />  
                        </td>  
                    </tr>  
                    <tr valign="top">  
                        <th scope="row">  
                            <label for="position">  
                                Position:
                            </label>   
                        </th>  
                        <td>  
                            <input id="position_input" type="text" name="position" value="<?php echo $current_slide->position; ?>" />  
                        </td>  
                    </tr>  
                    <tr valign="top">  
                        <th scope="row">  
                        </th>  
                        <td>  
                            <?php if($current_slide->recnum >0) { ?>
                                <input type="submit" value="Update" class="button-primary"/> 
                                <input type="button" value="Reset" onclick="window.location.href = window.location.href;" />
                            <?php } else { ?>
                                <input type="submit" value="Add" class="button-primary"/> 
                            <?php } ?>
                        </td>  
                    </tr> 
                </table>  

            </form>  
            <h3>Current Slides</h3>
            <table border="1">
                <tr><th>Image</th><th>Link</th><th>Position</th></tr>
                <?php
                    foreach(GallerySlide::GetSlides() as $slide)
                    {
                        ?><tr><td><img src="<?php echo $slide->image_url; ?>" width="250px" /></td>
                            <td><?php echo $slide->link_url; ?></td>
                            <td><?php echo $slide->position; ?></td>
                            <td>
                                <form method="POST" action="">  
                                    <input type="hidden" name="edit_slide" value="Y" />  
                                    <input type="hidden" name="recnum" value="<?php echo $slide->recnum; ?>" />  
                                    <input type="submit" value="Edit" />
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="">  
                                    <input type="hidden" name="delete_slide" value="Y" />  
                                    <input type="hidden" name="recnum" value="<?php echo $slide->recnum; ?>" />  
                                    <input type="submit" value="Delete" />
                                </form>
                            </td>
                        </tr><?php
                    }
                ?>                
            </table>
            
        </div>
        <script typ="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#image_url_button').click(function() {
                formfield = jQuery('#image_url_input').attr('name');
                tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
                return false;
               });
               window.send_to_editor = function(html) {
                imgurl = jQuery('img',html).attr('src');
                jQuery('#image_url_input').val(imgurl);
                tb_remove();
            }
        });
        </script>
        <?php
    }
}

?>
