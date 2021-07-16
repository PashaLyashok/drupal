(function ($, Drupal) {
  Drupal.behaviors.myBehavior =  {
    attach: function (context, settings) {
      alert('Hello, Pasha!');
    }
  }
} (jQuery, Drupal));