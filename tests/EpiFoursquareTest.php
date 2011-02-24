<?php
error_reporting(0);
require_once '../EpiCurl.php';
require_once '../EpiFoursquare.php';
require_once 'PHPUnit/Framework.php';

class EpiFoursquareTest extends PHPUnit_Framework_TestCase
{
  public $clientId = 'a40b1aece83e8d94a08fff1e94f87c2f04af2881a';
  public $clientSecret = 'e83c621567e6c430848db6dc5dde94b9';
  public $code = 'BFVH1JK5404ZUCI4GUTHGPWO3BUIUTEG3V3TKQ0IHVRVGVHS
';
  public $accessToken = 'DT32251AY1ED34V5ADCTNURTGSNHWXCNTOMTQM5ANJLBLO2O';
  public $redirectUrl = 'http://mac.fa.com/callback.php';
  public $id = '5763863';
  public $email = 'jaisen+test@jmathai.com';
  public $password = 'password';

  function setUp()
  {
    // key and secret for a test app (don't really care if this is public)
    $this->fsObj = new EpiFoursquare($this->clientId, $this->clientSecret, $this->accessToken);
    $this->fsObjUnAuth = new EpiFoursquare($this->clientId, $this->clientSecret);
  }

  function testGetAuthorizeurl()
  {
    $aUrl = $this->fsObjUnAuth->getAuthorizeUrl($this->redirectUrl);
    $this->assertEquals($aUrl, 'https://foursquare.com/oauth2/authenticate?client_id=a40b1aece83e8d94a08fff1e94f87c2f04af2881a&response_type=code&redirect_uri=http%3A%2F%2Fmac.fa.com%2Fcallback.php', 'Authorize url did not match');
  }

  function testGetAccessToken()
  {
    $resp = $this->fsObjUnAuth->getAccessToken($this->code, $this->redirectUrl);
  $this->assertTrue(!empty($resp->access_token), "access token is empty ({$resp->access_token})");
  }

  function testCheckin()
  {
    $resp = $this->fsObj->post('/checkins/add', array('venueId' => '35610', 'broadcast' => 'public'));
    $this->assertEquals($resp->meta->code, 200, "Meta code is not 200");
  }

  function testGeo()
  {
    $geolat = '41.438797';
    $geolon = '-97.351511';
    
    $resp = $this->fsObj->post('/checkins/add', array('venue' => 'test ' . time(), 'geolat' => $geolat, 'geolon' => $geolon, 'broadcast' => 'private'));
    $this->assertEquals($resp->meta->code, 200, "Checkin create response code  != 200");
    $this->assertTrue(!empty($resp->response->checkin->location->lat), "Latitude not stored");
    $this->assertTrue(!empty($resp->response->checkin->location->lon), "Longitude not stored");
  }

///**
//* @expectedException EpiTwitterNotAuthorizedException
//*/
//function testBadCredentials()
//{
//  $resp = $this->twitterObjBadAuth->post_direct_messagesNew( array ( 'user' => $this->screenName, 'text' => 'hello world'));
//  $resp->response;
//}

///**
//* @expectedException EpiTwitterNotFoundException
//*/
//function testNonExistantUser()
//{
//  $resp = $this->twitterObj->post_direct_messagesNew( array ( 'user' => 'jaisen_does_not_exist_and_dont_create_or_this_will_break', 'text' => 'seriously'));
//  $resp->response;
//}
}
