<!DOCTYPE html>
<html ng-app="FLYERBD">
<head>
    <base href="http://localhost/flyerbd/">
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
	<div id="fb-root"></div>

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
	      <a class="navbar-brand" href="<?php echo base_url() ?>">FLYERBD</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li><a href="<?php echo base_url() ?>" title="Home">Home <span class="sr-only">(current)</span></a></li>
	        <li><a href="<?php echo base_url() ?>about" title="About">About</a></li>
	        <li><a href="<?php echo base_url() ?>contact" title="Contact">Contact</a></li>
	      </ul>
	      <form class="navbar-form navbar-left">
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="Search">
	        </div>
	        <button type="submit" class="btn btn-default">Submit</button>
	      </form>
	      <ul class="nav navbar-nav navbar-right">
	        <li ng-if="!user.logged_in" class="active"><a href="<?php echo base_url() ?>signup">Sign UP</a></li> <!-- when user logged in signup link will disappear -->
	        <li ng-if="!user.logged_in"><a href="<?php echo base_url() ?>login">Login</a></li> <!-- when user logged in login link will also disappear -->
	        
	        <li ng-if="!!user.logged_in"><a href="<?php echo base_url() ?>user/{{user.user_id}}">{{user.user_name}}</a></li> <!-- after user login profile link will be visible -->
	        
	        <li ng-if="!!user.logged_in"><a href="<?php echo base_url() ?>login?logout=true">Logout</a></li> <!-- after user login logout link will be visible -->
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
<script src="<?php echo base_url() ?>bower_components/angular-cookies/angular-cookies.js"></script>
<script src="<?php echo base_url() ?>bower_components/ng-facebook/ngFacebook.js"></script>
<script src="<?php echo base_url() ?>bower_components/oclazyload/dist/ocLazyLoad.js"></script>
<script src="<?php echo base_url() ?>bower_components/ng-facebook/ngFacebook.js"></script>

<script src="<?php echo base_url() ?>assets/js/app.js"></script>

</body>
</html>