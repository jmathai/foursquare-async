<?php
ob_start();
require_once 'EpiCurl.php';
require_once 'EpiFoursquare.php';
$clientId = 'a40b1aece83e8d94a08fff1e94f87c2f04af2881a';
$clientSecret = 'e83c621567e6c430848db6dc5dde94b9';
$code = 'BFVH1JK5404ZUCI4GUTHGPWO3BUIUTEG3V3TKQ0IHVRVGVHS';
$accessToken = 'DT32251AY1ED34V5ADCTNURTGSNHWXCNTOMTQM5ANJLBLO2O';
$redirectUri = 'http://www.jaisenmathai.com/foursquare-async/simpleTest.php';
$userId = '5763863';
$fsObj = new EpiFoursquare($clientId, $clientSecret, $accessToken);
$fsObjUnAuth = new EpiFoursquare($clientId, $clientSecret);
?>

<h1>Simple test to make sure everything works ok</h1>

<h2><a href="javascript:void(0);" onclick="viewSource();">View the source of this file</a></h2>

<div id="source" style="display:none; padding:5px; border: dotted 1px #bbb; background-color:#ddd;">
<?php highlight_file(__FILE__); ?>
</div>

<hr>

<h2>Test an unauthenticated call to search for a venue</h2>
<?php $venue = $fsObjUnAuth->get('/venues/search', array('ll' => '40.7,-74')); ?>
<pre><?php var_dump($venue->response->groups[0]->items[0]); ?></pre>

<hr>

<?php if(!isset($_GET['code']) && !isset($_COOKIE['access_token'])) { ?>
<h2>Generate the authorization link</h2>
<?php $authorizeUrl = $fsObjUnAuth->getAuthorizeUrl($redirectUri); ?>
<a href="<?php echo $authorizeUrl; ?>"><?php echo $authorizeUrl; ?></a>

<?php } else { ?>
<h2>Display your own badges</h2>
<?php
  if(!isset($_COOKIE['access_token'])) {
    $token = $fsObjUnAuth->getAccessToken($_GET['code'], $redirectUri);
    setcookie('access_token', $token->access_token);
    $_COOKIE['access_token'] = $token->access_token;
  }
  $fsObjUnAuth->setAccessToken($_COOKIE['access_token']);
  $badges = $fsObjUnAuth->get('/users/self/badges');
?>
<pre><?php var_dump($badges->response); ?></pre>
<?php } ?>

<hr>

<h2>Get a test user's checkins</h2>
<?php
  $creds = $fsObj->get("/users/{$userId}/checkins");
?>
<pre>
<?php var_dump($creds->response); ?>
</pre>

<hr>
