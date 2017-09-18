<?php
/**
 * Displays the user interface for the Immagine Manager meta box by type content Page.
 *
 * This is a partial template that is included by the Immagine Manager
 * Admin class that is used to display all of the information that is related
 * to the page meta data for the given page.
 */
?>
<div id="mb-pages-id">

    <?php
        $values = get_post_custom( get_the_ID() );
        $responsive = isset( $values['mb_responsive'] ) ? esc_attr($values['mb_responsive'][0]) : '';

        wp_nonce_field( 'page_meta_box_nonce', 'meta_box_nonce' );
    ?>
    
    <fieldset class="GroupForm">
        <legend class="GroupForm-legend">Imagen Responsive</legend>

        <section class="GroupForm-flex GroupForm-flex--center">
            <div class="container-upload-file GroupForm-wrapperImage">
                <!--<h4 class="Fieldset-subtitle">Enlace PDF</h4>-->

                <p class="btn-add-file">
                    <a title="Agregar imagen" href="javascript:;" class="set-file button button-primary">Añadir Imagen</a>
                </p>

                <div class="hidden media-container">
                    <img src="<?php echo $responsive; ?>" alt="<?php //echo get_post_meta( $post->ID, 'slider-1-alt', true );  ?>" title="<?php //echo get_post_meta( $post->ID, 'slider-1-title', true );  ?>" />
                </div><!-- .media-container -->

                <p class="hidden">
                    <a title="Quitar imagen" href="javascript:;" class="remove-file button button-secondary">Quitar Imagen</a>
                </p>

                <p class="media-info">
                    <input class="hd-src" type="hidden" name="mb_responsive" value="<?php echo $responsive; ?>" />
                </p><!-- .media-info -->
            </div><!-- end container-upload-file -->
        </section>
    </fieldset>
</div><!-- #single-post-meta-manager -->