<?php

$newDialLevel = $_POST['dialLevel'];
$remoteUser=$_POST['remoteUser'];

$con = mysqli_connect("192.168.1.216", "cron", "1234", "asterisk");
//DIAL LEVEL

$stmt = mysqli_query($con,"UPDATE vicidial_remote_agents SET number_of_lines = $newDialLevel WHERE user_start='$remoteUser'");
mysqli_execute($stmt);

$res = mysqli_query($con,"SELECT number_of_lines FROM vicidial_remote_agents WHERE user_start = '$remoteUser'");
$row = mysqli_fetch_row($res);
$diallevel = $row[0];

echo $diallevel;
?>
