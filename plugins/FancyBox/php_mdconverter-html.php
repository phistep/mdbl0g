<?php
$html = preg_replace('/<img src="(.+)" alt="(.*)">/', '<a class="fancybox" href="${1}"><img src="${1}" alt="${2}"></a>', $html);
$html = preg_replace('/<img alt="(.*)" src="(.+)">/', '<a class="fancybox" href="${2}"><img src="${2}" alt="${1}"></a>', $html);
?>
