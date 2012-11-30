<?php

$con = mysql_connect("localhost", "cats", "cats123!!");

if (!$con)
	echo "Error connecting to database: " . mysql_error();

mysql_select_db("catPics", $con);


$cur = curl_init();
curl_setopt($cur, CURLOPT_URL, 'imgur.com/r/cats.json');
curl_setopt($cur, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($cur);
curl_close($cur);

echo "<!-- $result -->";
$imgur = json_decode($result, true);

foreach($imgur['data'] as $img)
{
	$imgUrl = "http://i.imgur.com/". $img['hash'].$img['ext'];
	mysql_query("INSERT INTO catURLS (urls) VALUES ('$imgUrl')") or die(mysql_error());
	echo $imgUrl;
}

mysql_close($con);

?>
