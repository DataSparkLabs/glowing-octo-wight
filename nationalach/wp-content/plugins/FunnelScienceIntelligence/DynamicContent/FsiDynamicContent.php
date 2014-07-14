<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DynamicContentController
 *
 * @author rudyard
 */
class FsiDynamicContent {

    public function FsiDynamicContent() {
        add_action('admin_init', array(&$this, 'admin_init'));
        add_action('save_post', array(&$this, 'save_post'));
        //add_action('pre_get_posts', array(&$this, 'pre_get_posts'));
    }

    function admin_init() {
        add_meta_box("dynamic_content", "Dynamic Content", array(&$this, "render_dynamic_content_input"), "page", "normal", "low");
    }

    function render_dynamic_content_input() {
        global $post;
        $custom = get_post_custom($post->ID);
        $is_override = $custom["dynamic_is_override"][0];
        $keywords = $custom["dynamic_keywords"][0];
        $title = $custom["dynamic_title"][0];
        ?>
        <p><label>Is Override: </label><input type="checkbox" name="dynamic_is_override" value="true" <?php
        if ($is_override == 'true') {
            echo "checked=\"checked\"";
        }
        ?> /></p>
        <p><label>Keywords: </label><input type="text" name="dynamic_keywords" size="30" value="<?php echo $keywords; ?>" /></p>
        <p><label>Title: </label><input type="text" name="dynamic_title" size="30" value="<?php echo $title; ?>" /></p>
        <?php
    }

    function save_post($post_id) {
        // to prevent metadata or custom fields from disappearing...
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
          return $post_id;
        if ($_POST['post_type'] == 'page') {
            update_post_meta($post_id, 'dynamic_is_override', $_POST['dynamic_is_override']);
            update_post_meta($post_id, 'dynamic_keywords', $_POST['dynamic_keywords']);
            update_post_meta($post_id, 'dynamic_title', $_POST['dynamic_title']);
        }
    }

    public function GetDynamicPage()
    {
        global $post;
        $ret = &$post;
        $term = $_SESSION['keyterm'];       
        $search = $this->get_search_keyword();
        if(!empty($search))
        {
            $term = $search;
            $_SESSION['keyterm'] = $term;
        }
        if(!empty($_GET["keyword"]))
        {
            $term = $_GET["keyword"];
            $_SESSION['keyterm'] = $term;        
        }
        if(!empty($term))
        {
            $sub_args = array('post_type' => 'page', 'post_parent' => $ret->ID, 'orderby' => 'title', 'order' => 'ASC');
            $sub_posts = get_posts($sub_args);
            foreach($sub_posts as $sub_post)
            {
                $is_override = get_post_meta($sub_post->ID, 'dynamic_is_override', true);
                if ($is_override=='true') 
                {
                    $keywords = ' '.get_post_meta($sub_post->ID, 'dynamic_keywords', true);                    
                    if (strpos(strtolower($keywords), strtolower($term)) != false) 
                    {
                        $ret = &$sub_post;
                        break;
                    }
                }
            }
            wp_reset_postdata();
        }
        return $ret;
    }
    public function GetDynamicTitle($post)
    {
        $title = get_post_meta($post->ID, 'dynamic_title', true);
        if(strlen($title) == 0)
        {
            $title = get_the_title($post->parent);
        }
        return $title;
    }
    public function GetDynamicContent($post)
    {
        apply_filters('the_content', $post->post_content);
        return $post->post_content;
    }
    private function get_search_keyword() {
        $keyword = '';
        $referrer = $_SERVER['HTTP_REFERER'];
        if (!empty($referrer)) {
            $parts_url = parse_url($referrer);
            if(isset($parts_url['query']))
            {
                $query = $parts_url['query'];
            }
            else if (isset($parts_url['fragment']))
            {
                $query = $parts_url['fragment'];
            }
            if(!empty($query))
            {
                $parts_query = array();
                parse_str($query, $parts_query);
                if(isset($parts_query['q']))
                {
                    $keyword = $parts_query['q'];
                }
                else if (isset($parts_query['p']))
                {
                    $keyword = $parts_query['p'];
                }
            }           
        }
        return $keyword;
    }

}


?>
