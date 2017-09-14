<?php
/**
 * Displays the user interface for the CBB Manager meta box by type content Parallaxs.
 *
 * This is a partial template that is included by the CBB Manager
 * Admin class that is used to display all of the information that is related
 * to the page meta data for the given page.
 */
?>
<div id="mb-parallaxs-id">

    <?php
        $values = get_post_custom( get_the_ID() );
        $title = isset($values['mb_title']) ? esc_attr($values['mb_title'][0]) : '';
        $alignTitle = isset($values['mb_alignTitle']) ? esc_attr($values['mb_alignTitle'][0]) : '';
        $legend = isset($values['mb_legend']) ? esc_attr($values['mb_legend'][0]) : '';
        $align = isset($values['mb_align']) ? esc_attr($values['mb_align'][0]) : '';
        $animate = isset($values['mb_animate']) ? esc_attr($values['mb_animate'][0]) : '';
        $url = isset($values['mb_url']) ? esc_attr($values['mb_url'][0]) : '';
        $page = isset($values['mb_page']) ? (int)esc_attr($values['mb_page'][0]) : '';
        $text = isset($values['mb_text']) ? esc_attr($values['mb_text'][0]) : '';
        $target = isset($values['mb_target']) ? esc_attr($values['mb_target'][0]) : '';
        $responsive = isset( $values['mb_responsive'] ) ? esc_attr($values['mb_responsive'][0]) : '';

        wp_nonce_field( 'parallaxs_meta_box_nonce', 'meta_box_nonce' );
    ?>
    
    <!-- Title -->
    <p class="content-mb">
        <label for="mb_title">Título: </label>
        <input type="text" name="mb_title" id="mb_title" value="<?php echo $title; ?>" />
    </p>
    
    <!--Align Title-->
    <p class="content-mb">
        <label for="mb_alignTitle">Alineación Título:</label>
        <select name="mb_alignTitle" id="mb_alignTitle">
            <option value="" <?php selected($alignTitle, ''); ?>>-- Seleccione alineación --</option>            
            <option value="left" <?php selected($alignTitle, 'left'); ?>>Izquierda</option>
            <option value="center" <?php selected($alignTitle, 'center'); ?>>Centrado</option>
            <option value="right" <?php selected($alignTitle, 'right'); ?>>Derecha</option>
        </select>
    </p>
    
    <!-- Legend -->
    <p class="content-mb">
        <label for="mb_legend">Leyenda: </label>
        <input type="text" name="mb_legend" id="mb_legend" value="<?php echo $legend; ?>" />
    </p>
    
    <!--Align Caption-->
    <p class="content-mb">
        <label for="mb_align">Alineación texto:</label>
        <select name="mb_align" id="mb_align">
            <option value="" <?php selected($align, ''); ?>>-- Seleccione alineación --</option>            
            <option value="left" <?php selected($align, 'left'); ?>>Izquierda</option>
            <option value="full" <?php selected($align, 'full'); ?>>Centrado</option>
            <option value="right" <?php selected($align, 'right'); ?>>Derecha</option>
        </select>
    </p>
    
    <!-- Texto enlace-->
    <p class="content-mb">
        <label for="mb_text">Texto enlace: </label>
        <input type="text" name="mb_text" id="mb_text" value="<?php echo $text; ?>" />
    </p>
    
    <!-- URL-->
    <p class="content-mb">
        <label for="mb_url">Url: </label>
        <input type="text" name="mb_url" id="mb_url" value="<?php echo $url; ?>" />
    </p>
    
    <!-- Target-->
    <p class="content-mb">
        <label for="mb_target">Mostrar en otra pestaña:</label>
        <input type="checkbox" name="mb_target" id="mb_target" <?php checked($target, 'on'); ?> />
    </p>
    
    <?php
        $args = [
            'post_type' => 'page',
            'posts_per_page' => -1,
            'post_parent' => 0
        ];
        $pages = new WP_Query($args);

        if ($pages->have_posts()) :
    ?>
        <p class="content-mb">
            <label for="mb_page">Seleccionar página a enlazar</label>
            <select name="mb_page" id="mb_page">
                <option value="" <?php selected($page, ''); ?>>-- Seleccione página a enlazar --</option>

                <?php while ($pages->have_posts()) : ?>
                    <?php $pages->the_post(); ?>
                <option value="<?php echo get_the_ID(); ?>" <?php selected($page, get_the_ID()); ?>><?php the_title(); ?></option>
                <?php endwhile; ?>

            </select>
        </p>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
    
    <!--Animation-->
    <p class="content-mb">
        <label for="mb_animate">Animación:</label>
        <select name="mb_animate" id="mb_animate">
            <option value="" <?php selected($animate, ''); ?>>-- Seleccione animación --</option>            
            <option value="bounce" <?php selected($animate, 'bounce'); ?>>Bounce</option>
            <option value="flash" <?php selected($animate, 'flash'); ?>>Flash</option>
            <option value="pulse" <?php selected($animate, 'pulse'); ?>>Pulse</option>
            <option value="rubberBand" <?php selected($animate, 'rubberBand'); ?>>RubberBand</option>
            <option value="shake" <?php selected($animate, 'shake'); ?>>Shake</option>
            <option value="swing" <?php selected($animate, 'swing'); ?>>Swing</option>
            <option value="tada" <?php selected($animate, 'tada'); ?>>Tada</option>
            <option value="wobble" <?php selected($animate, 'wobble'); ?>>Wobble</option>
            <option value="jello" <?php selected($animate, 'jello'); ?>>Jello</option>
            <option value="bounceIn" <?php selected($animate, 'bounceIn'); ?>>BounceIn</option>
            <option value="bounceInDown" <?php selected($animate, 'bounceInDown'); ?>>BounceInDown</option>
            <option value="bounceInLeft" <?php selected($animate, 'bounceInLeft'); ?>>BounceInLeft</option>
            <option value="bounceInRight" <?php selected($animate, 'bounceInRight'); ?>>BounceInRight</option>
            <option value="bounceInUp" <?php selected($animate, 'bounceInUp'); ?>>BounceInUp</option>
            <option value="fadeIn" <?php selected($animate, 'fadeIn'); ?>>FadeIn</option>
            <option value="fadeInDown" <?php selected($animate, 'fadeInDown'); ?>>FadeInDown</option>
            <option value="fadeInDownBig" <?php selected($animate, 'fadeInDownBig'); ?>>FadeInDownBig</option>
            <option value="fadeInRight" <?php selected($animate, 'fadeInRight'); ?>>FadeInRight</option>
            <option value="fadeInRightBig" <?php selected($animate, 'fadeInRightBig'); ?>>FadeInRightBig</option>
            <option value="fadeInUp" <?php selected($animate, 'fadeInUp'); ?>>FadeInUp</option>
            <option value="fadeInUpBig" <?php selected($animate, 'fadeInUpBig'); ?>>FadeInUpBig</option>
            <option value="fadeInLeft" <?php selected($animate, 'fadeInLeft'); ?>>FadeInLeft</option>
            <option value="fadeInLeftBig" <?php selected($animate, 'fadeInLeftBig'); ?>>FadeInLeftBig</option>
            <option value="fadeOut" <?php selected($animate, 'fadeOut'); ?>>FadeOut</option>
            <option value="fadeOutDown" <?php selected($animate, 'fadeOutDown'); ?>>FadeOutDown</option>
            <option value="fadeOutDownBig" <?php selected($animate, 'fadeOutDownBig'); ?>>FadeOutDownBig</option>
            <option value="fadeOutLeft" <?php selected($animate, 'fadeOutLeft'); ?>>FadeOutLeft</option>
            <option value="fadeOutLeftBig" <?php selected($animate, 'fadeOutLeftBig'); ?>>FadeOutLeftBig</option>
            <option value="fadeOutRight" <?php selected($animate, 'fadeOutRight'); ?>>FadeOutRight</option>
            <option value="fadeOutRightBig" <?php selected($animate, 'fadeOutRightBig'); ?>>FadeOutRightBig</option>
            <option value="fadeOutUp" <?php selected($animate, 'fadeOutUp'); ?>>FadeOutUp</option>
            <option value="fadeOutUpBig" <?php selected($animate, 'fadeOutUpBig'); ?>>FadeOutUpBig</option>
            <option value="lightSpeedIn" <?php selected($animate, 'lightSpeedIn'); ?>>LightSpeedIn</option>
            <option value="lightSpeedOut" <?php selected($animate, 'lightSpeedOut'); ?>>LightSpeedOut</option>
            <option value="rotateIn" <?php selected($animate, 'rotateIn'); ?>>RotateIn</option>
            <option value="rotateInDownLeft" <?php selected($animate, 'rotateInDownLeft'); ?>>RotateInDownLeft</option>
            <option value="rotateInDownRight" <?php selected($animate, 'rotateInDownRight'); ?>>RotateInDownRight</option>
            <option value="rotateInUpLeft" <?php selected($animate, 'rotateInUpLeft'); ?>>RotateInUpLeft</option>
            <option value="rotateInUpRight" <?php selected($animate, 'rotateInUpRight'); ?>>rotateInUpRight</option>
            <option value="rotateOut" <?php selected($animate, 'rotateOut'); ?>>RotateOut</option>
            <option value="rotateOutDownLeft" <?php selected($animate, 'rotateOutDownLeft'); ?>>RotateOutDownLeft</option>
            <option value="rotateOutDownRight" <?php selected($animate, 'rotateOutDownRight'); ?>>RotateOutDownRight</option>
            <option value="rotateOutUpLeft" <?php selected($animate, 'rotateOutUpLeft'); ?>>RotateOutUpLeft</option>
            <option value="rotateOutUpRight" <?php selected($animate, 'rotateOutUpRight'); ?>>rotateOutUpRight</option>
            <option value="slideInUp" <?php selected($animate, 'slideInUp'); ?>>SlideInUp</option>
            <option value="slideInDown" <?php selected($animate, 'slideInDown'); ?>>SlideInDown</option>
            <option value="slideInLeft" <?php selected($animate, 'slideInLeft'); ?>>SlideInLeft</option>
            <option value="slideInRight" <?php selected($animate, 'slideInRight'); ?>>SlideInRight</option>
            <option value="slideOutUp" <?php selected($animate, 'slideOutUp'); ?>>slideOutUp</option>
            <option value="slideOutDown" <?php selected($animate, 'slideOutDown'); ?>>slideOutDown</option>
            <option value="slideOutLeft" <?php selected($animate, 'slideOutLeft'); ?>>slideOutLeft</option>
            <option value="slideOutRight" <?php selected($animate, 'slideOutRight'); ?>>slideOutRight</option>
            <option value="zoomIn" <?php selected($animate, 'zoomIn'); ?>>ZoomIn</option>
            <option value="zoomInUp" <?php selected($animate, 'zoomInUp'); ?>>ZoomInUp</option>
            <option value="zoomInDown" <?php selected($animate, 'zoomInDown'); ?>>ZoomInDown</option>
            <option value="zoomInLeft" <?php selected($animate, 'zoomInLeft'); ?>>ZoomInLeft</option>
            <option value="zoomInRight" <?php selected($animate, 'zoomInRight'); ?>>ZoomInRight</option>
            <option value="zoomOut" <?php selected($animate, 'zoomOut'); ?>>ZoomOut</option>
            <option value="zoomOutUp" <?php selected($animate, 'zoomOutUp'); ?>>ZoomOutUp</option>
            <option value="zoomOutDown" <?php selected($animate, 'zoomOutDown'); ?>>ZoomOutDown</option>
            <option value="zoomOutLeft" <?php selected($animate, 'zoomOutLeft'); ?>>ZoomOutLeft</option>
            <option value="zoomOutRight" <?php selected($animate, 'zoomOutRight'); ?>>ZoomOutRight</option>
            <option value="jackInTheBox" <?php selected($animate, 'jackInTheBox'); ?>>JackInTheBox</option>
            <option value="rollIn" <?php selected($animate, 'rollIn'); ?>>RollIn</option>
            <option value="rollOut" <?php selected($animate, 'rollOut'); ?>>RollOut</option>
        </select>
    </p>
    
    <h3 class="Animation text-center animated" id="js-animate">Probar animación</h3>
    
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
</div><!-- #mb-parallaxs-id -->