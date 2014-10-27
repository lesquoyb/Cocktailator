<?php 
// Author :
// GALLO Mathieu
// mattewphoenyx@hotmail.fr

// Transform Array[1, 2, 3] in "1, 2, 3"
function arrayToString($array, $separator=', ', $before='', $after='') {
	foreach ($array as $subval) {
		if ($values != '') $values .= $separator;
		$values .= $before.$subval.$after;
	}
	return $values;
}

function queryToString($query, $separator=', ', $before='', $after='') {
	while( list($subval) = $query->fetch(PDO::FETCH_NUM) ) {
		if ($values != '') $values .= $separator;
		$values .= $before.$subval.$after;
	}
	return $values;
}

// Add in an array
function addArray($pos, &$array, $elt) {
	if ($pos > count($array)) { array_push($array, $elt); }
	else if ($pos <= 0) { array_unshift($array, $elt); }
	else {
		array_splice($array,$pos,0, array($elt));
	}
}

// Remove from an array
function remArray($pos, &$array) {
	if ($pos > count($array)-1) {
		return array_pop($array);
	} else if ($pos < 0) {
		return array_shift($array);
	}  else {
		return array_splice($array,$pos,1);
	}
}

// Move in an array
function moveArray(&$array, $last_pos, $new_pos) {
	$elt = $array[$last_pos];
	remArray($last_pos, $array);
	addArray($new_pos,$array, $elt);
}

// Return the first number free
function MaxId($array) {
	$i = 0;
	while (in_array($i,$array)) $i++;
	return $i;
}

?>