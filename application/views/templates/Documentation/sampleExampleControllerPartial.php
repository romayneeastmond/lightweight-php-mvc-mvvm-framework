<?php
    class ExampleController extends FrontController
    {
        /**
         * URL: Example/viewPartial/
         * Alias: partial-view-example/
         *
         * @return View
         */
        public function viewPartialAction()
        {
            $this->createExampleDisplayTemplate("Partial Views Example", "_viewPartial");

            return $this->view();
        }

        /**
         * Creates the necessary settings for an example type file
         *
         * @param string             $title title to load into template
         * @param string             $partial name of partial view to load into template
         * @return void
         */
        private function createExampleDisplayTemplate($title, $partial)
        {
            $this->view->title = $title;
            $this->view->partial = $partial;

            $this->view->renderer("Example", "example");
        }
    } /*end of class ExampleController*/