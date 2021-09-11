<?php
	class ErrorController extends FrontController
	{
		/**
         * Initialization
         *
         */
		public function initialize()
		{
            $this->addRoute($this->action);
			$this->view->renderer("Index", "error");
		}

        /**
         * URL: Error/index/
         * Alias: error/
         *
         * @param string             $type the error code to display within the error template
         * @return View
         */
        public function indexAction($type = "")
        {
            $this->view->title = "Error " .$type;
            $this->view->type = $type;

            return $this->view();
        }
	} /*end of class ErrorController*/