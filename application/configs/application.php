<?php
	ini_set('upload_max_filesize', '64M');
	ini_set('max_execution_time', '6000');
	ini_set('max_input_time', '6000');
	ini_set('post_max_size', '10M');
	ini_set('memory_limit', '-1');
	ini_set('include_path', '.');
	ini_set('log_errors', 'On');
	
	include("application/bin/Global/Functions.class.php");
	
	include("application/bin/MVC/Base.class.php");
	include("application/bin/MVC/Annotation.class.php");
	include("application/bin/MVC/AnnotationFactory.class.php");
	include("application/bin/MVC/Application.class.php");
	include("application/bin/MVC/FrontController.class.php");
	include("application/bin/MVC/Alias.class.php");
	include("application/bin/MVC/Bundle.class.php");
	include("application/bin/MVC/View.class.php");