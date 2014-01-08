<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- 

	Weather Web App as per request from Powershift
    Please read the readme.txt file for dev plan and comments

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php

	if ($_POST['myLoc']!="") {
		// echo "yay" ;
		$appTitle="Weather Web App - gonna fill this bit in later";
		// do stuff!
	} else {
		// echo "no :-(";
		$appTitle="Weather Web App - please enter a location";
		// default display for first hit on page
	}

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
        <input type="radio" name="myUnits" id="myUnitsU" value="UK" checked="checked"/> 
        <label for="myUnitsU">UK (Celcius, miles, mm)</label>
    </p>
    
    <p><input type="submit" value="Get the weather!" /></p>
    
</form>

<p>Debug:</p>
<p>Location: <?php echo htmlspecialchars($_POST['myLoc']) ; ?><br />
Units: <?php echo htmlspecialchars($_POST['myUnits']) ; ?></p>
<!-- Location has minimal XSS security (as this is a low-risk app); Units has same just in case. -->
</body>
</html>
