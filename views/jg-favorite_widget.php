<?php

       $args_content = array(
            "post_type" => "post",
            "post_per_page" => -1,
            "status" => "publish",
            "order" => "ASC"
        );


    $post_loop = new WP_Query($args_content);


        if($post_loop->have_posts()):

            while($post_loop->have_posts()):

                $favorite_post = get_post_meta(get_the_ID(), 'favorite_post', true);

            $post_loop->the_post();

             

          
?>

        <h3 id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <a href="<?php the_permalink(); ?>">
                <?php

                    if($favorite_post === "no"){    

                    the_title(); 

                    }
                    
                ?>
            </a>
        </h3>
           
<?php   

            endwhile;       

            wp_reset_postdata();


    endif;  

?>