<?php
header('Content-Type: application/json');
$con = mysqli_connect("208.38.129.151", "cron", "1234", "asterisk");
//DIAL LEVEL
$remoteUser=$_POST['remoteUser'];

$res = mysqli_query($con,"SELECT number_of_lines, status FROM vicidial_remote_agents WHERE user_start = '$remoteUser'");
$row = mysqli_fetch_row($res);
$diallevel = $row[0];
$status = $row[1];

$returnData = array( 'diallevel' => $diallevel, 'status' => $status );
echo json_encode($returnData)
?>
