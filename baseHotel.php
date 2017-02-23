<html>
<head>
<title>BaseHotel</title>
<meta name="Content-Type" content="text/html; charset=utf8"/>
<link rel="stylesheet" type="text/css" href="theme.css">
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="code/sample.js" type="text/javascript"></script>

 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
	
	<table width="500" height="30" bgcolor="yellow">
	<tr></tr>
	</table>
	<br>

	<?php
	header('Content-Type: text/html; charset=utf8');
	require "configHotel.php";
	mysqli_set_charset($link,"utf8");

	echo "<div id='Testing'>";
	echo "<strong>Search the Name ID</strong>";
	echo "<form action='SearchID.php' method='post'>";
	echo "Enter Name you want:";
	echo "<input id='nameid' list='NameList' name='SelName'>";
	//start the list NameList
	//start calling for sql
	
	$sql ="SELECT Name FROM NameTable3 WHERE 1";

	$result = mysqli_query($link,$sql);
	echo "<datalist id='NameList'>";
	foreach($link->query($sql) as $row)
	{
		echo "<option value=".$row[Name].">";
	}
	echo "</datalist>";

	echo "<input type='submit'>";
	echo "</form>";
	echo "</div>";
	echo "<br>";
	mysqli_close($link);
	?>
</body>
</html>
