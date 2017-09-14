<?php
/**
 * Displays the user interface for the CBB Manager meta box by type content Schedules.
 *
 * This is a partial template that is included by the CBB Manager
 * Admin class that is used to display all of the information that is related
 * to the page meta data for the given page.
 */
?>
<div id="mb-schedules-id">

    <?php
        $values = get_post_custom( get_the_ID() );
        $local = isset($values['mb_local']) ? (int)esc_attr($values['mb_local'][0]) : '';
        $grade = isset($values['mb_grade']) ? (int)esc_attr($values['mb_grade'][0]) : '';

        wp_nonce_field( 'schedules_meta_box_nonce', 'meta_box_nonce' );
    ?>
    
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
        <select name="mb_local" id="mb_local">
            <option value="">-- Seleccionar Sede --</option>
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
    
    <?php
        $levels = get_terms([
          'taxonomy' => 'levels',
          'hide_empty' => false,
          'orderby' => 'term_id',
          'order' => 'ASC'
        ]);

        if (count($levels)) :
    ?>
        <p class="content-mb">
            <label for="mb_grade">Grado: </label>
            <select name="mb_grade" id="mb_grade">
                <option value="">-- Seleccionar Grado --</option>
                <?php foreach ($levels as $level) : ?>
                    <option value="<?php echo $level->term_id; ?>" <?php selected($grade, $level->term_id); ?>><?php echo $level->name; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
    <?php endif; ?>
</div><!-- #single-post-meta-manager -->