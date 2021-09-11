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
            $person->description = "Hello World";
            $person->provinceId = 1;
            $person->province = PeopleService::provinces();
            $person->languages = PeopleService::languages();
            $person->sex = "male";
            $person->genders = PeopleService::genders();
            $person->language = array(1);

            return $person;
        }

        /**
         * Get a list of genders
         *
         * @return array
         */
        public static function genders()
        {
            return array(
                "male" => "Male",
                "female" => "Female",
                "other" => "Other"
            );
        }

        /**
         * Get a list of languages
         *
         * @return array
         */
        public static function languages()
        {
            return array(
                0 => "C#",
                1 => "PHP",
                2 => "Javascript",
                3 => "CSS",
                4 => "HTML",
                5 => "SQL"
            );
        }

        /**
         * Get a list of provinces
         *
         * @return array
         */
        public static function provinces()
        {
            return array(
                0 => "British Columbia",
                1 => "Alberta",
                2 => "Saskatchewan",
                3 => "Manitoba",
                4 => "Ontario",
                5 => "Quebec",
                6 => "New Brunswick",
                7 => "Nova Scotia",
                8 => "Prince Edward Island",
                9 => "Newfoundland and Labador"
            );
        }
    } /*end of class PeopleService*/