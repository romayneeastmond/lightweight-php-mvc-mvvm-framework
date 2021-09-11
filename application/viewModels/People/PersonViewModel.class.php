<?php
    class Person
    {
        /**
         * @annotation Id(FirstName)
         * @annotation Display(First Name)
         *
         * @var string
         */
        public $firstName;

        /**
         * @annotation Id(LastName)
         * @annotation Display(Last Name)
         *
         * @var string
         */
        public $lastName;

        /**
         * @annotation Id(EmailAddress)
         * @annotation Display(Email Address)
         * @annotation Type(email)
         *
         * @var string
         */
        public $emailAddress;

        /**
         * @annotation Id(Description)
         * @annotation Display(Description)
         *
         * @var string
         */
        public $description;

        /**
         * @annotation Id(Province)
         * @annotation Display(Province)
         * @annotation Value(provinceId)
         *
         * @var array
         */
        public $province;

        /**
         *
         * @var integer
         */
        public $provinceId;

        /**
         * @annotation Id(Gender)
         * @annotation Display(Sex)
         * @annotation Type(radio)
         * @annotation Options(genders)
         *
         * @var string
         */
        public $sex;

        /**
         *
         * @var array
         */
        public $genders;

        /**
         * @annotation Id(Languages)
         * @annotation Display(Languages)
         * @annotation Type(multiple)
         * @annotation Value(language)
         *
         * @var array
         */
        public $languages;

        /**
         *
         * @var array
         */
        public $language;
    } /*end of class Person*/