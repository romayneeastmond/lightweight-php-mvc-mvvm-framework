<?php
    class PeopleService
    {
        /**
         * Get a single Person object
         *
         * @return Person
         */
        public static function get()
        {
            $person = new Person();

            $person->firstName = "Romayne";
            $person->lastName = "Eastmond";
            $person->emailAddress = "info@calgarywebdev.com";

            return $person;
        }
    } /*end of class PeopleService*/