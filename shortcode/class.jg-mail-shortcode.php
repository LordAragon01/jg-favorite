<?php 


if(!class_exists('Jg_Mail_Shortcode')){

    class Jg_Mail_Shortcode{


        public function __construct(){

            add_shortcode('jg_mail', array($this, 'add_shortcode'));

        }

        public function add_shortcode(){

            //ob_start();
            require(JG_MAIL_PATH . 'views/contact-us-shortcode.php');
            //return ob_end_clean();

        }


    }

}