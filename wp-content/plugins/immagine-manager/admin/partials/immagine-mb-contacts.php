<?php
/**
 * Displays the user interface for the Immagine Manager meta box by type content Contacts.
 *
 * This is a partial template that is included by the Immagine Manager
 * Admin class that is used to display all of the information that is related
 * to the page meta data for the given page.
 */
?>
<div id="mb-contacts-id">
    <?php
        $values = get_post_custom(get_the_ID());

        $name = isset($values['mb_name']) ? esc_attr($values['mb_name'][0]) : '';
        $email = isset($values['mb_email']) ? esc_attr($values['mb_email'][0]) : '';
        $phone = isset($values['mb_phone']) ? esc_attr($values['mb_phone'][0]) : '';
        $message = isset($values['mb_message']) ? esc_attr($values['mb_message'][0]) : '';
        
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
    
    <!-- Phone-->
    <p class="content-mb">
        <label for="mb_phone">Teléfono: </label>
        <input type="text" name="mb_phone" id="mb_phone" value="<?php echo $phone; ?>" />
    </p>
    
    <!-- Message-->
    <p class="content-mb">
        <label for="mb_message">Mensaje: </label>
        <textarea name="mb_message" id="mb_message" rows="5"><?php echo $message; ?></textarea>
    </p>
</div><!-- #single-post-meta-manager -->