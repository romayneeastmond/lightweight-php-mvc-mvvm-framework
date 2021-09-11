<?php
    class ExampleController extends FrontController
    {
        /**
         * URL: Example/helloWorld/
         *
         * @return View
         */
        public function helloWorldAction()
        {
            $this->view->title = "Hello World";
            $this->view->whoAmI = $this->model->whatIsMyName();

            $this->view->renderer("Example", "hello");

            return $this->view();
        }
    } /*end of class ExampleController*/