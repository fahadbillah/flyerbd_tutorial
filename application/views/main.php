<!DOCTYPE html>
<html ng-app="FLYERBD">
<head>
	<title>FLYERBD</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>bower_components/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>bower_components/font-awesome/css/font-awesome.css">
	<link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">

	<style type="text/css" media="screen">
		.navbar{
			font-family: 'Russo One', sans-serif;
		}
	</style>

</head>
<body>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#/">FLYERBD</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li class="active"><a href="#/" title="Home">Home <span class="sr-only">(current)</span></a></li>
	        <li><a href="#/about" title="About">About</a></li>
	        <li><a href="#/contact" title="Contact">Contact</a></li>
	      </ul>
	      <form class="navbar-form navbar-left">
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="Search">
	        </div>
	        <button type="submit" class="btn btn-default">Submit</button>
	      </form>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="#/signup">Sign UP</a></li>
	        <li><a href="#/login">Login</a></li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>


	<div class="col-md-2"></div>

	<div class="col-md-8" ng-view></div>

	<div class="col-md-2"></div>

<script src="<?php echo base_url() ?>bower_components/jquery/dist/jquery.js"></script>
<script src="<?php echo base_url() ?>bower_components/bootstrap/dist/js/bootstrap.js"></script>

<script src="<?php echo base_url() ?>bower_components/angular/angular.js"></script>
<script src="<?php echo base_url() ?>bower_components/angular-route/angular-route.js"></script>
<script src="<?php echo base_url() ?>bower_components/oclazyload/dist/ocLazyLoad.js"></script>

<script src="<?php echo base_url() ?>assets/js/app.js"></script>

</body>
</html>