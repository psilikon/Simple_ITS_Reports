<?php
$con = mysqli_connect("208.38.129.151", "cron", "1234", "asterisk");
//DIAL LEVEL

$remoteUser=$_POST['remoteUser'];

$stmt = mysqli_query($con,"UPDATE vicidial_remote_agents SET status = 'INACTIVE' WHERE user_start='$remoteUser'");
mysqli_execute($stmt);

$res = mysqli_query($con,"SELECT status FROM vicidial_remote_agents WHERE user_start = '$remoteUser'");
$row = mysqli_fetch_row($res);
$status = $row[0];

echo $status;


?>
