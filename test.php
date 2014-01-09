<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>API Test</title>
<script type="text/javascript">
<!--
function MM_showHideLayers() { //v9.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) 
  with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}
//-->
</script>
</head>

<body>
<div id="asdf" style="display:none;">ASDF</div>
<p>Started here</p>
<?php
	$currentQuery = 'http://api.worldweatheronline.com/free/v1/weather.ashx?q=oxford,uk&format=xml&num_of_days=5&key=5xj4ajnzaeem6mr9b8g8ggqb' ;
    $myWeather = simplexml_load_file($currentQuery);
	echo "<p>Request is for ".$myWeather->request->query ." and most recent observation was at ". $myWeather->current_condition->observation_time ."</p>" ;
?>

<p onmouseover="MM_showHideLayers('asdf','','show')">Got to here</p>
</body>
</html>
