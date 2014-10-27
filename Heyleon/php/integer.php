<?php 
// Author :
// GALLO Mathieu
// mattewphoenyx@hotmail.fr

// Return the number between min and max, or mon or max
function min_max($value, $min, $max) {
	if ($value < $min) return $min;
	elseif ($value > $max) return $max;
	else return $value;
}

?>