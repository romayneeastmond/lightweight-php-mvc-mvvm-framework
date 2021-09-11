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
        }
    } /*end of class ErrorController*/