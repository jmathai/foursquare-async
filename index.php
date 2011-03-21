<?php
ob_start();
require_once 'EpiCurl.php';
require_once 'EpiFoursquare.php';
$clientId = 'GUU2AJRPK4LDBHIFQKTU31DXITIGLFKV1TOJGBJ2NRIKGFBW';
$clientSecret = 'CSW5BUGITZ2LNF0MMD5UPDTTZGGJ2PN01CSZYY0L4ARUHGCZ';
$redirectUri = 'http://shizhao.info/foursquare-async/simpleTest.php';
#$fsObj = new EpiFoursquare($clientId, $clientSecret, $accessToken);
$fsObjUnAuth = new EpiFoursquare($clientId, $clientSecret);
?>
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" > 
</head>
<body>
<div align="center"><img src="http://code.google.com/p/4sqr/logo?cct=1283331984" /><br />
<?php
$latidude_code = $_COOKIE['latidude_code'];

if (!isset($_GET['code']) && !isset($_COOKIE['access_token'])){
//header('location: login.php');

 $authorizeUrl = $fsObjUnAuth->getAuthorizeUrl($redirectUri); ?>
<a href="<?php echo $authorizeUrl; ?>">authorization</a>
<?php } else { ?>
  
  <?php
//  $_COOKIE['access_token']='';
  if(!isset($_COOKIE['access_token'])) {
    $token = $fsObjUnAuth->getAccessToken($_GET['code'], $redirectUri);
    setcookie('access_token', $token->access_token, time()+(100*24*3600));
    $_COOKIE['access_token'] = $token->access_token;
    } ?>
  <?php echo $token->access_token;?>
  <?php if (!isset($latidude_code)){ ?>
    <form name="login" action="loginaction.php" method=POST>
    Latidude code: <input type=text name="latidude_code"><br>
    you can find Latidude code <a href="http://www.google.com/latitude/apps/badge">here</a>.
    <input name="log" type=submit value="Login">
    </form>
  <?php } else { ?>

    <?
//include "kernel/foursquare.class.php";
//include "conf/conf.php";
    include "latitude.php";
    $fsObjUnAuth->setAccessToken($_COOKIE['access_token']);
    $venues = $fsObjUnAuth->get('/venues/search', array('ll' => "{$latitude},{$longitude}", 'limit' => 50));
//    if (is_object($venues->response)) {
      foreach ($venues->response->groups[0]->items as $venue) {
        $name = $venue->name;
        $id = $venue->id;	
        $dist = $venue->location->distance;
        $add = $venue->location->address;
        $city = $venue->location->city;
        $state = $venue->location->state;		
	echo "<a href='check.php?id=$id&name=$name&add=$add&city=$city&state=$state'>$name</a> - $dist m<br />" ;
	}
//      }

    echo "<hr /><a href='check.php?new=1'>Add venue</a><br />";
    echo "<a href=\"http://maps.google.com/?q=$latitude,$longitude\">I an here!</a><br />";
    echo "<hr /><a href='logout.php'>Logout</a><br />";
    }
  }
?>
</div>
</body> 
</html> 
