<?php
include "mac-list.php";
$m = $_GET['mac'];
$m = strtoupper($m);
if(in_array($m,$mac))
{
	echo "Allow";
	
	setcookie("allow", "1", time()+3600);
	if(isset($_GET['redirect']) && $_GET['redirect']=="1")
	{
		header("location:/");
	}
}else{
	echo "Deny";
}
?>