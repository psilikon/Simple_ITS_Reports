<?php

$startdate = $_POST['startdate'];
$campaign = $_POST['campaign'];
$enddate = $_POST['enddate'];

$con = mysqli_connect("localhost", "cron", "1234", "asterisk");
//TOTAL CALLS
$res = mysqli_query($con, "SELECT COUNT(*) FROM vicidial_did_log WHERE extension = '$campaign'  AND date(call_date) >= '$startdate' AND date(call_date) <= '$enddate'");
$row = mysqli_fetch_row($res);
$totalCalls = $row[0];
//TOTAL DNC
$res = mysqli_query($con, "SELECT COUNT(*) FROM vicidial_agent_log WHERE uniqueid IN (select uniqueid FROM vicidial_did_log WHERE extension = '$campaign'  AND date(call_date) >= '$startdate' AND date(call_date) <= '$enddate') AND status IN ('DNC')");
$row = mysqli_fetch_row($res);
$totalDNC = $row[0];
//TOTAL HUMAN ANSWER
$res = mysqli_query($con, "SELECT COUNT(*) FROM vicidial_agent_log WHERE uniqueid IN (select uniqueid FROM vicidial_did_log WHERE extension = '$campaign'  AND date(call_date) >= '$startdate' AND date(call_date) <= '$enddate') AND status IN ('NP','NI','NOENG','A1','A2','A3','A4','A5','A6','A7','A8','CAE','P1','P2','P3','P4','P5','PPOMIT','PRPAID')");
$row = mysqli_fetch_row($res);
$totalHumanAnswers = $row[0];
//TOTAL SALES
$res = mysqli_query($con, "SELECT COUNT(*) FROM vicidial_agent_log WHERE uniqueid IN (SELECT uniqueid FROM vicidial_did_log WHERE extension = '$campaign'  AND date(call_date) >= '$startdate' AND date(call_date) <= '$enddate') AND status IN ('A1','A2','A3','A4','A5','P1','P2','P3','P4','P5')");
$row = mysqli_fetch_row($res);
$totalSales = $row[0];
//CALLS AT LEAST 30sec
$res = mysqli_query($con, "SELECT COUNT(*) FROM vicidial_agent_log WHERE uniqueid IN (SELECT uniqueid FROM vicidial_did_log WHERE extension = '$campaign'  AND date(call_date) >= '$startdate' AND date(call_date) <= '$enddate') AND talk_sec >= 30");
$row = mysqli_fetch_row($res);
$minDurationCalls = $row[0];
//TOTAL TRANSFERS
$res = mysqli_query($con, "SELECT COUNT(*) FROM vicidial_agent_log WHERE uniqueid IN (SELECT uniqueid FROM vicidial_did_log WHERE extension = '$campaign'  AND date(call_date) >= '$startdate' AND date(call_date) <= '$enddate' AND status IN ('XFER'))");
$row = mysqli_fetch_row($res);
$totalTransfers = $row[0];
//TOTAL DEAD AIR CALLS
$res = mysqli_query($con, "SELECT COUNT(*) from vicidial_agent_log where uniqueid IN (SELECT uniqueid FROM vicidial_did_log WHERE extension = '$campaign'  AND date(call_date) >= '$startdate' AND date(call_date) <= '$enddate' AND status IN ('DEAD'))");
$row = mysqli_fetch_row($res);
$totalDeadAir = $row[0];
//TOTAL SINGLES
$res = mysqli_query($con, "SELECT COUNT(*) FROM vicidial_agent_log where uniqueid IN (select uniqueid from vicidial_did_log where extension = '$campaign'  AND date(call_date) >= '$startdate' AND date(call_date) <= '$enddate') AND status IN ('A1')");
$row = mysqli_fetch_row($res);
$totalSingles = $row[0];
//TOTAL DOUBLES
$res = mysqli_query($con, "SELECT COUNT(*) FROM vicidial_agent_log where uniqueid IN (select uniqueid from vicidial_did_log where extension = '$campaign'  AND date(call_date) >= '$startdate' AND date(call_date) <= '$enddate') AND status IN ('A2')");
$row = mysqli_fetch_row($res);
$totalDoubles = $row[0];
//TOTAL TRIPLES
$res = mysqli_query($con, "SELECT COUNT(*) FROM vicidial_agent_log where uniqueid IN (select uniqueid from vicidial_did_log where extension = '$campaign'  AND date(call_date) >= '$startdate' AND date(call_date) <= '$enddate') AND status IN ('A3')");
$row = mysqli_fetch_row($res);
$totalTriples = $row[0];
//TOTAL QUADS
$res = mysqli_query($con, "SELECT COUNT(*) FROM vicidial_agent_log where uniqueid IN (select uniqueid from vicidial_did_log where extension = '$campaign'  AND date(call_date) >= '$startdate' AND date(call_date) <= '$enddate') AND status IN ('A4')");
$row = mysqli_fetch_row($res);
$totalQuads = $row[0];
//TOTAL CINCOS
$res = mysqli_query($con, "SELECT COUNT(*) FROM vicidial_agent_log where uniqueid IN (select uniqueid from vicidial_did_log where extension = '$campaign'  AND date(call_date) >= '$startdate' AND date(call_date) <= '$enddate') AND status IN ('A5')");
$row = mysqli_fetch_row($res);
$totalCincos = $row[0];

$totalProducts = ($totalSingles * 1 ) + ($totalDoubles * 2 ) + ($totalTriples * 3) + ($totalQuads * 4) + ($totalCincos * 5);

$transferPercent = ($totalTransfers / $minDurationCalls) * 100;
$transferPercent = round($transferPercent, 2);

$salesPercent = ($totalSales / $minDurationCalls) * 100;
$salesPercent = round($salesPercent, 2);

$dncPercent = ($totalDNC / $totalCalls) * 100;
$dncPercent = round($dncPercent, 2);

$cost = $minDurationCalls * .5;
//echo "DATE: ".$date, "TOTAL CALLS: ".$totalCalls, "TOTAL HUMAN ANSWERS: ".$totalHumanAnswers;
//, minDurationCalls, '$'+str(cost), totalTransfers, transferPercent, totalSales, salesPercent, totalProducts


echo "<table class='table table-striped table-bordered'>";
echo"<tr><th>Total Calls</th><th>Human Answers</th><th>Sales</th><th>Calls over 30 sec.</th><th>Transfers</th><th>Dead Air</th><th>DNCs</th><th>Products</th><th>DNC %</th><th>Transfer %</th><th>Sales %</th></tr>";
echo "<tr class='success'><td>".$totalCalls."</td><td>".$totalHumanAnswers."</td><td>".$totalSales."</td><td>".$minDurationCalls."</td><td>".$totalTransfers."</td><td>".$totalDeadAir."</td><td>".$totalDNC."</td><td>".$totalProducts."</td><td>".$dncPercent."</td><td>".$transferPercent."</td><td>".$salesPercent;
echo "</table>";

?>
