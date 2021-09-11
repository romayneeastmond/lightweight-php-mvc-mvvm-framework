<?php
	class FrontController extends Base
	{
		/**
         * Current action
         *
         * @var string
         */
		public $action;
		
		/**
         * Current Controller name without suffix, e.g. Index
         *
         * @var string
         */
		public $controller;
		
		/**
         * Current Controller name including suffix, e.g. IndexController
         *
         * @var string
         */
		public $controllerName;

        /**
         * Current Request Method, e.g. POST or GET
         *
         * @var string
         */
        public $method;

		/**
         * Default Model that is bound to the Controller
         *
         * @var object
         */
		public $model;

		/**
         * Current Routes
         *
         * @var array
         */
		public $routes;

		/**
         * Current URL
         *
         * @var string
         */
		public $url;

		/**
         * Current View
         *
         * @var object
         */
		public $view;

		/**
         * Default constructor
         *
         */
		public function __construct()
		{

		}

		/**
         * Default destructor
         *
         */
		public function __destruct()
		{

		}

		/**
         * Calls the action of the current object (i.e. an action of a Controller)
         *
         * @param string             $action the name of the action without the trailing word Action, e.g. index as opposed to indexAction
         * @return Mixed
         */
		public function action($action)
		{
			try
			{
				$actionNameExceptions = array("initialize", "after", "before");

				if (in_array(strtolower($action), $actionNameExceptions))
					throw new Exception("An invalid action has been defined.");

				$action .= "Action";

				if ($_SERVER['REQUEST_METHOD'] == "GET")
					if (!method_exists($this->__get("controllerName"), $action))
						throw new Exception($action . " does not exist");

				if ($_SERVER['REQUEST_METHOD'] == "POST")
					if (!method_exists($this->__get("controllerName"), $action) && !method_exists($this->__get("controllerName"), str_replace("Action", "PostAction", $action)))
						throw new Exception($action . " does not exist");
					else if (method_exists($this->__get("controllerName"), str_replace("Action", "PostAction", $action)))
					{
						$action = str_replace("Action", "PostAction", $action);
						$this->__set("action", str_replace("PostAction", "Post", $action));
					}

				$this->beforeAction();

				$annotationFactory = new AnnotationFactory(FrontController::retrieveControllerFileLocation($this->__get("controllerName")), $action);
				$this->dispatchAction($action);

				$this->afterAction();
			}
			catch (Exception $e)
			{
				Functions::dump($e->getMessage());
			}
		}

		/**
         * Creates a potential route in the current controller, e.g. Controller/Route/Action/?QueryString=
         *
         * @param string             $routeName the name of the given route
         * @return void
         */
		public function addRoute($routeName)
		{
			if ($this->routes == NULL)
				$this->routes = array();

			if (!in_array($routeName, $this->routes))
				$this->routes[] = $routeName;
		}

		/**
         * Default event for after an action has been called
         *
         * @return void
         */
		public function afterAction()
		{
			$annotationFactory = new AnnotationFactory(FrontController::retrieveControllerFileLocation($this->__get("controllerName")), $this->__get("action"), "afterAction");

			return;
		}

		/**
         * Default event for before an action has been called
         *
         * @return void
         */
		public function beforeAction()
		{
			$annotationFactory = new AnnotationFactory(FrontController::retrieveControllerFileLocation($this->__get("controllerName")), $this->__get("action"), "beforeAction");

			return;
		}

		/**
         * Default index action that all controllers inheriting from FrontController will have
         *
         * @return string
         */
		public function indexAction()
		{
			echo "Welcome to the " .$this->__get("controllerName") ." default Action.<br>
				 To overwrite this message, create an indexAction() method in the current " .$this->__get("controllerName") ."!";
		}

		/**
         * Static method that dispatches a controller based on the provided controller and action name
         *
         * @param string             $controller the name of the controller without the trailing word Controller, e.g. Index as opposed to IndexController
         * @param string             $action the name of the action without the trailing word Action, e.g. index as opposed to indexAction
         * @return object
         */
		public static function dispatch($controller = "Index", $action = "index")
		{
			try
			{
				$controllerName = $controller ."Controller";
				$controllerLocation = FrontController::retrieveControllerFileLocation($controllerName);

				if (!file_exists($controllerLocation))
					throw new Exception($controllerName . ".class.php does not exist");

				include($controllerLocation);

				eval("\$object = new " .$controllerName ."();");

				$object->__set("action", $action);
				$object->__set("controller", $controller);
				$object->__set("controllerName", $controllerName);
				$object->__set("url", FrontController::retrieveURL());
				$object->__set("method", FrontController::retrieveMethod());
				$object->__set("model", FrontController::retrieveModel($controller));
				$object->__set("view", new View($controller, $action));

				if (method_exists($object, "initialize"))
				{
					$annotationFactory = new AnnotationFactory($controllerLocation, "initialize");

					$object->initialize();
				}

				return $object;
			}
			catch (Exception $e)
			{
				Functions::dump($e->getMessage());
				return NULL;
			}
		}

		/**
         * Method that dispatches an action based on the provided action name by binding any action variables to $_GET or $_POST values
         *
         * @param string             $action the name of the action without the trailing word Action, e.g. index as opposed to indexAction
         * @return Mixed
         */
		public function dispatchAction($action)
		{
			$reflector = new ReflectionMethod($this, $action);

			$parameters = array();

			foreach($reflector->getParameters() as $parameter)
				if (isset($_GET[$parameter->name]))
			    	$parameters[] = htmlspecialchars(urldecode($_GET[$parameter->name]));
				else if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST[$parameter->name]))
					$parameters[] = htmlspecialchars($_POST[$parameter->name]);

			call_user_func_array(array($this, $action), $parameters);
		}

		/**
         * Method that dispatches parameters of a route and binds them to any action variables to $_GET or $_POST values
         *
         * @param string             $controller the name of the controller without the trailing word Controller, e.g. Index as opposed to IndexController
         * @param string             $action the name of the action without the trailing word Action, e.g. index as opposed to indexAction
         * @param array              $routeParameters the array containing the route parameters to be bound in sequential order
         * @return void
         */
		public function dispatchRouteParameters($controller, $action, $routeParameters)
		{
			if (!is_array($routeParameters) || (is_array($routeParameters) && strlen(implode($routeParameters)) == 0))
                return;

            $reflector = new ReflectionMethod($controller ."Controller", $action ."Action");

			if ($reflector != NULL)
			{
				$count = 0;

				foreach($reflector->getParameters() as $parameter)
				{
					if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($routeParameters[$count]))
						$_GET[$parameter->name] = $routeParameters[$count];

					if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($routeParameters[$count]))
						$_POST[$parameter->name] = $routeParameters[$count];

					$count++;
				}
			}
		}

		/**
         * Outputs the current View
         *
         * @return Mixed
         */
		public function view()
		{
			echo $this->view;
		}

        /**
         * Outputs the current View Model
         *
         * @param object|string      $viewModel the name of the location of the view model relative to the viewModels directory
         * @param object             $boundModel an optional object to manually bind to the view
         * @return Mixed
         */
        public function viewModel($viewModel = NULL, $boundModel = NULL)
        {
            if (!empty($viewModel) && is_string($viewModel))
                if (file_exists("application/viewModels/" .$viewModel ."ViewModel.class.php"))
                {
                    $annotations = Annotation::discover("application/viewModels/" . $viewModel . "ViewModel.class.php");

                    if (!empty($annotations))
                        $this->view->viewModel = $annotations;
                    else
                    {
                        include_once("application/viewModels/" .$viewModel ."ViewModel.class.php");
                        eval("\$object = new " .substr($viewModel, strrpos($viewModel, "/") + 1) ."();");

                        $this->view->viewModel = array_fill_keys(array_keys((array)$object), NULL);
                    }
                }

            if (!empty($viewModel) && is_object($viewModel))
            {
                $this->view->viewModel = array_fill_keys(array_keys((array)$viewModel), NULL);

                if ($boundModel == NULL)
                    $boundModel = $viewModel;
            }

            if (!empty($viewModel) && !is_string($viewModel) && !is_object($viewModel))
                $this->view->viewModel = $viewModel;

            $this->view->boundModel = $boundModel;

            echo $this->view;
        }

		/**
         * Retrieves the given controller file location
         *
         * @param string             $controller the name of the controller with the trailing word Controller, e.g. IndexController
         * @return string
         */
		public static function retrieveControllerFileLocation($controller)
		{
			return "application/controllers/" .$controller .".class.php";
		}

        /**
         * Retrieves the current request method, e.g. POST or GET
         *
         * @return string
         */
        public static function retrieveMethod()
        {
            return strtoupper($_SERVER['REQUEST_METHOD']);
        }

		/**
         * Retrieves the default model (if it exists) of the current controller, e.g. IndexModel
         *
         * @param string             $controller the name of the controller without the trailing word Controller, e.g. Index as opposed to IndexController
         * @return object
         */
		public static function retrieveModel($controller)
		{
			if (file_exists("application/models/" .$controller ."/" .$controller ."Model.class.php"))
			{
				include_once("application/models/" .$controller ."/" .$controller ."Model.class.php");
				eval("\$object = new " .$controller ."Model();");

				return $object;
			}

			return NULL;
		}

        /**
         * Retrieves a parameter from the global $_GET or $_POST arrays
         *
         * @param string             $name the name of the parameter being retrieved
         * @param string             $type the optional type of parameter being retrieved, e.g. POST or GET
         * @param string             $fallbackValue the optional value to return if retrieval fails
         * @return Mixed
         */
        public function retrieveParameter($name, $type = "", $fallbackValue = NULL)
        {
            if (!empty($type) && strtolower($type) == "get" && isset($_GET[$name]))
                return $_GET[$name];

            if (!empty($type) && strtolower($type) == "post" && isset($_POST[$name]))
                return $_POST[$name];

            if (isset($_GET[$name]))
                return $_GET[$name];

            if (isset($_POST[$name]))
                return $_POST[$name];

            if (!empty($fallbackValue))
                return $fallbackValue;

            return NULL;
        }

		/**
         * Retrieves the current MVC formatted URL, e.g. Index or Controller/Action/?QueryString=
         *
         * @return string
         */
		public static function retrieveURL()
		{
			$url = substr(str_replace(str_replace("/index.php", "", $_SERVER['SCRIPT_NAME']), "", $_SERVER['REQUEST_URI']), 1);
			
			return (empty($url)) ? "Index" : $url;
		}
		
		/**
         * Static accessor for the URL variable
         *
         * @return string
         */
		public static function url()
		{
			return FrontController::retrieveURL();
		}
	} /*end of class FrontController*/