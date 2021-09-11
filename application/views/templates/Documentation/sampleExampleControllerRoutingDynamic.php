<?php
    class ExampleController extends FrontController
    {
        /**
         * Initialization
         *
         */
        public function initialize()
        {
            $this->addRoute("blog");
        }

        /**
         * URL: Example/blog/
         * Route: Example/blog/
         *
         * @return View
         */
        public function blogAction()
        {
            $this->view->title = "Blog Entry";

            return $this->view();
        }
    } /*end of class ExampleController*/