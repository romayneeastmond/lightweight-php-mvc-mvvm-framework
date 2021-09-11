<p>
    Controllers are defined inside the <strong>application/controllers</strong> directory and extend the FrontController class. The ErrorController, found below, contains one action called the <strong>indexAction()</strong>.
    This results in a valid url that is a combination of the controller name and action name, therefore /Error/index/ or simply <a href="<?php echo $this->route("Error");?>">Error/</a> is valid, since
    index is the default starting point of any controller.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/controllers/ErrorController.class.php"));?>
</div>

<h4>One Thing To Remember</h4>
<p>
    Any phpdoc definitions are completely optional and are only used to help describe what the controller is doing. Annotations in controllers
    are only important for more complex use cases, such as the <a href="<?php echo $this->route("api-type-example");?>">annotated controller example</a>.
</p>