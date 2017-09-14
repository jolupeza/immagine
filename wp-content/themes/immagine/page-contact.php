<?php
/**
 * Template Name: Haz tu reserva
 */
?>
<?php $slugPage = sanitize_title(get_the_title()); ?>

<section class="Page Page--contact" id="<?php echo $slugPage; ?>">
  <?php
    $backgroundUrl = wp_get_attachment_url(get_post_thumbnail_id(get_the_id()));
    $styleBackground = $backgroundUrl ? 'style="background-image: url(\'' . $backgroundUrl . '\')"' : '';
  ?>
  <section class="Contact"<?php echo $styleBackground; ?>>
    <div class="container">
      <section class="Contact-wrapper">
        <article class="Contact-form">
          <h2 class="h1 text-white text-center text-uppercase"><?php echo has_excerpt() ? get_the_excerpt() : get_the_title(); ?></h2>
          <article class="text-white text-center">
            <?php the_content(); ?>
          </article>

          <form action="" class="Form" method="POST" id="js-frm-contact">
            <div class="form-group">
              <label for="contact_name" class="sr-only">Nombre</label>
              <input type="text" class="form-control" name="contact_name" id="contact_name" placeholder="Nombre" autocomplete="off" required />
            </div>

            <div class="form-group">
              <label for="contact_email" class="sr-only">Correo electrónico</label>
              <input type="email" class="form-control" name="contact_email" id="contact_email" placeholder="Correo electrónico" autocomplete="off" required>
            </div>

            <div class="form-group">
              <label for="contact_phone" class="sr-only">Teléfono</label>
              <input type="text" class="form-control" name="contact_phone" id="contact_phone" placeholder="Teléfono" autocomplete="off" minlength="7" maxlength="9" data-fv-stringlength-message="Debe contener 7 ó 9 dígitos" required>
            </div>

            <?php
              $services = get_terms([
                'taxonomy' => 'contact_services',
                'hide_empty' => false,
                'orderby' => 'term_id',
                'order' => 'ASC'
              ]);

              if (count($services)) :
            ?>
              <div class="form-group">
                <label for="contact_service" class="sr-only">Servicio</label>
                <select name="contact_service" id="contact_service" class="form-control" required data-fv-notempty-message="Debe indicar que servicio le interesa">
                  <option value="">¿Qué servicio te interesa?</option>
                  <?php foreach ($services as $service) : ?>
                    <option value="<?php echo $service->term_id ?>"><?php echo $service->name; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            <?php endif; ?>

            <div class="form-group">
              <label for="contact_message" class="sr-only">Escribe tu mensaje</label>
              <textarea class="form-control" name="contact_message" id="contact_message" placeholder="Escribe tu mensaje" required></textarea>
            </div>

            <p class="text-center" id="js-form-contact-msg"></p>

            <p class="Form-button text-center">
              <button type="submit" class="Button Button--red Button--red--invert text-uppercase">enviar <span class="Form-loader rotateIn hidden" id="js-form-contact-loader"><i class="glyphicon glyphicon-refresh"></i></span></button>
            </p>
          </form>
        </article>
      </section>
    </div>
  </section>
</section>
