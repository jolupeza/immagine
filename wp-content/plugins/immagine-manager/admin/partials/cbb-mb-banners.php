<?php
/**
 * Displays the user interface for the CBB Manager meta box by type content Banners.
 *
 * This is a partial template that is included by the CBB Manager
 * Admin class that is used to display all of the information that is related
 * to the page meta data for the given page.
 */
?>
<div id="mb-banners-id">

    <?php
        $values = get_post_custom( get_the_ID() );
        $url = isset($values['mb_url']) ? esc_attr($values['mb_url'][0]) : '';
        $target = isset($values['mb_target']) ? esc_attr($values['mb_target'][0]) : '';

        wp_nonce_field( 'banners_meta_box_nonce', 'meta_box_nonce' );
    ?>
    
    <!-- URL -->
    <p class="content-mb">
        <label for="mb_url">URL: </label>
        <input type="text" name="mb_url" id="mb_url" value="<?php echo $url; ?>" />
    </p>
    
    <!-- Target-->
    <p class="content-mb">
        <label for="mb_target">Mostrar en otra pestaña:</label>
        <input type="checkbox" name="mb_target" id="mb_target" <?php checked($target, 'on'); ?> />
    </p>
</div><!-- #mb-locals-id -->