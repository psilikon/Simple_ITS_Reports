<!DOCTYPE html>
<html lang="en">
	<title>Conversion Report</title>
		<head>
			<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> 
            <link rel="stylesheet" href="loading.css">
<!--			<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css"> -->
			<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" />
	        <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    	    <script type="text/javascript" src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
	    </head>
<script>
$(document).ready(function() {
	$("#loading-background").css({ opacity: 0.8 });
	$('#startdate').datepicker({ dateFormat: 'yy-mm-dd'});
	$('#enddate').datepicker({ dateFormat: 'yy-mm-dd'});

    $("#details").click(function() {
               var campaign = $("#campaign").val();
                var startdate = $("#startdate").val();
                var enddate = $("#enddate").val();
		        var dataString = 'campaign='+campaign+'&startdate='+startdate+'&enddate='+enddate;
				$("#loading-background").show();
                $.ajax({
                        type: "POST",
                        url: "reportdata.php",
                        data: dataString,
                        success: function(data) {
                                $("#reporttable").html(data);
									$("#loading-background").hide();
                                }
                });
        });
});
</script>
<body>
<div class="navbar navbar-default" role="navigation">
      <div class="container">
		<h2>Reporting Page</h2>
      </div>
</div>
<div class="container">
	<div class="row">
	<div class="well">
		<form class="form-inline" role="form">
				<h4>Report by <span class="label label-default">Date Range :</span></h4>
			<div class="form-group">
				<label for="campaign">Campaign</label>
				<select class="form-control" id="campaign">
					<option value="5255234">5255234</option>
					<option value="4300">4300</option>
				</select>
			</div>
			<div class="form-group">
				<div class="input-prepend">
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
	</div>
</div>
<div id="loading-background">
    <div id="loading" class="ui-corner-all" >
      <img style="height:80px;margin:30px;" src="loading.gif" alt="Loading.."/>
      <h2 style="color:gray;font-weight:normal;">Please wait....</h2>
     </div>
</div>
<div id="reporttable">
</div>
</body>
</html>

