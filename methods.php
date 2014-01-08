<?php

function test($inputString) {
	echo "<p>".$inputString."</p>" ;
}

function getLocation($loc) {
	return urlencode(htmlspecialchars($loc)) ;
}

function makeTitle($loc) {
	if ($loc!="") {
		return "Weather Web App - weather for ".$loc ;
		// we've got a location!
	} else {
		$appTitle="Weather Web App - please enter a location";
		// default display for first hit on page
	}
}

function getUnits($units) {
	return urlencode(htmlspecialchars($units)) ;
}

function getRequestUri($l, $d) {
	/*
	 *	ALGORITHM FOR CREATING THE REQUEST URI
	 *	$l is location
	 *	$d is day number (1-5 is for particular day; 0 is all 5)
	 *
	 */
	
	global $API_KEY, $API_URI_ROOT ;
	 
	if ($d==0) {
		return $API_URI_ROOT . "q=". $l . "&format=xml&num_of_days=5&key=". $API_KEY ;
	} else {
		// need to figure out a date shift 
		return $API_URI_ROOT . "q=". $l . "&format=xml&num_of_days=1&key=".$API_KEY ;
	}
	 
}


?>