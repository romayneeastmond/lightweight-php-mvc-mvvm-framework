<?php
	class IndexController extends FrontController
	{
		/**
         * URL: Index/
         * Alias: welcome/
         *
         * @return View
         */
		public function indexAction()
		{
			$this->view->title = "Welcome";
            $this->view->subTitle = "MVC/MVVM Annotations Framework";
            $this->view->menuHomeActive = true;

			return $this->view();
		}

        /**
         * URL: Index/about/
         * Alias: about/
         *
         * @return View
         */
        public function aboutAction()
        {
            $this->view->title = "About";
            $this->view->menuAboutActive = true;

            return $this->view();
        }

        /**
         * URL: Index/contact/
         * Alias: contact/
         *
         * @return View
         */
        public function contactAction()
        {
            $this->view->title = "Contact";
            $this->view->menuContactActive = true;

            return $this->view();
        }

        /**
         * URL: Index/examples/
         * Alias: examples/
         *
         * @return View
         */
        public function examplesAction()
        {
            $this->view->title = "Examples";

            return $this->view();
        }
	} /*end of class IndexController*/