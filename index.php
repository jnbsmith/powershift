<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- 

	Weather Web App as per request from Powershift
    Please read the readme.txt file for dev plan and comments

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Keep constants, variables and methods separate to aid readability -->
<?php

	include('appvars.php') ;
	include('methods.php') ;



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
<link href="weatherapp.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
<!--
	function showHide(a) {
		// for debug
		window.alert(a);
		// show the detail for the element clicked; hide everything else
		idString = "day"+0 ;
		for (int i=0; i<=5; i++) {
			idString = "day"+i ;
			if (idString==a) {
				document.getElementById(a).style.display="block";
			} else {
				document.getElementById(a).style.display="none";
			}
		}
	}
// -->
</script>
</head>

<body>
<div id="wrapper">
    <div id="left_col">
      <form id="myForm" method="post" action="<?php echo $_SERVER['PHP_SELF'] ; ?>"> <!-- ugly first - get the thing working! -->
       
        <p>
          <label for="myLoc">Location (postcode or town)</label>
                <input name="myLoc" type="text" id="myLoc" <?php echo formval('Oxford, UK') ; ?> />
        </p>
            
            <p>
              <input type="radio" name="myUnits" id="myUnitsI" value="Imperial" <?php echo ischecked('Imperial') ; ?> /> <label for="myUnitsI">Imperial</label><br />
              <input type="radio" name="myUnits" id="myUnitsM" value="Metric" <?php echo ischecked('Metric') ; ?> /> <label for="myUnitsM">Metric</label><br />
                <input name="myUnits" type="radio" id="myUnitsU" value="UK" <?php echo ischecked('UK') ; ?>/> 
              <label for="myUnitsU">UK (Celcius, miles, mm)</label>
        </p>
    
            <p><input type="submit" value="Get the weather!" /></p>
            <p><a href="#" onclick="showHide('asdf')">asdf</a></p>
      </form>
    </div>
    
    <div id="right_col">
    
    <?php
        //test($requestURI);
        // make a weather object to look examine
        $myWeather = simplexml_load_file($requestURI);
        //var_dump(get_object_vars($myWeather)); // debug
    
        // only display stuff if an object is returned without an error
        if ($myWeather->error) {
            echo "<p>". $myWeather->error->msg ."</p>";
            echo "<p>Couldn't find any data for ". $location ." - please check spelling and try again</p>" ;
            
        } else {
            // good to go!
            
            // set up a counter variable for use later
            $counter = 0 ;
                
        
            /*
             * Now run through the days creating a summary box
             * linked to the full details. Easiest way is to run
             * through the list twice, in order to get the output
             * in the right order in the document. This duplication
             * could be ironed out at refactor stage but for this
             * app it's scarecely worthwhile.
             */
            
            // first loop: précis
            foreach ($myWeather->weather as $day) {
        		
				// because of the units choice we'll have to run 
				
                // create the visuals for this particular day in précis form
                echo "<div class='oneday' onmouseover='showHide(\'day".$counter."\')'>";
                echo "<p>";
                echo $day->date ."<br /><img src='". $day->weatherIconUrl ."' alt='".$day->weatherDesc."' />" ;
                echo "<br />".$day->weatherDesc ;
				
				echo "<br />";
				if ($units!="Imperial") {
	                echo "Temp range: ". $day->tempMinC ." - ". $day->tempMaxC ."&deg;C<br />" ;
				} else {
				    echo "Temp range: ". $day->tempMinF ." - ". $day->tempMaxF ."&deg;F<br />" ;
				}
				
                echo "</p>";
                echo "<p><a href='javascript:void(0);' onclick='showHide(\'day".$counter."\'); return false;'>details</a></p>";
                echo "</div>";
            
                $counter++ ;
            } // end of first foreach
        
            // for layout purposes
            echo "<br clear='all' />" ;
        
            // reset counter
            $counter = 0 ;
        
            // second loop: detail précis
            foreach ($myWeather->weather as $day) {
        
                // create the visuals for this particular day in full form
                echo "<div class='oneday_detail' id='day".$counter."'>";
                echo "<p>Details for ".$day->date;
                echo "<img src='". $day->weatherIconUrl ."' alt='".$day->weatherDesc."' />" ;
                echo "Date: ". $day->date .": ".$day->weatherDesc."<br />" ;
                echo "Temp max/min: ". $day->tempMaxC ."/". $day->tempMinC ."<br />" ;
                echo "Rainfall: ". $day->precipMM ."mm<br />" ;
                echo "</p>";
                echo "</div>";
                
                // increment the counter
                $counter++ ;
                
            } // end of second foreach
        } // end of main object checking if
    
    ?>
    </div>
</div>
</body>
</html>
