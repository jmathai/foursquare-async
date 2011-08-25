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

$id = $_POST['id'];
$shout = $_POST['shout'];
$name = $_POST['name'];
$geolat = $_POST['latitude'];
$geolong = $_POST['longitude'];
$privat = 'public';

if  ($_FILES['photo']['name'] == NULL){
    if  ($_POST['privat']== NULL){
        $privat = 'public';
        if  ($_POST['facebook']== 1)
          $privat = $privat.' ,facebook';
        if  ($_POST['twitter']== 1)
          $privat = $privat.' ,twitter';
     }
     else {
        $privat = 'private';
     }
}

$checkin = $fsObjUnAuth->post('/checkins/add',array(
    'venueId' => "{$id}", 'venue' => "{$name}", 'shout'=>"{$shout}", 'broadcast' => "{$privat}", 'll' => "{$geolat},{$geolong}"
  ));

if  ($_FILES['photo']['name'] !=NULL){

   if  (($_POST['twitter']== 1) &&  ($_POST['facebook']== 0)){
      $privat = 'twitter';
   }
   elseif  (($_POST['twitter']== 0) && ($_POST['facebook']== 1)) {
      $privat = 'facebook';
   }
   elseif  (($_POST['twitter']== 1) &&  ($_POST['facebook']== 1)) {
      $privat = 'twitter,facebook';
   }
   else {
      $privat = '';
   }
    $postVars = array();
    $postVars['checkinId'] = $checkin->response->checkin->id;  
    $postVars['ll'] = "{$geolat},{$geolong}";
    $postVars['broadcast'] = "{$privat}";
    $postVars['photo'] = '@'.$_FILES['photo']['tmp_name'];

    $pcheckin = $fsObjUnAuth->post('/photos/add', $postVars, $up=1);
}
?>
<center>

<?php

$add = $checkin->response->checkin->venue ->location->address;

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
if  ($_FILES['photo']['name'] !=NULL){
    $myphoto=$pcheckin->response->photo->sizes->items[2]->url;
    echo "Photo upload done!<br />";
    echo "<img src=\"{$myphoto}\" />";
}
?>
<hr />
<small>Power by 4sqr.</small>
</center>
</body> 
</html> 
