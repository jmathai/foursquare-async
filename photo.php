<?php
 
function postMobypicture($username, $pin, $filePath, $postTitle, $postDescription, $posttags)
{
    $url = 'https://api.mobypicture.com';
    $apiKey = 'YOU-APIKEY-HERE';
 
    $postVars = array();
    $postVars['k'] = $apiKey;            // Your API key
    $postVars['u'] = $username;            // Username
    $postVars['p'] = $pin;                // Password
    $postVars['i'] = '@'.$filePath;        // Path of the file to send
    $postVars['t'] = $postTitle;        // Title of the post
    $postVars['d'] = $postDescription;    // Description of the post
    $postVars['s'] = 'all';    // s-Service,all-All services
    $postVars['format'] = 'json';        // Response format, can be 'xml', 'json' or 'plain';
    $postVars['tags'] = $posttags;    // tags
 
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postVars);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $returnData = curl_exec($ch);
    curl_close($ch);
 
    /**
    * Do something with the returned data
    */
    var_dump ($returnData);
}
 
    postMobypicture('bram', '1234', '/mnt/fileserver/media/IMAGE_058.jpg', 'Nala the cat', 'Meow!');
 


function flickr_decode($num) {
  $alphabet = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
  $decoded = 0;
  $multi = 1;
  while (strlen($num) > 0) {
    $digit = $num[strlen($num)-1];
    $decoded += $multi * strpos($alphabet, $digit);
    $multi = $multi * strlen($alphabet);
    $num = substr($num, 0, -1);
  }
  return $decoded;
}

?>
