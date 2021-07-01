(function ($) {
  Drupal.behaviors.myModule94 = {
    attach: function (context, settings) {
      $(context).find('.block-1').once('add-paragraph').append('<p>' + document.querySelector("body").className + '</p>');
    }
  };
})(jQuery);
