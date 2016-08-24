<!DOCTYPE html>
<html lang="en">
	<title>OPT-IN Report</title>
		<head>
			<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
			<link rel="stylesheet" href="loading.css">
			<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
			<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" />
	        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    	    <script type="text/javascript" src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
	    </head>
<style type="text/css">
		.badge{
			color: #000;
			background-color:#ffffff;}
</style>

<script>
$(document).ready(function() {
	$("#loading-background").css({ opacity: 0.8 });
	$('#startdate').datepicker({ dateFormat: 'yy-mm-dd'});
	$('#enddate').datepicker({ dateFormat: 'yy-mm-dd'});
	$('#cbstartdate').datepicker({ dateFormat: 'yy-mm-dd'});
	$('#cbenddate').datepicker({ dateFormat: 'yy-mm-dd'});
    var dataString = "&remoteUser="+'9200';

	    $.ajax({
                        type: "POST",
                        url: "show_diallevel.php",
						dataType: 'json',
						data: dataString,
                        success: function(data) {
                                $("#dialLevelBar").html('<span class="badge">'+data['diallevel']+'</span></a>');
                                $("#dialStatus").html(data['status']);
								if(data['status'] == 'ACTIVE'){
									$("#dialStatus").removeClass("label-danger");
									$("#dialStatus").addClass("label-success");
								} else {
									$("#dialStatus").removeClass("label-success");
									$("#dialStatus").addClass("label-danger");
								}
								$("#dialLevelBar").css("width", data['diallevel']+"%");
								}
                });

	$("#startDial").click(function() {
			alert('Dial process started!');
		    var dataString = "&remoteUser="+'9200';
                $.ajax({
                        type: "POST",
                        url: "startDialing.php",
						data: dataString,
                        success: function(data) {
                                $("#dialStatus").html(data);
									if(data == 'ACTIVE'){
										$("#dialStatus").removeClass("label-danger");
										$("#dialStatus").addClass("label-success");
									} else {
										$("#dialStatus").removeClass("label-success");
										$("#dialStatus").addClass("label-danger");
									}
								}
                });
	});
	$("#stopDial").click(function() {
				alert('Dial process stopped!');
			    var dataString = "&remoteUser="+'9200';
                $.ajax({
                        type: "POST",
                        url: "stopDialing.php",
						data: dataString,
                        success: function(data) {
                                $("#dialStatus").html(data);
									if(data == 'ACTIVE'){
										$("#dialStatus").removeClass("label-danger");
										$("#dialStatus").addClass("label-success");
									} else {
										$("#dialStatus").removeClass("label-success");
										$("#dialStatus").addClass("label-danger");
									}
								}
                });
	});
    $("#details").click(function() {
               var campaign = $("#campaign").val();
                var startdate = $("#startdate").val();
                var enddate = $("#enddate").val();
		        var dataString = 'campaign='+campaign+'&startdate='+startdate+'&enddate='+enddate;
				$("#loading-background").show();
                $.ajax({
                        type: "POST",
                        url: "optinreportdata.php",
                        data: dataString,
                        success: function(data) {
                                $("#reporttable").html(data);
									$("#loading-background").hide();
                                }
                });
        });
    $("#cbdetails").click(function() {
               var campaign = $("#cbcampaign").val();
                var startdate = $("#cbstartdate").val();
                var enddate = $("#cbenddate").val();
		        var dataString = 'campaign='+cbcampaign+'&startdate='+cbstartdate+'&enddate='+cbenddate;
				$("#loading-background").show();
                $.ajax({
                        type: "POST",
                        url: "optincbreportdata.php",
                        data: dataString,
                        success: function(data) {
                                $("#reporttable").html(data);
									$("#loading-background").hide();
                                }
                });
        });


    $("#dialLevelSubmit").click(function() {
		var dialLevel = $('#dialLevelControl').val;
		var x = document.getElementById("dialLevelControl").value;
	    $.ajax({
                        type: "POST",
                        url: "adjust_diallevel.php",
                        data: 'dialLevel='+x+'&remoteUser='+'9200',
                        success: function(data) {
                                $("#dialLevelBar").html('<span class="badge">'+data+'</span></a>');
									result = data;
								$("#dialLevelBar").css("width", result+"%");
								}
                });
        });
});

</script>
<body>
<div class="navbar navbar-default" role="navigation">
      <div class="container">
		<h2>Campaign Controls</h2>
      </div>
</div>
<div class="container">
	<div class="row">
	<div class="well">
		<form class="form-inline" role="form">
				<h4>Opt In Report by <span class="label label-default">Date Range :</span></h4>
			<div class="form-group">
				<label for="campaign">Campaign</label>
				<select class="form-control" id="campaign">
				 	<option value="9002">9002</option>
				</select>
			</div>
			<div class="form-group">
				<div>
					<label for="startdate">Start Date</label></span>
					<span class="add-on"><i class="icon-calendar"></i>
					<input type="text" class="form-control" id="startdate" placeholder="Select start date">
				</div>
			</div>
			<div class="form-group">
				<label for="enddate">End Date</label>
				<input type="text" class="form-control" id="enddate" placeholder="Select end date">
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-success" id="details">Submit</button>
			</div>
		</form>
	</div> <!--well-->
	<div class="well">
		<form class="form-inline" role="form">
				<h4>Call Back Report by <span class="label label-default">Date Range :</span></h4>
			<div class="form-group">
				<label for="cbcampaign">Campaign</label>
				<select class="form-control" id="cbcampaign">
				 	<option value="9002">9002</option>
				</select>
			</div>
			<div class="form-group">
				<div>
					<label for="cbstartdate">Start Date</label></span>
					<span class="add-on"><i class="icon-calendar"></i>
					<input type="text" class="form-control" id="cbstartdate" placeholder="Select start date">
				</div>
			</div>
			<div class="form-group">
				<label for="cbenddate">End Date</label>
				<input type="text" class="form-control" id="cbenddate" placeholder="Select end date">
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-success" id="cbdetails">Submit</button>
			</div>
		</form>
	</div> <!--well-->
	<div class="well">
		<form class="form-inline" role="form">
				<h4>Control <span class="label label-default">Dial Level :</span></h4>
			<div class="form-group">
				<label for="campaign">Select Dial Level </label>
				<select class="form-control" id="dialLevelControl">
				 	<option value="10">10</option>
				 	<option value="20">20</option>
				 	<option value="30">30</option>
				 	<option value="40">40</option>
				 	<option value="50">50</option>
				 	<option value="60">60</option>
				 	<option value="70">70</option>
				 	<option value="80">80</option>
				 	<option value="90">90</option>
				 	<option value="100">100</option>
				</select>
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-success" id="dialLevelSubmit">Update Level</button>
			</div>
			<div class="form-group">&nbspDial Status is :
			</div>
			<div class="form-group">
				<span id="dialStatus" class="label"></span>
			</div>
			<div class="form-group">
				&nbsp
				&nbsp
				&nbsp
				&nbsp
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-success" id="startDial">START DIALING</button>
			</div>
			<div class="form-group">
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-danger" id="stopDial">STOP DIALING</button>
			</div>
		<div class="form-inline">
			<span>&nbsp</span>
		</div>
				<div class="progress">
					<div class="progress-bar progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="" id="dialLevelBar">
					</div>
				</div>
		</form>
	</div>
<div id="reporttable">
</div>
 <div id="loading-background">
    <div id="loading" class="ui-corner-all" >
      <img style="height:80px;margin:30px;" src="loading.gif" alt="Loading.."/>
      <h2 style="color:gray;font-weight:normal;">Please wait....</h2>
     </div>
</div>
	</div>
</div>
</body>
</html>

