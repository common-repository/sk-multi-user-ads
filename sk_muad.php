<?php
/*
Plugin Name: SK Multi User Ads
Plugin URI:
Description: Displays user ads on their own articles.
Author: Skipstorm
Version: 0.1.1
Author URI: http://www.skipstorm.org
*/

/* SK WP Settings Backup functions */
function sk_muad_getData(){
    return array('name' => 'Sk Multi User Ads', 'set_options' => 'sk_muad_setOptions', 'get_options' => 'sk_muad_getOptions');
}
function sk_muad_setOptions($data){
    @$data = unserialize($data);
    if(!$data || empty($data)){
        return false;
    } else {
        update_option('sk_muad', $data);
        return true;
    }
}
function sk_muad_getOptions(){
    return serialize(get_option('sk_muad'));
}

/* END SK WP Settings Backup functions */

$sk_muad = new sk_muad();
class sk_muad{
    function __construct(){
        $this->sk_muad();
    }
    function sk_muad(){
        $this->pluginName = 'SK Multi User Ads';
        $this->pluginOptKey = 'sk_muad';
        $this->defaultSettings = array(
            'minimum_user_level' => 3,
            'user_ads' => array(),
            'top_wrap_before' => '',
            'top_wrap_after' => '',
            'bottom_wrap_before' => '',
            'bottom_wrap_after' => '',
            'default_top_ad' => '',
            'default_bottom_ad' => ''
        );
        $this->get_settings();
        $this->message = '';
        $this->errorMessage = '';

        add_action('admin_menu', array(&$this, 'admin_menu'));
        add_filter('the_content', array(&$this, 'apply_ads'));
        add_action('admin_head', array(&$this, 'css'));
    }

    function css(){
        echo '
            <style type="text/css">
                .muad p{border:1px #ddd solid; padding:20px; background:#eee; margin:10px;}
                .muad label{display:block; font-weight:bold;}
            </style>
        ';
    }

    function apply_ads($content){
        $uname = get_the_author();
            $this->defaultSettings = array(
            'minimum_user_level' => 3,
            'user_ads' => array(),
            'top_wrap_before' => '',
            'top_wrap_after' => '',
            'bottom_wrap_before' => '',
            'bottom_wrap_after' => '',
            'default_top_ad' => '',
            'default_bottom_ad' => ''
        );
        $top = empty($this->settings['user_ads'][$uname]['top_ad'])? $this->settings['default_top_ad'] : $this->settings['user_ads'][$uname]['top_ad'];
        $bottom = empty($this->settings['user_ads'][$uname]['top_ad'])? $this->settings['default_bottom_ad'] : $this->settings['user_ads'][$uname]['bottom_ad'];

        $top = $this->settings['top_wrap_before'].$top.$this->settings['top_wrap_after'];
        $bottom = $this->settings['bottom_wrap_before'].$bottom.$this->settings['bottom_wrap_after'];

        return $top.$content.$bottom;
    }

    function admin_menu(){
        add_submenu_page('users.php', $this->pluginName, 'Muad Admin', 9, basename(__FILE__), array(&$this, 'admin_panel'));
        add_submenu_page('users.php', $this->pluginName, 'Muad User Settings', ((is_numeric($this->settings['minimum_user_level']))? ceil($this->settings['minimum_user_level']) : 3), basename(__FILE__).'?opt=user', array(&$this, 'user_panel'));
    }
    function admin_panel(){
        if ('POST' == $_SERVER['REQUEST_METHOD']) {
	        $this->errorMessage = '';
            $this->message = 'Settings saved';
            foreach($_POST as $k => $v){
                if(isset($this->defaultSettings[$k]))
                    $this->settings[$k] = $v;
            }
            $this->settings = array_merge($this->settings, $_POST);
			update_option($this->pluginOptKey, $this->settings);
		}
        include(dirname(__FILE__).'/admin_options.php');
    }
    function user_panel(){
        get_currentuserinfo();
        global $user_login;
        global $display_name;
        $uname = empty($display_name)? $user_login : $display_name;
        if ('POST' == $_SERVER['REQUEST_METHOD']) {
	        $this->errorMessage = '';
            $this->message = 'Settings saved';
            
            $this->settings['user_ads'][$uname]['bottom_ad'] = $_POST['bottom_ad'];
            $this->settings['user_ads'][$uname]['top_ad'] = $_POST['top_ad'];
            
			update_option($this->pluginOptKey, $this->settings);
		}
        @$top_ad = $this->settings['user_ads'][$uname]['top_ad'];
        @$bottom_ad = $this->settings['user_ads'][$uname]['bottom_ad'];

        include(dirname(__FILE__).'/user_options.php');
    }

   	function get_settings()
	{
		if (!isset($this->settings)) {
			$this->settings = get_option($this->pluginOptKey);
			if (FALSE == $this->settings) {
				$this->settings = $this->defaultSettings;
			} else {
				$this->settings = array_merge($this->defaultSettings, $this->settings);
			}
		}
		return $this->settings;
	}
}
?>