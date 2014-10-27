<?php 
// Author :
// GALLO Mathieu
// mattewphoenyx@hotmail.fr

// Prepare string for DataBase
// Trim and addslashes
function strToData($str) { return str_replace(array('"', "'"), array('\"', "\'"),trim($str)); }

// Prepare Post string for DataBase
function postToData($str) { 
	isPost($str, $res, 'Post inexistant');
	return strToData($res);
}

// Prepare Get string for DataBase
function getToData($str) { 
	isGet($str, $res, 'Get inexistant');
	return strToData($res);
}

// Delete bad characters for an e-mail string
function healMail($mail) {
	// Set the point at the good position
	if (in_array(substr($mail,-3),array('com','net'))) { $mail[strlen($mail)-4] = '.'; }
	elseif (in_array(substr($mail,-2),array('fr','lu','en','eu','be','it','ch','de','jp','es','tv'))) { $mail[strlen($mail)-3] = '.'; }
	// Delete " ", ":", and ";"
	return str_replace(array(' ',':',';'),array('','',''),$mail);
}

// Add a symbol and set a maximum size on the string
function trunc($text, $limit, $symbol='[...]') {
	if (strlen($text) > $limit) $text = substr($text,0,$limit-strlen($symbol)).$symbol;
	return $text;
};

// Removes all accents
function stripAccents($string){
	$accents = array('à','á','â','ã','ä','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ú','û','ü','ý','ÿ','À','Á','Â','Ã','Ä','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','Ù','Ú','Û','Ü','Ý');
	$noaccents = array ('a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','u','y','y','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','U','U','U','U','Y');
	return str_replace($accents,$noaccents,$string);
}

// Replace accents by HTML code
function AccentsHtml($string){
	$accents = array('à','á','â','ã','ä','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ú','û','ü','ý','ÿ','À','Á','Â','Ã','Ä','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','Ù','Ú','Û','Ü','Ý','«','»',"'",'’');
	$accentsHtml = array('&agrave;','&aacute;','&acirc;','&atilde;','&auml;','&ccedil;','&egrave;','&eacute;','&ecirc;','&euml;','&igrave;','&iacute;','&icirc;','&iuml;','&ntilde;','&ograve;','&oacute','&ocirc;','&otilde;','&ouml;','&ugrave;','&uacute;','&ucirc;','&uuml;','&yacute;','&yuml;','&Agrave;','&Aacute;','&Acirc;','&Atilde;','&Auml;','&Ccedil;','&Egrave;','&Eacute;','&Ecirc;','&Euml;','&Igrave;','&Iacute;','&Icirc;','&Iuml;','&Ntilde;','&Ograve;','&Oacute;','&Ograve;','&Otilde;','&Ouml;','&Ugrave;','&Uacute;','&Ucirc;','&Uuml;','&Yacute;','&laquo;','&raquo;','&rsquo;','&rsquo;');
	return str_replace($accents,$accentsHtml,$string);
}

// Up a string with accents
function strupper($string){
	$lower = array('à','á','â','ã','ä','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ú','û','ü','ý','ÿ');
	$upper = array ('À','Á','Â','Ã','Ä','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','Ù','Ú','Û','Ü','Ý');
	return str_replace($lower,$upper,strtoupper($string));
}

?>