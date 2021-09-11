<?php
	class AnnotationFactory extends Base
	{
		/**
         * Caller annotations
         *
         * @var array
         */
		private $callerAnnotations;
		
		/**
         * Dependency injection locations
         *
         * @var array
         */
		private $dependenciesLocations;
		
		/**
         * Default constructor
         *
         * @param string             $fileLocation full path location of file
         * @param string             $method the current method whose annotations should be used
         * @param string             $caller determine if the caller is the built in beforeAction or afterAction
         */
		public function __construct($fileLocation, $method, $caller = NULL)
		{
			$this->callerAnnotations = array();
			$this->dependenciesLocations = array();
			
			$annotations = Annotation::discover($fileLocation);
			
			if (isset($annotations[Functions::escapeCamel($method)]))
				$this->callerAnnotations = $annotations[Functions::escapeCamel($method)];
			if (!isset($annotations[$method]) && ($caller == "beforeAction" || $caller == "afterAction"))
				if (isset($annotations[$caller]))
					$this->callerAnnotations = $annotations[$caller];
			
			$this->dispatchAnnotations();
		}
		
		/**
         * Default destructor
         *
         */
		public function __destruct()
		{
			
		}
		
		/**
         * Dispatch annotations
         *
         */
		public function dispatchAnnotations()
		{
			if (!empty($this->callerAnnotations))
			{
				foreach($this->callerAnnotations as $annotation)
				{
					if (strpos($annotation, "DependenciesLocations(") !== false)
						$this->callDependencyInjectionLocations(explode(",", str_replace(")", "", str_replace("DependenciesLocations(" ,"", $annotation))));
					
					if (strpos($annotation, "DependencyInjection(") !== false)
						$this->callDependencyInjection(explode(",", str_replace(")", "", str_replace("DependencyInjection(" ,"", $annotation))));
				}
			}
		}
		
		/**
         * Calls method to set locations used for future Dependency Injections
         *
         * @param array              $locations an array of model directory locations
         * @return void
         */
		private function callDependencyInjectionLocations($locations)
		{
			if (!empty($locations) && is_array($locations))
				$this->dependenciesLocations = $locations;
		}
		
		/**
         * Calls method to set locations used for future Dependency Injections
         *
         * @param array              $modelsList an array of models contained in the dependency location directories
         * @return void
         */
		private function callDependencyInjection($modelsList)
		{
			if (!empty($modelsList) && is_array($modelsList) && !empty($this->dependenciesLocations))
				foreach($modelsList as $key => $model)
					foreach($this->dependenciesLocations as $location)
                    {
                        if (file_exists("application/models/" . trim($location) . "/" . trim($model) . ".class.php"))
                        {
                            include_once("application/models/" . trim($location) . "/" . trim($model) . ".class.php");

                            unset($modelsList[$key]);
                            break;
                        }

                        if (file_exists("application/viewModels/" . trim($location) . "/" . trim($model) . ".class.php"))
                        {
                            include_once("application/viewModels/" . trim($location) . "/" . trim($model) . ".class.php");

                            unset($modelsList[$key]);
                            break;
                        }
                    }
		}
	} /*end of class AnnotationFactory*/