<p>
    The framework uses an opinionated directory structure that is very similar to other MVC or MVVM applications. For the ExampleController found inside the
    <strong>application/controllers</strong> directory, there is a model inside the <strong>application/models/Example/</strong> directory
    called <strong>ExampleModel.class.php</strong>, which is automatically bound to any action within the controller.
</p>

<p>
    Below the ExampleController has been shortened for the purposes of this example.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Documentation/sampleExampleController.php"));?>
</div>

<p>
    Below is the <strong>application/models/Example/ExampleModel.class.php</strong> which is automatically bound to the <strong>$this->model</strong> variable
    which can be used by any action inside the ExampleController; which in this example happens to be the <a href="<?php echo $this->route("Example", "helloWorld");?>">helloWorldAction()</a>.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/models/Example/ExampleModel.class.php"));?>
</div>

<h4>One Thing To Remember</h4>
<p>
    Default model binding is completely optional. But when a model is used, the convention is to save it in the application/models/ControllerName directory with a file
    matching ControllerNameModel.class.php, and in this example ControllerName is Example.
</p>