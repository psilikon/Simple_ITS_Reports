<?php

$startdate = $_POST['startdate'];
$campaign = $_POST['campaign'];
$enddate = $_POST['enddate'];

$con = mysqli_connect("192.168.1.200", "cron", "1234", "asterisk");
//PRESS 1
$res = mysqli_query($con,"SELECT COUNT(*) FROM live_inbound_log WHERE comment_a ='CALLMENU' AND comment_b='1' AND comment_d = 'KIRBY_TEST>1' AND date(start_time) >= '$start_date' AND date(start_time) <= '$enddate'");
$row = mysqli_fetch_row($res);
$pressone = $row[0];
//PRESS 2
$res = mysqli_query($con,"SELECT COUNT(*) FROM live_inbound_log WHERE comment_a ='CALLMENU' AND comment_b='2' AND comment_d = 'KIRBY_TEST>2' AND date(start_time) >= '$start_date' AND date(start_time) <= '$enddate'");
$row = mysqli_fetch_row($res);
$presstwo = $row[0];
//TOTAL CALLBACKS
$res = mysqli_query($con,"SELECT COUNT(*) FROM live_inbound_log WHERE comment_a ='CALLMENU' AND comment_b='KIRBY_TEST' AND date(start_time) >= '$start_date' AND date(start_time) <= '$enddate'");
$row = mysqli_fetch_row($res);
$totalcb = $row[0];

echo "<table class='table table-striped table-bordered'>";
echo"<tr><th>Total Call Backs</th><th>Total Press One</th><th>Total Press Two</th></tr>";
echo "<tr class='success'><td>".$totalcb."</td><td>".$pressone."</td><td>".$presstwo."</td></tr>";
echo "</table>";

?>
