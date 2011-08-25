<?php
function open($url_page)
	{
    $ch = curl_init($url_page);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Google");
    curl_setopt ($ch, CURLOPT_URL, $url_page );
    $html = curl_exec ( $ch );
    curl_close($ch);
    return $html;
	}
	
	
$google_json = open("http://www.google.com/latitude/apps/badge/api?user=$latidude_code&type=json");
$google = json_decode($google_json, true);

$latitude = $google['features'][0]['geometry']['coordinates'][1];

$longitude = $google['features'][0]['geometry']['coordinates'][0];
$places_json = open("https://maps.googleapis.com/maps/api/place/search/json?location=$latitude,$longitude&radius=1000&sensor=false&key=$placeskey");
$places = json_decode($places_json, true);

if ($ref!=Null){
  $placedetails_json = open("https://maps.googleapis.com/maps/api/place/details/json?reference=$ref&sensor=true&key=$placeskey");
  $placedetails = json_decode($placedetails_json, true);
  }
?>
