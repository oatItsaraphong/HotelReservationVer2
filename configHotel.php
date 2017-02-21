<?php

function LoginDB ($inUser, $inPass){
	$host = "localhost";
	$database = "TestHotel";

	//Link to SQL
	//$link = mysqli_connect($host, $inUser, $inPass, $database);
	$link = mysqli_connect($host, "root", "toukoSQL", $database);
	if(mysqli_connect_errno())
	{
		echo "Fail to Connect::".msqli_connect_errno();
		echo "<br>";
		return 0;
	}
	return $link;
}

function CloseLint($inLink){
	mysqli_close($inLink);
}



?>
