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
//$fsObjUnAuth->setAccessToken($_COOKIE['access_token']);

$id = $_POST['id'];
$shout = $_POST['shout'];
$name = $_POST['name'];
$geolat = $_POST['latitude'];
$geolong = $_POST['longitude'];
$photo = $_POST['media'];

if  ($_POST['privat']== NULL){
    $privat = 'public';
    if  ($_POST['facebook']== 1)
      $privat = 'public, facebook';
    if  ($_POST['twitter']== 1)
      $privat = 'public,facebook,twitter';
 }
else {
    $privat = 'private';
}

$checkin = $fsObjUnAuth->post('/checkins/add',array(
    'venueId' => "{$id}", 'venue' => "{$name}", 'shout'=>"{$shout}", 'broadcast' => "{$privat}", 'll' => "{$geolat},{$geolong}"
  ));

if  {$photo !=NULL){

$pcheckin = $fsObjUnAuth->post('/photos/add',array(
    'venueId' => "{$id}", 'broadcast' => "{$privat}", 'll' => "{$geolat},{$geolong}"
  ));
}

?>
<center>

<? 

$message = $checkin->notifications[0]->item->message;
$add = $checkin->response->checkin->venue ->location->address;
$mayor = $checkin->notifications[1]->item->message;
$score = $checkin->notifications[3]->item->scores;
$total = $checkin->notifications[3]->item->total;

?>
<?
$notification=$checkin ->notifications;
foreach ($notification as $notifications){
 if ($notifications -> type == "message"){
    $message = $notifications->item->message;
    echo "$message<br>"; 
    echo "$add <br>"; 
    if ($shout != NULL){
      echo "$shout <br>"; 
    }
  }
 if ($notifications -> type == "mayorship"){
    $mayor = $notifications->item->message;
    echo "$mayor <br>"; 
  }

 if ($notifications -> type == "score"){
    $score = $notifications->item->scores;
    if ($score != NULL){
      foreach ($score as $s){
        $points = $s->points;
        $smessage =  $s->message;

        echo "$smessage (+$points) pts<br>";
        }
    }
    $total = $notifications->item->total;
    echo "Total: $total pts<br>";
  }
}
?>
</center>
</body> 
</html> 
