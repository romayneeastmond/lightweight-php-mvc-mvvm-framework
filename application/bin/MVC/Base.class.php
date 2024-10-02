<?php
class Base
{
    /**
     * Overloaded accessor
     *
     * @param string             $name of a given parameter
     * @return Mixed
     */
    public function __get($name)
    {
        return (isset($this->$name)) ? $this->$name : NULL;
    }

    /**
     * Overloaded mutator
     *
     * @param string             $name of a given parameter
     * @param Mixed              $value a given value to populate the given parameter
     * @return void
     */
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    /**
     * Overloaded toString
     *
     * @return string
     */
    public function __toString()
    {
        $thisString = "";

        foreach ($this as $key => $value)
            $thisString .= $key . " => " . $value . "<br>";

        return $thisString;
    }

    /**
     * Includes escape characters in a given value
     *
     * @param Mixed              $value a scalar or array value to be escaped
     * @param string             $defaultValue if value is empty, provide a replacement string
     * @return Mixed
     */
    public static function capture($value, $defaultValue = NULL)
    {
        if (is_array($value))
            return array_map("Functions::capture", $value);

        return Functions::capture($value, $defaultValue);
    }

    /**
     * Removes escape characters in a given value
     *
     * @param Mixed              $value a scalar or array value to be escaped
     * @param string             $defaultValue if value is empty, provide a replacement string
     * @return Mixed
     */
    public static function escape($value, $defaultValue = NULL)
    {
        if (is_array($value))
            return array_map("Functions::escape", $value);

        return Functions::escape($value, $defaultValue);
    }

    /**
     * Removes any unwanted characters from a given value
     *
     * @param Mixed              $value a scalar or array value to be escaped
     * @return Mixed
     */
    public static function escapeComplete($value)
    {
        if (is_array($value))
            return array_map("Functions::escapeComplete", $value);

        return Functions::escapeComplete($value);
    }

    /**
     * Determines if the given value is empty
     *
     * @param mixed              $value the given value
     * @return boolean
     */
    public static function isEmpty($value)
    {
        return empty($value);
    }

    /**
     * Returns the current calling path of the application
     *
     * @return string
     */
    public static function path()
    {
        return str_replace(substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], "/") + 1), "", str_replace($_SERVER['DOCUMENT_ROOT'], "", $_SERVER['SCRIPT_FILENAME']));
    }

    /**
     * Creates a redirect based on the given controller and action
     *
     * @param string             $controller the name of the controller without the trailing word Controller, e.g. Index as opposed to IndexController
     * @param string             $action the name of the action without the trailing word Action, e.g. index as opposed to indexAction
     * @param array              $parameters an optional associative array of parameters to build a query string
     * @return void
     */
    public function redirect($controller, $action, $parameters = NULL)
    {
        $redirectURL = $this->route($controller, $action);

        header("Location: " . $redirectURL . $this->queryString($parameters));
    }

    /**
     * Creates a redirect to a route based on the given controller and action
     *
     * @param string             $controller the name of the controller without the trailing word Controller, e.g. Index as opposed to IndexController
     * @param string             $action the name of the action without the trailing word Action, e.g. index as opposed to indexAction
     * @param array              $parameters an optional associative array of parameters to build a query string
     * @return void
     */
    public function redirectToRoute($controller, $action, $parameters = NULL)
    {
        $redirectURL = $this->route($controller, $action);

        header("Location: " . $redirectURL . $this->queryStringRoute($parameters));
    }

    /**
     * Creates a route based on the given controller and action
     *
     * @param string             $controller the name of the controller without the trailing word Controller, e.g. Index as opposed to IndexController
     * @param string             $action an optional name of the action without the trailing word Action, e.g. index as opposed to indexAction
     * @param array              $parameters an optional associative array of parameters to build a query string
     * @return string
     */
    public function route($controller, $action = NULL, $parameters = NULL)
    {
        $http = "http";
        $port = "";

        if (!empty($action))
            $action .= "/";

        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on")
            $http = "https";

        if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != "80" && $_SERVER['SERVER_PORT'] != "8080")
            $port = ":" . $_SERVER['SERVER_PORT'];

        return $http . "://" . $_SERVER['HTTP_HOST']  . $port . substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "/")) . "/" . $controller . "/" . $action . $this->queryString($parameters);
    }

    /**
     * Creates a secured route based on the given controller, action, and port
     *
     * @param string             $controller the name of the controller without the trailing word Controller, e.g. Index as opposed to IndexController
     * @param string             $action an optional name of the action without the trailing word Action, e.g. index as opposed to indexAction
     * @param integer            $port an optional port number, defaults to 443
     * @param array              $parameters an optional associative array of parameters to build a query string
     * @return string
     */
    public function routeSecure($controller, $action = NULL, $port = 443, $parameters = NULL)
    {
        $_SERVER['HTTPS'] = "on";
        $_SERVER['SERVER_PORT'] = $port;

        return $this->route($controller, $action, $parameters);
    }

    /**
     * Creates a query string based on the given parameters
     *
     * @param array              $parameters an associative array of parameters to build a query string
     * @return string
     */
    protected function queryString($parameters)
    {
        $queryString = "";

        if (!empty($parameters) && is_array($parameters)) {
            foreach ($parameters as $key => $value)
                $queryString .= $key . "=" . urlencode($value) . "&";

            if (!empty($queryString))
                $queryString = "?" . substr($queryString, 0, -1);
        }

        return $queryString;
    }

    /**
     * Creates a query string, for a route, based on the given parameters
     *
     * @param array              $parameters an associative array of parameters to build a query string
     * @return string
     */
    protected function queryStringRoute($parameters)
    {
        $queryString = "";

        if (!empty($parameters) && is_array($parameters)) {
            foreach ($parameters as $key => $value)
                $queryString .= urlencode($value) . "/";

            if (!empty($queryString))
                $queryString = substr($queryString, 0, -1);
        }

        return $queryString;
    }
} /*end of class Base*/