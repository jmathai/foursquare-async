<?php
require_once 'config.php';
include "kernel/latitude.php";
?>
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" > 
<meta name="robots" content="noindex">
</head>
<body>
<div align="center"><img src="logo.png" /><br />
<?php

foreach ($places["results"] as $place) {
  $name=$place["name"];
  $ref=$place["reference"];
  $vic=$place["vicinity"];
  echo "<a href='check.php?new=1&ref=$ref'>$name</a> - $vic<br />";
}
echo "<hr /><a href='check.php?new=1'>Add venue</a><br />";
echo "<a href=\"http://maps.google.com/?q=$latitude,$longitude\">I at here!</a><br />";
?>
<hr />
<small>Power by 4sqr.</small>
</div>
</body> 
</html>
