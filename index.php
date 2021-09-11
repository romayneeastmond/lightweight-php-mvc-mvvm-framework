<?php
	include("application/configs/application.php");
	
	$application = new Application(new FrontController());
	
	$application->setApplicationSettings("applicationName", "MVC Annotations Framework")
				->setApplicationSettings("applicationDescription", "")
				->setApplicationSettings("applicationAuthor", "Calgary Web Dev")
				->setApplicationSettings("applicationVersion", "1.00.2012.03.10")
				->setApplicationSettings("applicationYear", date("Y"));
	
	$application->boot();