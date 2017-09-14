<?php
/**
 * Displays the user interface for the CBB Manager meta box by type content Contacts.
 *
 * This is a partial template that is included by the CBB Manager
 * Admin class that is used to display all of the information that is related
 * to the page meta data for the given page.
 */
?>
<div id="mb-contacts-id">
    <?php
        $values = get_post_custom(get_the_ID());

        $name = isset($values['mb_name']) ? esc_attr($values['mb_name'][0]) : '';
        $email = isset($values['mb_email']) ? esc_attr($values['mb_email'][0]) : '';
        $message = isset($values['mb_message']) ? esc_attr($values['mb_message'][0]) : '';
        $local = isset($values['mb_local']) ? esc_attr($values['mb_local'][0]) : '';
        
        wp_nonce_field('contacts_meta_box_nonce', 'meta_box_nonce');
    ?>

    <!-- Name-->
    <p class="content-mb">
        <label for="mb_name">Nombre: </label>
        <input type="text" name="mb_name" id="mb_name" value="<?php echo $name; ?>" />
    </p>
    
    <!-- Email-->
    <p class="content-mb">
        <label for="mb_email">Correo electrónico: </label>
        <input type="text" name="mb_email" id="mb_email" value="<?php echo $email; ?>" />
    </p>
    
    <!-- Message-->
    <p class="content-mb">
        <label for="mb_message">Mensaje: </label>
        <textarea name="mb_message" id="mb_message" rows="5"><?php echo $message; ?></textarea>
    </p>
    
    <!-- Local -->
    <?php
        $args = [
            'post_type' => 'locals',
            'posts_per_page' => -1,
            'post_parent' => 0,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ];
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) :
    ?>
        <p class="content-mb">
            <label for="mb_local">Sede: </label>
            <select name="mb_local" id="mb_sede">
                <option value="">-- No ha seleccionado Sede --</option>
                <?php while ($the_query->have_posts()) : ?>
                    <?php $the_query->the_post(); ?>
                    <option value="<?php echo get_the_ID(); ?>" <?php selected($local, get_the_ID()); ?>><?php the_title(); ?></option>
                <?php endwhile; ?>
            </select>
        </p>
    <?php
        endif;
        wp_reset_postdata();
    ?>
</div><!-- #single-post-meta-manager -->