<?php
    class ExampleController extends FrontController
    {
        /**
         * URL: Example/articles/?name=&year=&month=
         *
         * @param string             $name a dummy holder for name of fake article
         * @param string             $year a dummy holder for year of fake article
         * @param string             $month a dummy holder for month of fake article
         * @return View
         */
        public function articlesAction($name = "", $year = "", $month = "")
        {
            $this->view->title = "Articles Route Test";
            $this->view->content = "Hello World from the <b>ExampleController articlesAction</b> action<br /><br />";

            $this->view->myBoundParameters = array(
                $name, $year, $month
            );

            return $this->view();
        }

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