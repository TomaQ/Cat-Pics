<?php

$con = mysql_connect("localhost", "cats", "cats123!!");

if (!$con)
        die("Could not connect: " . mysql_error());

mysql_select_db("catPics", $con);

$url = mysql_query("SELECT urls FROM catURLS ORDER BY RAND() LIMIT 1");

mysql_close($con);

echo mysql_result($url, 0, "urls");

?>
