<?php

class Jg_Favorite_Widget extends WP_Widget{  

    public function __construct(){

        $widget_options = array(
            'description' => __('Add this Widget for display your Favorite Post', 'jg-favorite')
        );

        parent::__construct(
            'jg-favorite',
            'Favorite Posts',
            $widget_options
        );

        add_action('widgets_init', function(){

            register_widget('Jg_Favorite_Widget');

        });

        if(is_active_widget(false, false, $this->id_base)){

            add_action('wp_enqueue_scripts', array($this, 'enqueue'));

        }

    }

    public function enqueue(){

        ob_start();

        wp_enqueue_style(
            'jg-favorite-style-css',
            JG_FAVORITE_URL . 'assets/css/style.css',
            array(),
            JG_FAVORITE_VERSION,
            'all'
        );

        wp_enqueue_script('bootstrap-js', JG_FAVORITE_URL . 'assets/js/bootstrap.min.js', array('jquery'), '4.4.1', true);
        wp_enqueue_style('bootstrap-css', JG_FAVORITE_URL . 'assets/css/bootstrap.min.css', array(), '4.4.1', 'all');

        return ob_get_clean();
    }

    public function form($instance){

        $title = isset($instance['title']) ? $instance['title'] : '';
        
    ?>
    
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title', 'joene-plugin'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>">
        </p>


    <?php

    }


    public function widget($args, $instance){


        $default_title = __('Favorite Posts', 'jg-favorite');
        $title = !empty($instance['title']) ? $instance['title'] : $default_title;
      
        echo $args['before_widget'];
            echo $args['before_title'];
                echo $title;
            echo $args['after_title'];

            require( JG_FAVORITE_PATH . 'views/jg-favorite_widget.php');

        echo $args['after_widget'];

    }

    public function update($new_instance, $old_instance){

        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);

        return $instance;

    }


}