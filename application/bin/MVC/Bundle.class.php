<?php
    class Bundle
    {
        /**
          * Accepts CSS files
          *
          * @var array
          */
        public $cssFiles;

        /**
          * Accepts javascript files
          *
          * @var array
          */
        public $javascriptFiles;

        /**
          * Default constructor
          *
          * @param array              $css an array containing css references
          * @param array              $js an array containing javascript references
          */
        public function __construct($css, $js)
        {
            $this->cssFiles = $css;
            $this->javascriptFiles = $js;
        }
    } /*end of class Bundle*/