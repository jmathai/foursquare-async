<?php
error_reporting(0);
require_once '../EpiCurl.php';
require_once '../EpiOAuth.php';
require_once '../EpiFoursquare.php';
require_once 'PHPUnit/Framework.php';

class EpiFoursquareTest extends PHPUnit_Framework_TestCase
{
  public $consumer_key = 'a40b1aece83e8d94a08fff1e94f87c2f04af2881a';
  public $consumer_secret = 'e83c621567e6c430848db6dc5dde94b9';
  public $token = 'UTWGJZOB0KO0BZPLBFSYNKRDBY0HG5ZWZQCPOBRPF51CFLPI';
  public $secret= 'AYGH2BJ4UEHWDB5LBLTRTQ2OBTS41U4UVCGX5FWV222Z4YQI';
  public $id = '25451974';
  public $email = 'jaisen+test@jmathai.com';
  public $password = 'password';

  function setUp()
  {
    // key and secret for a test app (don't really care if this is public)
    $this->fsObj = new EpiFoursquare($this->consumer_key, $this->consumer_secret, $this->token, $this->secret);
    $this->fsObjUnAuth = new EpiFoursquare($this->consumer_key, $this->consumer_secret);
    $this->fsObjBasic = new EpiFoursquare();
    $this->fsObjBadAuth = new EpiFoursquare('foo', 'bar', 'foo', 'bar');
  }

  function testGetAuthorizeurl()
  {
    $aUrl = $this->fsObjUnAuth->getAuthorizeUrl();
    $this->assertTrue(strstr($aUrl['url'], 'http://foursquare.com/oauth/authorize') !== false, 'Authenticate url did not contain member definition from EpiFoursquare class');
    $this->assertTrue(!empty($aUrl['oauth_token']), 'Oauth token is empty');
    $this->assertTrue(!empty($aUrl['oauth_token_secret']), 'Oauth secret is empty');
  }

  function testGetRequestToken()
  {
    $resp = $this->fsObjUnAuth->getRequestToken();
    $this->assertTrue(strlen($resp->oauth_token) > 0, "oauth_token is longer than 0");
    $this->assertTrue(strlen($resp->oauth_token_secret) > 0, "oauth_token_secret is longer than 0");
  }

  function testCheckin()
  {
    $resp = $this->fsObj->post('/checkin.json', array('vid' => '35610'));
    $this->assertTrue($resp->checkin->id > 0, "Checkin id is not > 0");
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
