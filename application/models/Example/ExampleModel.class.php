<?php
    class ExampleModel
    {
        /**
         * Returns a simple string message
         *
         * @return string
         */
        public function whatIsMyName()
        {
            return "ExampleModel";
        }

        /**
         * Returns a class statement if parameters match
         *
         * @param int                $menuIndex menuIndex of currently set
         * @param int                $index index of menu
         * @return string
         */
        public function isMenuActive($menuIndex, $index) 
        {
            if ($menuIndex == $index)
            {
                return "active";
            }

            return "";
        }
    } /*end of class ExampleModel*/