'use strict';

var j = jQuery.noConflict();

(function ($) {
  var $win = j(window),
      $doc = j(document),
      $body = j('body'),
      sldServices;

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
      var bxViewport = bx.parent(),
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

      sldServices = bx.bxSlider({
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
              sldHistory.goToSlide(i);
              sldHistory.stopAuto();
              sldHistory.startAuto();
              return false;
          });
        }
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
  });
})(jQuery);
