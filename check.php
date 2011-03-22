<?php
require_once 'config.php';
?>
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" > 
<meta name="robots" content="noindex">
</head>
<body>
<div align="center"><img src="logo.png" /><br />
<?php
include "kernel/latitude.php";
$new = $_GET['new'];

if ($new ==1){
    echo "<div align='center'>";
    echo "<form action='add.php' method='POST'>";
    echo"<b>Add venue:<b><br>";
    echo"<b>name:</b> <input size='30' name='name' value=''><br>";
    echo "address: <input size='30' name='address' value=''><br>";
    echo "crossstreet: <input size='30' name='crossstreet' value=''><br>";
    echo "city: <input size='30' name='city' value=''><br>";
    echo "state: <input size='30' name='state' value=''><br>";
    echo "zip: <input size='30' name='zip' value=''><br>";
    echo "phone: <input size='30' name='phone' value=''><br>";
    echo "<input type='hidden' name='geolat' value='$latitude'>";
    echo "<input type='hidden' name='geolong' value='$longitude'>";
    echo "<input type='submit' value='Add'>";
    }


else {
    $id = $_GET['id'];
    $name = $_GET['name'];
    $add = $_GET['add'];
    $city = $_GET['city'];
    $state = $_GET['state'];
    echo "<div align='center'>";
    echo "Check in @ <strong> $name </strong><br >";
    $array = array($add,$city,$state);

    $adds = implode(", ", $array);

    echo "$adds <br >"; 
    echo "<form action='checkin.php' method='POST' enctype=\"multipart/form-data\">";

    echo "<input type='hidden' name='id' value='$id'>";
    echo "<input type='hidden' name='name' value='$name'>";
    echo "<input type='hidden' name='latitude' value='$latitude'>";
    echo "<input type='hidden' name='longitude' value='$longitude'>";
    echo "shout：<input size='30' name='shout' value=''><br>";
    echo "private: <input type='checkbox' name='privat' value='0' /><br>";
    echo "twitter: <input type='checkbox' name='twitter' checked value='1' /><br>";
    echo "Facebook: <input type='checkbox' name='facebook' checked value='1' /><br>";
    echo "Photo: <input type='file' accept=\"image/jpeg\" name='photo' /><br />";
    echo "<input type='submit' value='Check in!'></form>";
    }
?>
<hr />
<small>Power by 4sqr.</small>
</div>
</body> 
</html> 
