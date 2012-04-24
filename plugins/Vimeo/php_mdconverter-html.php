<?php
define('VIMEO_WIDTH', 400); // depends on theme width
define('VIMEO_HEIGHT', 244); // 400/640 * 390
$html = preg_replace('/(<a href=")?https?:\/\/(www\.)?vimeo\.com\/(\d+)(">(.*)<\/a>)?/', '${5}<br><iframe class="vimeoplayer" width="'.VIMEO_WIDTH.'" height="'.VIMEO_HEIGHT.'" src="http://player.vimeo.com/video/${3}" style="border:none;"></iframe>', $html);
?>
