<?php

$con = mysql_connect("localhost", "cats", "cats123!!");

if (!$con)
	die("Could not connect: " . mysql_error());

mysql_select_db("catPics", $con);

$cur = curl_init();
curl_setopt($cur, CURLOPT_URL, 'imgur.com/r/cats.json');
curl_setopt($cur, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($cur);
curl_close($cur);

$imgur = json_decode($result, true);

foreach($imgur['data'] as $img)
{
	$imgUrl = "http://i.imgur.com/" . $img['hash'] . $img['ext'];
	mysql_query("INSERT IGNORE INTO catURLS (urls) SELECT '$imgUrl'") or die(mysql_error());
}
//mysql_query("INSERT INRO ");
$url = mysql_query("SELECT urls FROM catURLS ORDER BY RAND() LIMIT 1");

mysql_close($con);

?>

<html>
<head>

<title> Random Cats </title>

<link rel="stylesheet" type="text/css" href="style.css">

<script src = '//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>
<script>

$(document).ready(function()
{
	$('#newCat').click(function() 
	{
		$.ajax("cat.php?random="+Math.random()).done(function(data){
	 		$("#catID").attr('src', data)
		})	
	});	
});

</script>

</head>
	<body>
	
	<div style = "text-align:center;">
		<img src = "<?php echo mysql_result($url, 0, "urls"); ?>" id = "catID" height = 600 border ="5" />
		<br>
		<button type = "button" id = "newCat" > New pic </button>
	</div>

	</body>
</html>
