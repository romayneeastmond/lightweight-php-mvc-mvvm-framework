<?php
	class View extends Base
	{
		/**
         * View breadcrumbs
         *
         * @var array
         */
		public $breadcrumbs;
		
		/**
         * View content
         *
         * @var Mixed
         */
		public $content;
		
		/**
         * Accepts CSS files
         *
         * @var array
         */
		public $cssFiles;
		
		/**
         * Display view errors
         *
         * @var boolean
         */
		public $displayErrors;
		
		/**
         * Accepts javascript files
         *
         * @var array
         */
		public $javascriptFiles;
		
		/**
         * View layout
         *
         * @var string
         */
		public $layout;
		
		/**
         * Current View Output Type (html, xml, json, plain, none)
         *
         * @var string
         */
		public $outputType;
		
		/**
         * Current View Partials
         *
         * @var array
         */
		public $partials;
		
		/**
         * Current View Title
         *
         * @var string
         */
		public $title;
		
		/**
         * Current View Directory
         *
         * @var string
         */
		public $viewDirectory;
		
		/**
         * Current View File
         *
         * @var string
         */
		public $viewFile;
		
		/**
         * Default constructor
         *
         * @param string             $viewDirectory a sub directory located in the application/views/templates directory
         * @param string             $viewFile a file located in the viewDirectory without the trailing extension, e.g. index (which automatically looks for index.php)
         */
		public function __construct($viewDirectory = "Default", $viewFile = "index")
		{
			$this->breadcrumbs = array();
			$this->content = "";
			$this->layout = "Master/index.php";
			$this->outputType = "html";
			$this->partials = array();
			$this->title = "";
			$this->viewDirectory = $viewDirectory;
			$this->viewFile = $viewFile;
			
			$this->displayErrors = true;
			
			$this->cssFiles = array();
			$this->javascriptFiles = array();
		}
		
		/**
         * Overloaded toString
         *
         * @return string
         */
		public function __toString()
		{
			if ($this->outputType == "html")
				include("application/layouts/" .$this->layout);
			
			if ($this->outputType == "plain" || $this->outputType == "none")
				include("application/layouts/Master/plain.php");

            if ($this->outputType == "json")
                include("application/layouts/Master/json.php");

			if ($this->outputType == "xml")
				include("application/layouts/Master/xml.php");
			
			return "";
		}

        /**
         * Add bundle into the current view using fluent interface
         *
         * @param string             $name of the given bundle
         * @return View
         */
        public function addBundle($name)
        {
            if (file_exists("application/configs/bundles.php"))
            {
                $bundles = array();

                include("application/configs/bundles.php");

                if (isset($bundles[$name])) {
                    if (is_array($bundles[$name]->cssFiles) && count($bundles[$name]->cssFiles) > 0)
                        $this->cssFiles = array_merge($bundles[$name]->cssFiles, $this->cssFiles);

                    if (is_array($bundles[$name]->javascriptFiles) && count($bundles[$name]->javascriptFiles) > 0)
                        $this->javascriptFiles = array_merge($bundles[$name]->javascriptFiles, $this->javascriptFiles);
                }
            }

            return $this;
        }

		/**
         * Add CSS files into the current view layout using fluent interface
         *
         * @param string             $css path of the given css
         * @return View
         */
		public function addCSS($css)
		{
			$this->cssFiles[] = $css;
			
			return $this;
		}
		
		/**
         * Add javascript files into the current view layout using fluent interface
         *
         * @param string             $javascript path of the given javascript
         * @return View
         */
		public function addJavascript($javascript)
		{
			$this->javascriptFiles[] = $javascript;
			
			return $this;
		}

        /**
         * Binds the current viewModel to the view using ob_get_contents to format the buffered output
         *
         * @return void
         */
        public function bindEnd()
        {
            if (!isset($this->viewModel))
                return;

            $buffer = ob_get_contents();

            ob_end_clean();

            $formattedOutput = array();
            $keys = array_keys($this->viewModel);

            $rawOutput = explode("\n", $buffer);

            foreach($rawOutput as $line)
            {
                foreach($keys as $key)
                {
                    $originalKey = $key;
                    $key = str_replace("\$", "", $key);

                    if (strpos($line, "php-input-for=\"" .$key . "\"") !== false)
                    {
                        $type = $this->bindingValueSearch($originalKey, "Type(");
                        $selectValue = $this->bindingValueSearch($originalKey, "Value(");
                        
                        if (!empty($type) && strpos($line, "<select") === false)
                            $type = " type=\"" .$type ."\"";

                        $line = str_replace("php-input-for=\"" .$key . "\"", "name=\"" .(empty($selectValue) ? (($this->bindingValueSearch($originalKey, "Type(") == "checkbox") ? $key ."[]" : $key) : (($this->bindingValueSearch($originalKey, "Type(") == "multiple") ? $selectValue ."[]": $selectValue)) ."\"", $line);
                        $line = str_replace("<textarea ", "<textarea" .$type ." id=\"" . $this->bindingValueSearch($originalKey, "Id(") . "\" ", $line);
                        $line = str_replace("<select ", "<select " .$type ." id=\"" . $this->bindingValueSearch($originalKey, "Id(") . "\" ", $line);
                        $line = str_replace("<option ", "<option" .$type ." id=\"" . $this->bindingValueSearch($originalKey, "Id(") . "\" ", $line);
                        $line = str_replace("<input ", "<input" .$type ." id=\"" . $this->bindingValueSearch($originalKey, "Id(") . "\" ", $line);

                        if (strpos($line, "<input type=\"radio\"") !== false || strpos($line, "<input type=\"checkbox\"") !== false )
                        {
                            $optionsValue = $this->bindingValueSearch($originalKey, "Options(");

                            if (isset($this->boundModel->{$optionsValue}) && is_array($this->boundModel->{$optionsValue}))
                            {
                                $value = (isset($this->boundModel->{$key})) ? $this->boundModel->{$key} : "";

                                if (!empty($value) && !is_array($value))
                                    $value = array($value);

                                $line = str_replace("php-value-for=\"" . $key . "\"", "", $line);
                                $line = str_replace(" id=\"" . $this->bindingValueSearch($originalKey, "Id(") . "\" ", " ", $line);

                                $lineParts = explode(" ", trim(str_replace("</input>", " />", $line)));

                                $optionsLine = "";

                                foreach($this->boundModel->{$optionsValue} as $v => $k)
                                    $optionsLine .= str_replace($lineParts[count($lineParts) - 1], " value=\"" .$v ."\" " .((in_array($v, $value)) ? " checked" : "") .$lineParts[count($lineParts) - 1] .$k ."<br />\n", implode(" ", $lineParts));

                                $line = $optionsLine;
                            }
                        }
                    }

                    if (strpos($line, "php-label-for=\"" .$key . "\"") !== false)
                    {
                        $line = str_replace("php-label-for=\"" . $key . "\"", "", $line);
                        $line = str_replace("<label ", "<label for=\"" . $this->bindingValueSearch($originalKey, "Id(") . "\"", $line);
                        $line = str_replace("</label>", $this->bindingValueSearch($originalKey, "Display(") . "</label>", $line);
                    }

                    if (strpos($line, "php-value-for=\"" .$key . "\"") !== false && isset($this->boundModel) && is_object($this->boundModel))
                    {
                        $value = (isset($this->boundModel->{$key}) && !is_array($this->boundModel->{$key})) ? $this->boundModel->{$key} : "";

                        if (strpos($line, "</select>") !== false)
                        {
                            if (isset($this->boundModel->{$key}) && is_array($this->boundModel->{$key}))
                            {
                                $value = "";

                                $selectValue = $this->bindingValueSearch($originalKey, "Value(");

                                if (!empty($selectValue) && isset($this->boundModel->{$selectValue}))
                                {
                                    $selectValue = $this->boundModel->{$selectValue};

                                    if (!empty($selectValue) && !is_array($selectValue))
                                        $selectValue = array($selectValue);

                                    foreach($this->boundModel->{$key} as $v => $k)
                                        $value .= "<option value=\"" . $v . "\"" .((in_array($v, $selectValue)) ? " selected" : "") .">" . $k . "</option>\n";
                                }

                                $line = str_replace("php-value-for=\"" . $key . "\"", "", str_replace("</select>", $value . "</select>", $line));
                            }
                        }

                        if (strpos($line, "</textarea>") !== false)
                            $line = str_replace("php-value-for=\"" . $key . "\"", "" ,str_replace("</textarea>", $value ."</textarea>", $line));

                        $line = str_replace("php-value-for=\"" . $key . "\"", "value=\"" .$value ."\"", $line);
                    }
                }

                $formattedOutput[] = $line;
            }

            echo implode("\n", $formattedOutput);
        }

        /**
         * Binds the current viewModel to the view using ob_start to intercept the buffered output
         *
         * @return void
         */
        public function bindStart()
        {
            if (!isset($this->viewModel))
                return;

            ob_start();
        }

		/**
         * Returns the breadcrumb array in human readable format
         *
         * @return string
         */
		public function displayBreadcrumbs()
		{
			if (is_array($this->breadcrumbs) && count($this->breadcrumbs) > 0)
			{
				$breadcrumbs = "<ol class=\"breadcrumb\">";
				$breadcrumbCount = 0;
				
				foreach($this->breadcrumbs as $key => $value)
				{
					$breadcrumbCount++;
					if (count($this->breadcrumbs) != $breadcrumbCount)
						$breadcrumbs .= "<li><a href=\"" .$key ."\">" .$value ."</a></li>";
					else
                        $breadcrumbs .= "<li class=\"active\">" .$value ."</li>";
				}

                $breadcrumbs .= "</ol>";
				
				echo $breadcrumbs;
			}

			echo "";
		}		
		
		/**
         * Injects CSS files into the current view layout
         *
         * @return string
         */
		public function injectCSS()
		{
			if (!empty($this->cssFiles) && is_array($this->cssFiles))
				foreach($this->cssFiles as $css)
					echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"" .$this->path() .$css ."\">\n";
		}
		
		/**
         * Injects javascript files into the current view layout
         *
         * @return string
         */
		public function injectJavascript()
		{
			if (!empty($this->javascriptFiles) && is_array($this->javascriptFiles))
				foreach($this->javascriptFiles as $javascript)
					echo "<script type=\"text/javascript\" language=\"javascript\" src=\"" .$this->path() .$javascript ."\"></script>\n";
		}

		/**
         * Populates a view form field with either the provided value or a post value
         *
         * @param string             $value the default value
         * @param string             $postValue the post value for post requests
         * @return string
         */
		public function populateViewPostValue($value, $postValue)
		{
			if ($_SERVER['REQUEST_METHOD'] == "POST")
				return stripslashes(trim(htmlspecialchars($postValue)));
			
			return stripslashes(trim(htmlspecialchars($value)));
		}
		
		/**
         * Renders the view body
         *
         * @return Mixed
         */
		public function renderBody()
		{
			try
			{
				if ($this->outputType == "html")
				{
					if (!file_exists("application/views/templates/" .$this->viewDirectory ."/" .$this->viewFile .".php"))
						throw new Exception($this->viewDirectory ."/" .$this->viewFile .".php does not exist");
					
					include("application/views/templates/" .$this->viewDirectory ."/" .$this->viewFile .".php");
				}
				else
					echo $this->content;
			}
			catch (Exception $e)
			{
				if ($this->displayErrors)
					Functions::dump($e->getMessage());
				
				$this->displayErrors = false;
			}
		}
		
		/**
         * Sets the view renderer
         *
         * @param string             $viewDirectory a sub directory located in the application/views/templates directory
         * @param string             $viewFile a file located in the viewDirectory without the trailing extension, e.g. index (which automatically looks for index.php)
         * @return void
         */
		public function renderer($viewDirectory, $viewFile)
		{
			try
			{
				if ($viewDirectory == NULL || $viewFile == NULL || empty($viewDirectory) || empty($viewFile))
					throw new Exception("View directory and view file are both required.");
				
				if (!file_exists("application/views/templates/" .$viewDirectory ."/" .$viewFile .".php"))
					throw new Exception($viewDirectory ."/" .$viewFile .".php does not exist");
				
				$this->viewDirectory = $viewDirectory;
				$this->viewFile = $viewFile;
			}
			catch (Exception $e)
			{
				if ($this->displayErrors)
					Functions::dump($e->getMessage());
				
				$this->displayErrors = false;
			}
		}

        /**
         * Renders the form body
         *
         * @param string             $location the location of the form view
         * @param string             $file the actual form file
         * @return Mixed
         */
        public function renderFormView($location, $file)
        {
            try
            {
                if (!file_exists("application/views/forms/" .$location ."/" .$file .".php") && !file_exists("application/views/forms/" .$location ."/" .$file .".form.php"))
                    throw new Exception($location ."/" .$file .".php or " .$location ."/" .$file ."form.php form does not exist");

                if (file_exists("application/views/forms/" .$location ."/" .$file .".php"))
                    include("application/views/forms/" .$location ."/" .$file .".php");
                else if (file_exists("application/views/forms/" .$location ."/" .$file .".form.php"))
                    include("application/views/forms/" .$location ."/" .$file .".form.php");
            }
            catch (Exception $e)
            {
                if ($this->displayErrors)
                    Functions::dump($e->getMessage());

                $this->displayErrors = false;
            }
        }
		
		/**
         * Renders the view body
         *
         * @param string             $location the location of the partial view
         * @param string             $file the actual view file
         * @return Mixed
         */
		public function renderPartialView($location, $file)
		{
			try
			{		
				if (!file_exists("application/views/templates/" .$location ."/" .$file .".php"))
					throw new Exception($location ."/" .$file .".php partial view does not exist");
				
				include("application/views/templates/" .$location ."/" .$file .".php");
			}
			catch (Exception $e)
			{
				if ($this->displayErrors)
					Functions::dump($e->getMessage());
				
				$this->displayErrors = false;
			}					
		}

        /**
         * Searches current bound view model for values matching the key and type provided
         *
         * @param string             $key the given key found in the view model
         * @param string             $type the type of binding ending with a closing bracket, e.g. Display(, or Id(, or Etc(
         * @return string
         */
        private function bindingValueSearch($key, $type)
        {
            if (isset($this->viewModel[$key]) && is_array($this->viewModel[$key]))
                foreach($this->viewModel[$key] as $definition)
                    if (strpos($definition, $type) !== false)
                        return str_replace(")", "", str_replace($type, "", $definition));

            return "";
        }
	} /*end of class View*/