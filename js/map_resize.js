// Generated by CoffeeScript 1.10.0
(function() {
  var map_resize;

  map_resize = function() {
    jQuery('.largemap').each(function() {
      return jQuery(this).height(jQuery(window).height() * 0.8);
    });
  };

  window.onresize = map_resize;

  jQuery(document).ready(map_resize);

}).call(this);
