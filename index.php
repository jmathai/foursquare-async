<?php
ob_start();
require_once 'kernel/EpiCurl.php';
require_once 'kernel/EpiFoursquare.php';
include 'config.php';
$fsObjUnAuth = new EpiFoursquare($clientId, $clientSecret);
?>
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" > 
<meta name="robots" content="noindex">
</head>
<body>
<div align="center"><img src="logo.png" /><br />
<?php
if (!isset($_GET['code']) && !isset($_COOKIE['access_token'])){
    $authorizeUrl = $fsObjUnAuth->getAuthorizeUrl($redirectUri);
?>
    <a href="<?php echo $authorizeUrl; ?>"><img src="signinwith-foursquare.png" /></a>
    <?php } else { 
        if(!isset($_COOKIE['access_token'])) {
            $token = $fsObjUnAuth->getAccessToken($_GET['code'], $redirectUri);
            setcookie('access_token', $token->access_token, time()+(100*24*3600));
            $_COOKIE['access_token'] = $token->access_token;
        } ?>
        <?php
        require_once "kernel/latitude.php";
        $fsObjUnAuth->setAccessToken($_COOKIE['access_token']);
        $venues = $fsObjUnAuth->get('/venues/search', array('ll' => "{$latitude},{$longitude}", 'limit' => 50));
        foreach ($venues->response->groups as $groups) {
            if ($groups->type =='favorites'){
                echo $groups->name.'<br />';
                foreach ($groups->items as $venue) {
                    $name = $venue->name;
                    $id = $venue->id;	
                    $dist = $venue->location->distance;
                    $add = $venue->location->address;
                    $city = $venue->location->city;
                    $state = $venue->location->state;		
                    echo "<a href='check.php?id=$id&name=$name&add=$add&city=$city&state=$state'>$name</a> - $dist m<br />" ;
                 }
            }
            elseif ($groups->type =='trending'){
                echo $groups->name.'<br />';
                foreach ($groups->items as $venue) {
                    $name = $venue->name;
                    $id = $venue->id;	
                    $dist = $venue->location->distance;
                    $add = $venue->location->address;
                    $city = $venue->location->city;
                    $state = $venue->location->state;		
                    echo "<a href='check.php?id=$id&name=$name&add=$add&city=$city&state=$state'>$name</a> - $dist m<br />" ;
                 }
            }
            elseif ($groups->type =='nearby') {
                echo $groups->name.'<br />';
                foreach ($groups->items as $venue) {
                    $name = $venue->name;
                    $id = $venue->id;	
                    $dist = $venue->location->distance;
                    $add = $venue->location->address;
                    $city = $venue->location->city;
                    $state = $venue->location->state;		
                    echo "<a href='check.php?id=$id&name=$name&add=$add&city=$city&state=$state'>$name</a> - $dist m<br />" ;
                 }
            }
            else {
                foreach ($groups->items as $venue) {
                    $name = $venue->name;
                    $id = $venue->id;	
                    $dist = $venue->location->distance;
                    $add = $venue->location->address;
                    $city = $venue->location->city;
                    $state = $venue->location->state;		
                    echo "<a href='check.php?id=$id&name=$name&add=$add&city=$city&state=$state'>$name</a> - $dist m<br />" ;
                 }
            }                                
        }
        echo "<hr /><a href='places.php'>Place Searches</a><br />";
        echo "<a href='check.php?new=1'>Add venue</a><br />";
        echo "<a href=\"http://maps.google.com/?q=$latitude,$longitude\">I at here!</a><br />";
        echo "<a href='logout.php'>Logout</a><br />";
    } ?>
<hr />
<small>Power by 4sqr.</small>
</div>
</body> 
</html>
