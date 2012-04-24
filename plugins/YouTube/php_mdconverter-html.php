<?php
define('YOUTUBE_WIDTH', 400); // depends on theme width
define('YOUTUBE_HEIGHT', 244); // 400/640 * 390
$html = preg_replace('/(<a href=")?https?:\/\/(www\.)?youtube\.com\/watch\?v=([A-Za-z0-9\-]+)(">(.*)<\/a>)?/', '${5}<br><iframe class="ytplayer" width="'.YOUTUBE_WIDTH.'" height="'.YOUTUBE_HEIGHT.'" src="http://www.youtube.com/embed/${3}" style="border:none;"></iframe>', $html);
$html = preg_replace('/(<a href=")?https?:\/\/(www\.)?youtu\.be\/([A-Za-z0-9\-]+)(">(.*)<\/a>)?/', '${5}<br><iframe class="ytplayer" width="'.YOUTUBE_WIDTH.'" height="'.YOUTUBE_HEIGHT.'" src="http://www.youtube.com/embed/${3}" style="border:none;"></iframe>', $html);
?>
