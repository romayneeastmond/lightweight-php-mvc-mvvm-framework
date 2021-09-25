# MVC/MVVM Annotations Framework

This projects features a lightweight framework that is capable of organizing applications using either the MVC or MVVM. It is highly inspired by the ASP.NET MVC 5/6 approach to development. It therefore has a differentiation with other PHP frameworks, on how model-view-controller or model-view-view-model is done. 

The framework uses annotations, which are similar to decorators, to extend the meta information provided by phpdoc. When used with view model bindings; it is possible to have tag-helper like syntax to provide dynamic binding. Currently the project supports **php-label-for**, **php-input-for**, and **php-label-for** tag helpers.

Another difference is how bundles are used. Much like the BundleConfig, bundles combine css and javascript definitions that can be reused as many times as needed from within view files. Finally routing and aliases help, further, improve on controller action's urls. Imitating how the RouteConfig definitions work in ASP.NET MVC, action parameters are mapped and automatically bound to the get or post arrays.

## How To Use

The project is a fully functional example of how the framework works. Therefore it is already a standalone application that *should* work on most Apache instances.

## Known Issues

This project was started before PHP had support for namespaces, therefore it currently lacks any namespace definitions. Since it was inspired by the ASP.NET MVC 5/6 framework, development was done on a Windows machine using Apache as the web server. It should work within a linux environment. Naturally the naming convention on controller actions, on a linux will respect case sensitivity, so keep that in mind when forming urls from controller actions.

Within phpdoc it is important to use **@ annotation** as all lower case with a space following the @ symbol. Controllers or view models that use annotations should contain a single class definition.

Unfortunately there currently are no tests associated with the framework but will be added sometime in the future.
 
Beyond that since the project uses .htaccess to use a rewrite rule to pass all requests through the index.php; there would need to be some configuration done to get an IIS installation to do the same.  

## Copyright and Ownership

The ASP.NET MVC, IIS, Apache, phpdoc name, and any other terms used are copyright to their original authors.

## Live Demo

Live demo hosted in Microsoft Azure, PHP 7.4 App Service [MVC/MVVM Annotations Framework](https://dev-php-lightweight-mvc-mvvm-framework.azurewebsites.net/).