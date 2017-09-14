<?php
/**
 * Displays the user interface for the CBB Manager meta box by type content Prestudents.
 *
 * This is a partial template that is included by the CBB Manager
 * Admin class that is used to display all of the information that is related
 * to the page meta data for the given page.
 */
?>
<div id="mb-prestudents-id">

    <?php
        $values = get_post_custom( get_the_ID() );
        
        $name = isset($values['mb_name']) ? esc_attr($values['mb_name'][0]) : '';
        $dni = isset($values['mb_dni']) ? esc_attr($values['mb_dni'][0]) : '';
        $phone = isset($values['mb_phone']) ? esc_attr($values['mb_phone'][0]) : '';
        $email = isset($values['mb_email']) ? esc_attr($values['mb_email'][0]) : '';
        $sede = isset($values['mb_sede']) ? esc_attr($values['mb_sede'][0]) : '';
        $sonName = isset($values['mb_sonName']) ? esc_attr($values['mb_sonName'][0]) : '';
        $schedule = isset($values['mb_schedule']) ? esc_attr($values['mb_schedule'][0]) : '';
        $year = isset($values['mb_year']) ? esc_attr($values['mb_year'][0]) : '';

        wp_nonce_field( 'prestudents_meta_box_nonce', 'meta_box_nonce' );
        
        $years = [];
        for ($i = 2017; $i <= 2100; $i++) {
            $years[$i] = $i;
        }
    ?>
    
    <h3>Datos del padre de familia</h3>
    
    <!-- Parent Name -->
    <p class="content-mb">
        <label for="mb_name">Nombre Completo: </label>
        <input type="text" name="mb_name" id="mb_name" value="<?php echo $name; ?>" />
    </p>
    
    <!-- DNI / CE -->
    <p class="content-mb">
        <label for="mb_dni">D.N.I. / C.E.: </label>
        <input type="text" name="mb_dni" id="mb_dni" value="<?php echo $dni; ?>" />
    </p>
    
    <!-- Teléfono / Celular -->
    <p class="content-mb">
        <label for="mb_phone">Teléfono / Celular: </label>
        <input type="text" name="mb_phone" id="mb_phone" value="<?php echo $phone; ?>" />
    </p>
    
    <!-- Correo electrónico -->
    <p class="content-mb">
        <label for="mb_email">Correo electrónico: </label>
        <input type="email" name="mb_email" id="mb_email" value="<?php echo $email; ?>" />
    </p>
    
    <!-- Sede -->
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
            <label for="mb_sede">Sede: </label>
            <select name="mb_sede" id="mb_sede">
                <?php while ($the_query->have_posts()) : ?>
                    <?php $the_query->the_post(); ?>
                    <option value="<?php echo get_the_ID(); ?>" <?php selected($sede, get_the_ID()); ?>><?php the_title(); ?></option>
                <?php endwhile; ?>
            </select>
        </p>
    <?php
        endif;
        wp_reset_postdata();
    ?>
        
    <!-- Schedule -->
    <?php
        $args = [
            'post_type' => 'schedules',
            'posts_per_page' => -1,
            'post_parent' => 0,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ];
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) :
    ?>
        <p class="content-mb">
            <label for="mb_schedule">Horario: </label>
            <select name="mb_schedule" id="mb_schedule">
                <?php while ($the_query->have_posts()) : ?>
                    <?php $the_query->the_post(); ?>
                <option value="<?php echo get_the_ID(); ?>" <?php selected($schedule, get_the_ID()); ?>><?php echo get_the_excerpt(); ?></option>
                <?php endwhile; ?>
            </select>
        </p>
    <?php
        endif;
        wp_reset_postdata();
    ?>
    
    <h3>Datos del hijo a postular</h3>
    
    <!-- Son Name -->
    <p class="content-mb">
        <label for="mb_sonName">Nombre Completo: </label>
        <input type="text" name="mb_sonName" id="mb_sonName" value="<?php echo $sonName; ?>" />
    </p>
    
    <!-- Year -->
    <p class="content-mb">
        <label for="mb_year">Año: </label>
        <select name="mb_year" id="mb_year">
            <?php foreach ($years as $key => $value) : ?>
                <option value="<?php echo $key; ?>" <?php selected($year, $key); ?>><?php echo $value; ?></option>
            <?php endforeach; ?>
        </select>
    </p>
</div><!-- #single-post-meta-manager -->