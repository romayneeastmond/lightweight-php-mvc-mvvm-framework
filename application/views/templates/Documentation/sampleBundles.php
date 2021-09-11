<?php
    $bundles['datetimepicker'] = new Bundle(
        array(
            "public/js/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"
        ),
        array(
            "public/js/moment/min/moment-with-locales.min.js",
            "public/js/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"
        )
    );

    $bundles['knockout'] = new Bundle(
        array(
        ),
        array(
            "public/js/knockout/knockout-3.3.0.js",
            "public/js/knockout/knockout.mapping-2.4.1.js"
        )
    );

    $bundles['sweetalert'] = new Bundle(
        array(
            "public/js/sweetalert/dist/sweetalert.css"
        ),
        array(
            "public/js/sweetalert/dist/sweetalert.min.js"
        )
    );