<?php
/**
 * Displays the user interface for the CBB Manager meta box by type content Locals.
 *
 * This is a partial template that is included by the CBB Manager
 * Admin class that is used to display all of the information that is related
 * to the page meta data for the given page.
 */
?>
<div id="mb-locals-id">

    <?php
        $values = get_post_custom( get_the_ID() );
        $address = isset($values['mb_address']) ? esc_attr($values['mb_address'][0]) : '';
        $phone = isset($values['mb_phone']) ? esc_attr($values['mb_phone'][0]) : '';
        $email = isset($values['mb_email']) ? esc_attr($values['mb_email'][0]) : '';
        $lat = isset($values['mb_lat']) ? esc_attr($values['mb_lat'][0]) : '';
        $long = isset($values['mb_long']) ? esc_attr($values['mb_long'][0]) : '';

        wp_nonce_field( 'locals_meta_box_nonce', 'meta_box_nonce' );
    ?>
    
    <!-- Address -->
    <p class="content-mb">
        <label for="mb_address">Dirección: </label>
        <input type="text" name="mb_address" id="mb_address" value="<?php echo $address; ?>" />
    </p>
    
    <!-- Phone -->
    <p class="content-mb">
        <label for="mb_phone">Teléfono: </label>
        <input type="text" name="mb_phone" id="mb_phone" value="<?php echo $phone; ?>" />
    </p>
    
    <!-- Email -->
    <p class="content-mb">
        <label for="mb_email">Correo electrónico Formulario de Contacto: </label>
        <input type="email" name="mb_email" id="mb_email" value="<?php echo $email; ?>" />
    </p>
    
    <!-- Latitud -->
    <p class="content-mb">
        <label for="mb_lat">Google Map Latitud: </label>
        <input type="text" name="mb_lat" id="mb_lat" value="<?php echo $lat; ?>" />
    </p>
    
    <!-- Longitud -->
    <p class="content-mb">
        <label for="mb_long">Google Map Longitud: </label>
        <input type="text" name="mb_long" id="mb_long" value="<?php echo $long; ?>" />
    </p>
</div><!-- #mb-locals-id -->