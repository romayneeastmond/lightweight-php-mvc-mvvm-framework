<p>
    <a href="<?php echo $this->route("action-view-example");?>">Action views</a> can be made up of partial views which can make up the template used by a particular action. The syntax for rendering
    a partial view, within an action view, specifies the location of the file and the associated php file.
</p>
<p>
    Below is the <strong>application/views/templates/Example/example.php</strong> file which coincidentally is the view used for this page.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Example/example.php"));?>
</div>

<p>
    There is a small bit of magic within the controller action, to load the name of another partial view, which is held in the
    <strong>$this->partial</strong> variable.
</p>
<p>
    Below the ExampleController has been shortened for the purposes of this example.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Documentation/sampleExampleControllerPartial.php"));?>
</div>

<h4>One More Thing</h4>
<p>
    Did you know that the menu over to the right of this page is also a partial view?
</p>