<?php
// Author :
// GALLO Mathieu
// mattewphoenyx@hotmail.fr

// return the difference (sec) from two dates AAAA-MM-JJ
function timeBetween($older, $newer) {
	
	if ($older > newer) {
		$older = $temp;
		$older = newer;
		$newer = $temp;
	}
	
	$y1 = intval(substr($older,0,4));
	$y2 = intval(substr($newer,0,4));
	$year = $y2 - $y1;

	$m1 = intval(substr($older,5,2));
	$m2 = intval(substr($newer,5,2));
	$month = $m2 - $m1;

	$d1 = intval(substr($older,8,2));
	$d2 = intval(substr($newer,8,2));
	$day = $d2 - $d1;

	$h1 = intval(substr($older,11,2));
	$h2 = intval(substr($newer,11,2));
	$hour = $h2 - $h1;

	$mi1 = intval(substr($older,14,2));
	$mi2 = intval(substr($newer,14,2));
	$minutes = $mi2 - $mi1;

	$s1 = intval(substr($older,17,2));
	$s2 = intval(substr($newer,17,2));
	$seconds = $s2 - $s1;

	if ($seconds < 0) {
		$minutes -= 1;
		$seconds += 60;
	}
	if ($minutes < 0) {
		$hour -= 1;
		$minutes += 60;
	}
	if ($hour < 0) {
		$day -= 1;
		$hour += 24;
	}
	if ($day < 0) {
		$month -=  1;
		$day += daysOnMonth($m2-1, $y2);
	}
	if ($month < 0) {
		$year -= 1;
		$month += 12;
	}
	return $seconds + 60*$minutes + 3600*$hour + 86400*$day + 86400*30*$month + 86400*30*12*$year;
}

// Return true if the year is Bissextile
function isBissextile($year) {
	// :4 and NOT :100, or :400
	return ( ( (($year % 4) == 0) && (($year % 100) != 0) ) || (($year % 400) == 0) );
}

// Return the amount of days in the month
function daysOnMonth($month, $year) {
	if (month <= 0) {
		$year -= 1;
		$month += 12;
	}
	if ( in_array( $month, array(4,6,9,11) ) ) return 30;
	elseif ($month == 2) {
		if ( isBissextile($year) ) return 29;
		else return 28;
	} else return 31;
}

function daysOnYear($year) {
	if (isBissextile($year)) return 366;
	else return 365;
}

?>