<?php

$startdate = $_POST['startdate'];
$campaign = $_POST['campaign'];
$enddate = $_POST['enddate'];

$con = mysqli_connect("192.168.1.216", "cron", "1234", "asterisk");
//TOTAL CALLS
$res = mysqli_query($con,"SELECT COUNT(*) FROM vicidial_log WHERE campaign_id = '$campaign' AND date(call_date) >= '$startdate' AND date(call_date) <= '$enddate'");
$row = mysqli_fetch_row($res);
$totalCalls = $row[0];
//TOTAL CALLS TO SVYEXT
$res = mysqli_query($con,"SELECT COUNT(*) FROM vicidial_log WHERE campaign_id = '$campaign' AND status = 'XFER' AND date(call_date) >= '$startdate' AND date(call_date) <= '$enddate'");
$row = mysqli_fetch_row($res);
$totalXFER = $row[0];
//TOTAL HUMAN ANSWER
$res = mysqli_query($con,"SELECT COUNT(*) FROM vicidial_log WHERE campaign_id = '$campaign' AND status IN ('XFER','PU','PM','DNC') AND date(call_date) >= '$startdate' AND date(call_date) <= '$enddate'");
$row = mysqli_fetch_row($res);
$totalHuman = $row[0];
//TOTAL DNC
$res = mysqli_query($con,"SELECT COUNT(*) FROM vicidial_log WHERE campaign_id = '$campaign' AND status ='DNC' AND date(call_date) >= '$startdate' AND date(call_date) <= '$enddate'");
$row = mysqli_fetch_row($res);
$totalDNC = $row[0];
//HUMAN CONTACT %
$contactPercent = ($totalHuman / $totalCalls) * 100;
$contactPercent = round($contactPercent, 2);

$xferPercent = ($totalXFER / $totalHuman) * 100;
$xferPercent = round($xferPercent, 2);

echo "<table class='table table-striped table-bordered'>";
echo"<tr><th>Total Calls</th><th>Total Transfers</th><th>Total Human Answer</th><th>Total DNC</th><th>Contact Percent</th><th>XFER Percent</th></tr>";
echo "<tr class='success'><td>".$totalCalls."</td><td>".$totalXFER."</td><td>".$totalHuman."</td><td>".$totalDNC."</td><td>".$contactPercent."</td><td>".$xferPercent."</td></tr>";
echo "</table>";

?>
