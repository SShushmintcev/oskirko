<?php
/**
 * @package Huge IT portfolio
 * @author Huge-IT
 * @copyright (C) 2014 Huge IT. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @website		http://www.huge-it.com/
 **/
 
defined('_JEXEC') or die('Restricted access');

$lightbox_transition = $params->get('lightbox_transition');

$light_box_title = 'true';

$light_box_size_fix = $params->get('light_box_size_fix') == "1" ? 'true' : 'false';

$light_box_slideshow = $params->get('light_box_slideshow') == "1" ? 'true' : 'false';
$light_box_slideshowstart = $light_box_slideshow == 'true' ? $params->get('light_box_slideshowstart') : 'false';
$light_box_slideshowstop = $light_box_slideshow == 'true' ? $params->get('light_box_slideshowstop') : 'false';
$light_box_slideshowauto = $params->get('light_box_slideshowauto') == "1" ? 'true' : 'false';
$light_box_slideshowspeed = $params->get('light_box_slideshowspeed');

$light_box_loop = $params->get('light_box_loop') == "1" ? 'true' : 'false';
$light_box_fixed = $params->get('light_box_fixed') == "1" ? 'true' : 'false';
$light_box_open = $params->get('light_box_open') == "1" ? 'true' : 'false';
$light_box_speed = $params->get('light_box_speed');
$light_box_fadeout = $params->get('light_box_fadeout');
$light_box_opacity = $params->get('light_box_opacity');
$light_box_overlayclose = $params->get('light_box_overlayclose') == "1" ? 'true' : 'false';
$light_box_scalephotos = $params->get('light_box_scalephotos') == "1" ? 'true' : 'false';
$light_box_esckey = $params->get('light_box_esckey') == "1" ? 'true' : 'false';
$light_box_arrowkey = $params->get('light_box_arrowkey') == "1" ? 'true' : 'false';
$light_box_closebutton = $params->get('light_box_closebutton') == "1" ? 'true' : 'false';
$light_box_width = $params->get('light_box_width');
$light_box_height = $params->get('light_box_height');
$light_box_maxwidth = $params->get('light_box_maxwidth');
$light_box_maxheight = $params->get('light_box_maxheight');
$light_box_initialwidth = $params->get('light_box_initialwidth');
$light_box_initialheight = $params->get('light_box_initialheight');
$light_box_scrolling = $params->get('light_box_scrolling') == "1" ? 'true' : 'false';

$slider_title_position = $params->get('slider_title_position');

$lightbox_trapFocus = $params->get('light_box_trapfocus') == "1" ? 'true' : 'false';
$lightbox_fastIframe = $params->get('light_box_fastiframe') == "1" ? 'true' : 'false';
$lightbox_preloading = $params->get('light_box_preloading') == "1" ? 'true' : 'false';
$lightbox_reposition = $params->get('light_box_reposition') == "1" ? 'true' : 'false';
$lightbox_retinaImage = $params->get('light_box_retinaimage') == "1" ? 'true' : 'false';
$lightbox_retinaUrl = $params->get('light_box_retinaurl') == "1" ? 'true' : 'false';
$lightbox_retinaSuffix = $params->get('light_box_retinasuffix') == "1" ? 'true' : 'false';
$lightbox_html = $params->get('light_box_html') == "1" ? 'true' : 'false';
$lightbox_close = $params->get('light_box_close') == "1" ? 'true' : 'false';

?>
<script>
    var lightbox_transition = '<?php echo $lightbox_transition; ?>';
    var lightbox_speed = <?php echo $light_box_speed; ?>;
    var lightbox_fadeOut = <?php echo $light_box_fadeout; ?>;
    var lightbox_title = <?php echo $light_box_title; ?>;
    var lightbox_scalePhotos = <?php echo $light_box_scalephotos ?>;
    var lightbox_scrolling = <?php echo $light_box_scrolling ?>;
    var lightbox_opacity = <?php echo ($light_box_opacity / 100) + 0.001; ?>;
    var lightbox_open = <?php echo $light_box_open; ?>;
    var lightbox_returnFocus = 'false';
    var lightbox_trapFocus = <?php echo $lightbox_trapFocus; ?>;
    var lightbox_fastIframe = <?php echo $lightbox_fastIframe; ?>;
    var lightbox_preloading = <?php echo $lightbox_preloading; ?>;
    var lightbox_overlayClose = <?php echo $light_box_overlayclose; ?>;
    var lightbox_escKey = <?php echo $light_box_esckey; ?>;
    var lightbox_arrowKey = <?php echo $light_box_arrowkey; ?>;
    var lightbox_loop = <?php echo $light_box_loop; ?>;
    var lightbox_closeButton = <?php echo $light_box_closebutton; ?>;
    var lightbox_previous = "PREVIOUSE";
    var lightbox_next = "NEXT";
    var lightbox_close = "<?php echo $lightbox_close; ?>";
    var lightbox_html = "<?php echo $lightbox_html; ?>";
    var lightbox_photo = 'true';

    var lightbox_width = '<?php
