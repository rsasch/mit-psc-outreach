<?php 

function echoNavItem($url) {
	$html = 'href="' . $url . '" ';
	$pattern = '/' . str_replace("/", "\/", $url) . '$/';
	if (preg_match($pattern, $_SERVER["REQUEST_URI"])) {
		$html .= 'class="sel"';
	}
	return $html;
}
	