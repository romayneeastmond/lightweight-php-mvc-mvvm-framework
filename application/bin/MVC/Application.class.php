<?php
	class Application extends Base
	{
		/**
         * Application author
         *
         * @var string
         */
		public $applicationAuthor;
		
		/**
         * Application Controller that generates the application
         *
         * @var object
         */
		public $applicationController;
		
		/**
         * Application description
         *
         * @var string
         */
		public $applicationDescription;
		
		/**
         * Application name
         *
         * @var string
         */
		public $applicationName;
		
		/**
         * Application version
         *
         * @var string
         */
		public $applicationVersion;
		
		/**
         * Application year
         *
         * @var string
         */
		public $applicationYear;
		
		/**
         * Default constructor
         *
         * @param object             $frontController a FrontController object
         */
		public function __construct($frontController)
		{
			$this->applicationController = $frontController;
		}

        /**
         * Bootstrap the Application
         *
         * @return Mixed
         */
		public function boot()
		{
            $currentController = "";
            $currentAction = "";

            $url = $this->retrievePotentialUrlAlias($this->applicationController->url(), $currentController, $currentAction);

            if (empty($currentController) && empty($currentAction))
            {
                $currentController = (strpos($url, "/") === false) ? $url : substr($url, 0, strpos($url, "/"));

                $url = str_replace("?" . $_SERVER['QUERY_STRING'], "", $url);

                $currentAction = (strpos($url, "/") === false) ? "index" : str_replace("/", "_", substr($url, strpos($url, "/") + 1, strlen($url)));
                $currentAction = (empty($currentAction)) ? "index" : $currentAction;
                $currentAction = ($currentAction[strlen($currentAction) - 1] == "_") ? substr($currentAction, 0, -1) : $currentAction;
            }

			$originalCurrentAction = $currentAction;
			
			$urlParts = explode("/", $url);

			if (count($urlParts) >= 3)
				$currentAction = $urlParts[1];
			
			$controller = $this->applicationController->dispatch($currentController, $currentAction);

			if (!empty($controller))
			{
				if (is_array($controller->routes) && !in_array(strtolower($currentAction), array_map("strtolower", $controller->routes)))
					$currentAction = $originalCurrentAction;		
				
				if (count($urlParts) >= 3 && is_array($controller->routes) && in_array(strtolower($currentAction), array_map("strtolower", $controller->routes)))
					$this->applicationController->dispatchRouteParameters($currentController, $currentAction, array_slice($urlParts, 2));
			}
			
			if (!empty($controller))
				$controller->action($currentAction);
		}

        /**
          * Retrieves if the given url is actually a url alias
          *
          * @param string             $url a given url
          * @param string             $currentController accepts the controller if an alias is found
          * @param string             $currentAction accepts the action if an alias is found
          * @return string
          */
        private function retrievePotentialUrlAlias($url, &$currentController, &$currentAction)
        {
            if (!file_exists("application/configs/aliases.php"))
                return $url;

            $aliases = new Aliases();

            include_once("application/configs/aliases.php");

            if (isset($aliases->routes) && is_array($aliases->routes))
            {
                $slashCount = 0;

                $urlLookup = $url;

                for ($i = 0; $i < strlen($url); $i++)
                    if ($url[$i] == "/")
                        $slashCount++;

                if ($slashCount > 0)
                    $urlLookup = strtolower(substr($url, 0, strpos($url, "/")));

                if (isset($aliases->routes[$urlLookup]))
                {
                    $aliasParts = explode("/", $aliases->routes[$urlLookup]);
                    $currentController = $aliasParts[0];
                    $currentAction = $aliasParts[1];

                    return join("/", $aliasParts) .substr($url, strpos($url, "/"));
                }
            }

            return $url;
        }

		/**
         * Sets Application specific settings
         *
         * @param string             $name of a given setting
         * @param Mixed              $value a given value to populate the given setting
         * @return Application
         */
		public function setApplicationSettings($name, $value)
		{
			$this->__set($name, $value);
			
			return $this;
		}
	} /*end of class Application*/