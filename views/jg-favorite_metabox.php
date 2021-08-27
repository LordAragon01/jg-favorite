<?php

    $meta = get_post_meta($post->ID);
    $favorite_post = get_post_meta($post->ID, 'favorite_post', true);

?>

<table class="form-table mv-slider-metabox"> 

    
    <input type="hidden" name="jg_favorite_nonce" value="<?php echo wp_create_nonce("jg_favorite_nonce"); ?>">

    <tr>
        <th>
            <span class="title"><?php esc_html_e('Favorite Post', 'jg-favorite'); ?></span>
        </th>
        <td>
            <label for="favorite_post_yes">Yes</label>
            <input 
                type="radio" 
                name="favorite_post" 
                id="favorite_post_yes" 
                class="regular-text link-text"
                value="yes"
            >
        </td>
        <td>
            <label for="favorite_post_no">No</label>
            <input 
                type="radio" 
                name="favorite_post" 
                id="favorite_post_no" 
                class="regular-text link-text"
                value="no"
            >
        </td>
    </tr>
               
</table>