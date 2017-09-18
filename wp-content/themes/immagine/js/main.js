'use strict';

var j = jQuery.noConflict();

(function ($) {
  var $win = j(window),
      $doc = j(document),
      $body = j('body'),
      sldServices = [];

  function affixHeader() {
    j('.Header').affix({
      offset: {
        top: function () {
          return 20;
        }
      }
    });
  }

  function bxSliderServices() {
    var bx = j('.Services');

    if (bx.length) {
      bx.each(function(index) {
        var $this = j(this),
            id = $this.data('id'),
            bxViewport = $this.parent(),
            widthBxSlider = parseInt(bxViewport.width()),
            slides = 0;

        if ($win.width() > 991) {
          widthBxSlider = widthBxSlider / 3;
          slides = 3;
        } else if ($win.width() > 600) {
          widthBxSlider = widthBxSlider / 2;
          slides = 2;
        } else {
          widthBxSlider = 0;
          slides = 1;
        }

        sldServices[index] = {
          'id': id,
          'bx': bx.bxSlider({
              auto: true,
              autoHover: true,
              minSlides: slides,
              maxSlides: slides,
              moveSlides: 1,
              slideWidth: widthBxSlider,
              slideMargin: 25,
              pager: false,
              prevText: '<i class="icon-keyboard_arrow_left"></i>',
              nextText: '<i class="icon-keyboard_arrow_right"></i>',
              onSliderLoad: function () {
                j('.bx-controls-direction a').on('click', function(){
                  var i = $(this).attr('data-slide-index');
                    sldServices[index].goToSlide(i);
                    sldServices[index].stopAuto();
                    sldServices[index].startAuto();
                    return false;
                });
              }
            })
        };
      });
    }
  }

  $win.on('scroll', function(event) {
    var arrow = j('.ArrowTop');

    if (j(this).scrollTop() > 150) {
      arrow.fadeIn();
    } else {
      arrow.fadeOut();
    }
  });

  $win.on('resize', function(){
    // var bx = j('.Services');
    //
    // if (bx.length) {
    //   var bxViewport = bx.parent(),
    //       widthBxSlider = parseInt(bxViewport.width()),
    //       slides = 0;
    //
    //   if ($win.width() > 991) {
    //     widthBxSlider = widthBxSlider / 3;
    //     slides = 3;
    //   } else if ($win.width() > 600) {
    //     widthBxSlider = widthBxSlider / 2;
    //     slides = 2;
    //   } else {
    //     widthBxSlider = 0;
    //     slides = 1;
    //   }
    //
    //   sldServices.reloadSlider({
    //     auto: true,
    //     autoHover: true,
    //     minSlides: slides,
    //     maxSlides: slides,
    //     moveSlides: 1,
    //     slideWidth: widthBxSlider,
    //     slideMargin: 25,
    //     pager: false,
    //     prevText: '<i class="icon-keyboard_arrow_left"></i>',
    //     nextText: '<i class="icon-keyboard_arrow_right"></i>',
    //     onSliderLoad: function () {
    //       j('.bx-controls-direction a').on('click', function(){
    //         var i = $(this).attr('data-slide-index');
    //           sldServices.goToSlide(i);
    //           sldServices.stopAuto();
    //           sldServices.startAuto();
    //           return false;
    //       });
    //     }
    //   });
    //}
  });

  $doc.on('ready', function() {
    affixHeader();

      bxSliderServices();

    j('.js-move-scroll').on('click', function(event) {
      event.preventDefault();

      var $this = j(this),
          dest = $this.attr('href');

      j('html, body').stop().animate({
        scrollTop: j(dest).offset().top
      }, 2000, 'easeInOutExpo');
    });

    j('.ArrowTop').on('click', function(event) {
      event.preventDefault();

      j('html, body').animate({scrollTop: 0}, 800, 'easeInOutExpo');
    });

    j('#js-frm-contact').formValidation({
      locale: 'es_ES',
      framework: 'bootstrap',
      icon: {
        valid: 'glyphicon glyphicon-ok',
        invalid: 'glyphicon glyphicon-remove',
        validating: 'glyphicon glyphicon-refresh'
      },
      fields: {
        'contact_phone': {
          validators: {
            regexp: {
              regexp: /^[0-9]+$/i,
              message: 'Ingresar sólo dígitos'
            }
          }
        }
      }
    }).on('err.field.fv', function(e, data){
      var field = e.target;
      j('small.help-block[data-bv-result="INVALID"]').addClass('hide');
    }).on('success.form.fv', function(e){
      e.preventDefault();

      var $form = j(e.target),
          fv = j(e.target).data('formValidation');

      var msg     = j('#js-form-contact-msg'),
          loader  = j('#js-form-contact-loader');

      loader.removeClass('hidden').addClass('infinite animated');
      msg.text('');

      var data = $form.serialize() + '&nonce=' + ImmagineAjax.nonce + '&action=register_contact';

      j.post(ImmagineAjax.url, data, function(data){
        $form.data('formValidation').resetForm(true);

        if (data.result) {
          msg.text('Ya tenemos su consulta. En breve nos pondremos en contacto con usted.').addClass('alert alert-success');
        } else {
          msg.text(data.error).addClass('alert alert-danger');
        }

        loader.addClass('hidden').removeClass('infinite animated');
        msg.fadeIn('slow');
        setTimeout(function(){
          msg.fadeOut('slow', function(){
              j(this).text('').removeClass('alert alert-success alert-danger');
          });
        }, 5000);
      }, 'json').fail(function(){
        alert('No se pudo realizar la operación solicitada. Por favor vuelva a intentarlo.');
      });
    });
  });
})(jQuery);
