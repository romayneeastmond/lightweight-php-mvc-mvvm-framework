<p>
    Controllers respond to requests via actions, and in some cases these actions require parameters to tell the controller to perform a specific
    task that might relate to a model, view, or other action. Automatic routing controllers simply define every action within the controller as a route. For
    more information on how the routing mapping mechanism works continue on to the
    <a href="<?php echo $this->route("defining-routes-example");?>">defining routes</a> section.
</p>
<p>
    To create an automatic routing controller, simply add <strong>$this->addRoute($this->action);</strong> to the initalize function of the controller. The code
    automatically registers the current action since <strong>$this->action</strong> is a reference to the action's name.
</p>
<p>
    Below the ErrorController has been shortened for the purposes of this example.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Documentation/sampleErrorController.php"));?>
</div>

<h4>One Thing To Remember</h4>
<p>
    The <strong>initialize()</strong> method is a special function that is ran before any controller action is processed. It is the recommended convention for doing any
    special initialization that is needed by the controller. It can also be used to setup any dependencies needed by the controller's actions.
</p>