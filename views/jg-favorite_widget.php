<?php

       $args_content = array(
            "post_type" => "post",
            "post_per_page" => -1,
            "status" => "publish",
            "order" => "ASC",
            "meta_key" => "favorite_post",
            "meta_value" => "yes"
        );


    $post_loop = new WP_Query($args_content);


        if($post_loop->have_posts()):

            while($post_loop->have_posts()):

            $post_loop->the_post();

          
?>

        <h3 id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <a href="<?php the_permalink(); ?>">
                <?php         

                    the_title(); 
                
                ?>
            </a>
        </h3>
           
<?php   
         
            endwhile;       

            wp_reset_postdata();


    endif;  

?>