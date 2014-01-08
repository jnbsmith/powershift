<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- 

	Weather Web App as per request from Powershift
    Please read the readme.txt file for dev plan and comments

-->
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Keep constants, variables and methods separate to aid readability -->
<?php

	include('appvars.php') ;
	include('methods.php') ;

?>

<head>
<?php
	// set up variables
	$location = getLocation($_POST['myLoc']) ;
	$appTitle = makeTitle ($location) ;
	$units = getUnits($_POST['myUnits']);

	// make api request uri
	$requestURI = getRequestUri($location, 0) ;
	// note the 0 is a code denoting max number of days (=5) to be used later to offset selected day

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title><?php echo $appTitle ; ?></title>
</head>

<body>

<form id="myForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] ; ?>"> <!-- ugly first - get the thing working! -->

    <p>
    	<label for="myLoc">Location (postcode or town)</label>
    	<input name="myLoc" type="text" id="myLoc" value="Oxford, UK" />
    </p>
    
    <p>
    	<input type="radio" name="myUnits" id="myUnitsI" value="Imperial" /> <label for="myUnitsI">Imperial</label><br />
        <input type="radio" name="myUnits" id="myUnitsM" value="Metric" /> <label for="myUnitsM">Metric</label><br />
        <input name="myUnits" type="radio" id="myUnitsU" value="UK" checked="checked"/> 
        <label for="myUnitsU">UK (Celcius, miles, mm)</label>
    </p>
    
    <p><input type="submit" value="Get the weather!" /></p>
    
</form>

<p>Debug:</p>
<p>Location: <?php echo $location ; ?><br />
Units: <?php echo $units ; ?></p>
<!-- Location has minimal XSS security (as this is a low-risk app); Units has same just in case. -->

<?php
	//test($requestURI);
	// make a weather object to look examine
	$myWeather = simplexml_load_file($requestURI);
	
	foreach ($myWeather->weather as $day) {
		echo "<p>";
		echo "<img src='". $day->weatherIconUrl ."' alt='".$day->weatherDesc."' style='float:left;' />" ;
		echo "Date: ". $day->date .": ".$day->weatherDesc."<br />" ;
		echo "Temp max/min: ". $day->tempMaxC ."/". $day->tempMinC ."<br />" ;
		echo "Rainfall: ". $day->precipMM ."mm<br />" ;
		echo "etc.<br />";
		echo "</p>";
	}


?>

</body>
</html>