if ($light_box_size_fix == 'false') {
    echo '';
} else {
    echo $light_box_width;
}
?>';
    var lightbox_height = '<?php
if ($light_box_size_fix == 'false') {
    echo '';
} else {
    echo $light_box_height;
}
?>';
    var lightbox_innerWidth = 'true';
    var lightbox_innerHeight = 'true';
    var lightbox_initialWidth = <?php echo $light_box_initialwidth; ?>;
    var lightbox_initialHeight = <?php echo $light_box_initialheight; ?>;
    var lightbox_maxWidth = <?php
if ($light_box_size_fix == 'true') {
    echo 'false';
} else {
    echo $light_box_maxwidth;
}
?>;
    var lightbox_maxHeight = <?php
if ($light_box_size_fix == 'true') {
    echo 'false';
} else {
    echo $light_box_maxwidth;
}
?>;
    var lightbox_slideshow = <?php echo $light_box_slideshow; ?>;
    var lightbox_slideshowSpeed = <?php echo $light_box_slideshowspeed; ?>;
    var lightbox_slideshowAuto = <?php echo $light_box_slideshowauto; ?>;
    var lightbox_slideshowStart = <?php echo $light_box_slideshowstart; ?>;
    var lightbox_slideshowStop = <?php echo $light_box_slideshowstop; ?>;
    var lightbox_fixed = <?php echo $light_box_fixed; ?>;

<?php
$pos = $slider_title_position;
switch ($pos) {
    case 1:
        ?>
            var lightbox_top = '10%';
            var lightbox_bottom = false;
            var lightbox_left = '10%';
            var lightbox_right = false;
        <?php
        break;
    case 1:
        ?>
            var lightbox_top = '10%';
            var lightbox_bottom = false;
            var lightbox_left = '10%';
            var lightbox_right = false;
        <?php
        break;
    case 2:
        ?>
            var lightbox_top = '10%';
            var lightbox_bottom = false;
            var lightbox_left = false;
            var lightbox_right = false;
        <?php
        break;
    case 3:
        ?>
            var lightbox_top = '10%';
            var lightbox_bottom = false;
            var lightbox_left = false;
            var lightbox_right = '10%';
        <?php
        break;
    case 4:
        ?>
            var lightbox_top = false;
            var lightbox_bottom = false;
            var lightbox_left = '10%';
            var lightbox_right = false;
        <?php
        break;
    case 5:
        ?>
            var lightbox_top = false;
            var lightbox_bottom = false;
            var lightbox_left = false;
            var lightbox_right = false;
        <?php
        break;
    case 6:
        ?>
            var lightbox_top = false;
            var lightbox_bottom = false;
            var lightbox_left = false;
            var lightbox_right = '10%';
        <?php
        break;
    case 7:
        ?>
            var lightbox_top = false;
            var lightbox_bottom = '10%';
            var lightbox_left = '10%';
            var lightbox_right = false;
        <?php
        break;
    case 8:
        ?>
            var lightbox_top = false;
            var lightbox_bottom = '10%';
            var lightbox_left = false;
            var lightbox_right = false;
        <?php
        break;
    case 9:
        ?>
            var lightbox_top = false;
            var lightbox_bottom = '10%';
            var lightbox_left = false;
            var lightbox_right = '10%';
        <?php
        break;
}
?>

    var lightbox_reposition = <?php echo $lightbox_reposition; ?>;
    var lightbox_retinaImage = <?php echo $lightbox_retinaImage; ?>;
    var lightbox_retinaUrl = <?php echo $lightbox_retinaUrl; ?>;
    var lightbox_retinaSuffix = "<?php echo $lightbox_retinaSuffix; ?>";
</script>
<script src="media/mod_lightbox/js/frontend/custom.js" type="text/javascript"></script>
<script src="media/mod_lightbox/js/frontend/jquery.colorbox.js" type="text/javascript"></script>

<?php
$light_box_style = $params->get("light_box_style");
$doc = JFactory::getDocument();
if ($light_box_style != 6) {
    JHtml::stylesheet('media/mod_lightbox/css/frontend/colorbox-' . $light_box_style . '.css');
}

