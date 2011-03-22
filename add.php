<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
<meta name="robots" content="noindex">
</head>
<body>
<div align="center"><img src="logo.png" /><br />
<?php
require_once 'kernel/EpiCurl.php';
require_once 'kernel/EpiFoursquare.php';
require_once 'config.php';
$fsObjUnAuth = new EpiFoursquare($clientId, $clientSecret, $_COOKIE['access_token']);


$name = $_POST['name'];
$address = $_POST['address'];
$crossstreet = $_POST['crossstreet'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$phone = $_POST['phone'];
$geolat = $_POST['geolat'];
$geolong = $_POST['geolong'];
$venues = $fsObjUnAuth->post("/venues/add", array(
    'name' => "{$name}", 'address' => "{$address}", 'crossStreet' => "{$crossstreet}", 'city'=>"{$city}", 'state'=>"{$state}", 'zip'=>"{$zip}", 'phone'=>"{$phone}",  'll' => "{$geolat},{$geolong}"
  ));
?>
<div align='center'>
Add new venue <strong> <? echo "$name" ?> </strong>, OK!<br >
<?php
$array = array($address,$city,$state);

$adds = implode(", ", $array);

echo "$adds <br >"; 
$id=$venues->response->venue->id;
echo "<a href='check.php?id=$id&name=$name&add=$address&city=$city&state=$state'><b>Check in!</b></a><br />" ;
?>
<hr />
<small>Power by 4sqr.</small>
</div>
</body> 
</html> 
