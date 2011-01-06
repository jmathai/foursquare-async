<?php
require_once 'EpiCurl.php';
require_once 'EpiFoursquare.php';
$clientId = 'a40b1aece83e8d94a08fff1e94f87c2f04af2881a';
$clientSecret = 'e83c621567e6c430848db6dc5dde94b9';
$code = 'BFVH1JK5404ZUCI4GUTHGPWO3BUIUTEG3V3TKQ0IHVRVGVHS';
$accessToken = 'DT32251AY1ED34V5ADCTNURTGSNHWXCNTOMTQM5ANJLBLO2O';
$redirectUrl = 'http://mac.fa.com/callback.php';
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

<h2>Generate the authorization link</h2>
<?php echo $fsObj->getAuthorizeUrl($redirectUrl); ?>

<hr>

<h2>Get a user's checkins</h2>
<?php
  $creds = $fsObj->get("/users/{$userId}/checkins");
?>
<pre>
<?php print_r($creds->response); ?>
</pre>

<hr>
