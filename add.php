<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" > 
</head>
<body>
<div align="center"><img src="http://code.google.com/p/4sqr/logo?cct=1283331984" /><br />
<?
require_once 'EpiCurl.php';
require_once 'EpiFoursquare.php';
$clientId = 'GUU2AJRPK4LDBHIFQKTU31DXITIGLFKV1TOJGBJ2NRIKGFBW';
$clientSecret = 'CSW5BUGITZ2LNF0MMD5UPDTTZGGJ2PN01CSZYY0L4ARUHGCZ';
$redirectUri = 'http://shizhao.info/foursquare-async/simpleTest.php';
#$fsObj = new EpiFoursquare($clientId, $clientSecret, $accessToken);
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
<?
$array = array($address,$city,$state);

$adds = implode(", ", $array);

echo "$adds <br >"; 
$id=$venues->response->venue->id;
echo "<a href='check.php?id=$id&name=$name&add=$address&city=$city&state=$state'><b>Check in!</b></a><br />" ;
?>

</div>
</body> 
</html> 
