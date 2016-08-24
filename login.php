<!doctype html>
<html lang="en">
    <title>Reports</title>
    <head>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </head>
	<style>
#mypassword:focus{
  box-shadow: 0 0 5px rgba(81, 203, 238, 1);
  border: 1px solid rgba(81, 203, 238, 1);
}
#myusername:focus{
  box-shadow: 0 0 5px rgba(81, 203, 238, 1);
  border: 1px solid rgba(81, 203, 238, 1);
}
html, body {
        height: 100%;
        margin: 0;
    }

    .container-fluid {
        height: 100%;
        display: table;
        width: auto;
        padding-right: 0;
        padding-left: 0;
    }

    .row-fluid {
        height: 100%;
        display: table-cell;
        vertical-align: middle;
        width: auto;
    }

    .centering {
        float: none;
        margin: 0 auto;
    }
	.center {
		margin: 0 auto;
	}
	</style>
<html>
<div class="container-fluid">
    <div class="row-fluid center"><img src="logo.jpg"></div>
    <div class="row-fluid center">
    <div class="span4 offset4 center">
    <div class="well">
	    <legend><h1>Platform Login</h1></legend>
    		<form method="POST" action="checklogin.php">
		    	<div class=""></div>
			    <input class="span3" placeholder="Username" type="text" name="myusername" id="myusername">
			    <input class="span3" placeholder="Password" type="password" name="mypassword" id="mypassword">
			    <input class="btn-info btn" type="submit" value="Login">
		    </form>
    </div>
    </div>
    </div>
</div>
</html>

