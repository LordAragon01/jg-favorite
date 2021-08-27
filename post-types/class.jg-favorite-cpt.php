<?php

if(!class_exists('Jg_Favorite_Post_Type')){

    class Jg_Favorite_Post_Type{

        function __construct(){

            add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
            //Salvar Posts
            add_action('save_post', array($this, 'save_post'), 10, 2);

        }


        public function add_meta_boxes(){

            add_meta_box(
                'jg_favorite_meta_box',
                esc_html__('Choose as Favorite Post', 'jg-favorite'),
                array($this, 'add_inner_meta_boxes'),
                'post',
                'normal',
                'high'

            );

        }


        public function add_inner_meta_boxes($post){


            require_once(JG_FAVORITE_PATH . 'views/jg-favorite_metabox.php');


        }


        public function save_post($post_id){

            //Nounce Checkin
            if(isset($_POST['jg_favorite_nonce'])){

                if(!wp_verify_nonce($_POST['jg_favorite_nonce'], 'jg_favorite_nonce')){

                    return;
                }
                
            }

            //Verify Wp Autosave
            if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){

                return;

            }

            //Verify the correct Post Type

            if(isset($_POST['post_type']) && $_POST['post_type'] === 'post'){

                //Permission the user
                if(!current_user_can('edit_page', $post_id)){

                    return;

                }elseif(!current_user_can('edit_post', $post_id)){

                    return;

                }

            }


            //Info founder with inspect - Send a Post/Network
            if(isset($_POST['action']) && $_POST['action'] == 'editpost'){

              
                //Update Info about user choose
                $old_favorite_post = get_post_meta($post_id, 'favorite_post', true);
                $new_favorite_post = esc_attr($_POST['favorite_post']);


               if(empty($new_favorite_post)){

                    update_post_meta($post_id, 'favorite_post', '');

                } else {

                    update_post_meta($post_id, 'favorite_post', $new_favorite_post, $old_favorite_post);

                }
                
                

            }


        }

    }

}