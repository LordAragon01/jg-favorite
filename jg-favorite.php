<?php
/**
* Plugin Name: JG Favorite
* Plugin URI: https://www.linkedin.com/in/joene-goncalves/
* Description: Create a list the Favorite Posts 
* Version: 1.0
* Requires at least: 5.6
* Requires PHP: 7.0
* Author: Joene Gonçalves
* Author URI: https://www.linkedin.com/in/joene-goncalves/
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: jg-favorite
* Domain Path: /languages
*/

if(!defined('ABSPATH')){
    exit;
}

if(!class_exists('Jg_Favorite')){


    class Jg_Favorite{


        public function __construct(){

            $this->define_constants();

            require_once(JG_FAVORITE_PATH . 'post-types/class.jg-favorite-cpt.php');
            $cpt = new Jg_Favorite_Post_Type();

            require_once(JG_FAVORITE_PATH . 'widgets/class.jg-favorite-widget.php');
            $widgets = new Jg_Favorite_Widget();
        }

        /**
         * Define Constants
         */
       public function define_constants(){

        define('JG_FAVORITE_PATH', plugin_dir_path(__FILE__) );
        define('JG_FAVORITE_URL', plugin_dir_url(__FILE__));
        define('JG_FAVORITE_VERSION', '1.0.0');

       }
       
       /**
        * Activate Plugin and Create Page
        */
        public static function activate(){
            update_option('rewrite_rules', '');

        }

        /**
         * Deactivate Plugin
         */
        public static function deactivate(){
            flush_rewrite_rules();
        }

        /**
         * Uninstall Plugin
         */
        public static function uninstall(){
        
            delete_option('widget_jg-favorite');
        
            $posts = get_posts(
                array(
                    'post_type' => 'jg-favorite',
                    'number_posts' => -1,
                    'post_status' => 'any'
                )
            );
        
            foreach($posts as $post){
                
                wp_delete_post($post->ID, true);
        
            }
        
        }
    }

}

if(class_exists('Jg_Favorite')){

    register_activation_hook(__FILE__, array('Jg_Favorite', 'activate'));
    register_deactivation_hook(__FILE__, array('Jg_Favorite', 'deactivate'));
    register_uninstall_hook(__FILE__, array('Jg_Favorite', 'uninstall'));

    $jg_favorite = new Jg_Favorite();

}