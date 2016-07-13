# Let largemap fill the whole window.
map_resize = ()->
    jQuery('.largemap').each ()->
        jQuery(@).height (jQuery(window).height() * 0.8)

    return

window.onresize = map_resize
jQuery(document).ready map_resize
