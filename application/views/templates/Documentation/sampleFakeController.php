<?php
    class FakeController extends FrontController
    {
        /**
         * @return View
         */
        public function addAction()
        {
            $this->view->title = "Add Person";

            $this->view->breadcrumbs = array(
                $this->route("Index") => "Home",
                $this->route("People", "list") => "List People",
                "" => "Add Person"
            );

            $this->view->addBundle("knockout")
                       ->addBundle("sweetalert")
                       ->addJavascript("public/js/people.add.js");

            return $this->view();
        }
    } /*end of class FakeController*/