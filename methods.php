<?php
/*
 * Two functions provide simple cleansing of input
 * (not really necessary here)
 */
function getLocation($loc) {
	return htmlspecialchars($loc) ;
}

function getUnits($units) {
	return htmlspecialchars($units) ;	// Exact duplicate! Possible cull when refactoring.
}


// set the string for the page title
function makeTitle($loc) {
	if ($loc!="") {
		return "Weather Web App - weather for ". $loc ;
		// we've got a location!
	} else {
		$appTitle="Weather Web App - please enter a location";
		// default display for first hit on page
	}
}



/*
 * The next two functions are used for
 * maintaining state when reloading the page
 * First is the text input
 * Second is the radio options
 */
function formval($val) {
	if ($_POST['myLoc']!="") {
		return " value='". getLocation($_POST['myLoc']) ."' "; // value from previously entered form
	} else {
		return " value='". $val ."' "; // default value
	}
} 
 
function ischecked($val) {		
	if ($val == $_POST['myUnits'] or (!isset($_POST['myUnits']) and ($val == "UK"))) {
		return "checked='checked'";
	} else {
		return "";
	}
}



	/*
	 *	CREATE THE REQUEST URI
	 *	$l is location
	 */

function getRequestUri($l) {

	global $API_KEY, $API_URI_ROOT ;
	return $API_URI_ROOT . "q=". $l . "&format=xml&num_of_days=5&key=". $API_KEY ;

}


?>