<?php
$html = preg_replace('/<img src="(.+)" alt="(.*)">/', '<a class="fancybox" href="${1}"><img src="${1}" alt="${2}"></a>', $html);
?>
