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
    } /*end of class Person*/