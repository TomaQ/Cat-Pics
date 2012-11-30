<?php

$con = mysql_connect("localhost", "cats", "cats123!!");

if (!$con)
	die("Could not connect: " . mysql_error());

mysql_select_db("catPics", $con);

$url = mysql_query("SELECT urls FROM catURLS ORDER BY RAND() LIMIT 1");

mysql_close($con);

?>

<html>
<head>

<script src = '//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'></script>
<script>

$(document).ready(function()
{
	$('#newCat').click(function() 
	{
		$.ajax("cat.php").done(function(data){
	 		$("#catID").attr('src', data)
		})	
	});	
});

</script>
</head>
<body>

<img src = "<?php echo mysql_result($url, 0, "urls"); ?>" id = "catID" height = 600 />
<br>
<button type = "button" id = "newCat" > New pic </button>

</body>
</html>
