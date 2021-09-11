<p>
    The <a href="<?php echo $this->route("default-model-binding-example");?>">default model binding example</a> shows how models are automatically bound to controller actions.
    Another part of the framework's opinionated directory structure is how view files are associated with particular actions. For any controller action, there can be a view
    file located inside the <strong>application/views/templates/</strong> directory.
</p>
<p>
    Below the ExampleController has been shortened for the purposes of this example.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Documentation/sampleExampleControllerViews.php"));?>
</div>

<p>
    Below is the content of the <strong>application/views/templates/Example/articles.php</strong> file which is associated with the
    <a href="<?php echo $this->route("Example", "articles", array("name" => "article-name", "year" => "2015", "month" => "November"));?>">ExampleController, articlesAction()</a>.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Example/articles.php"));?>
</div>

<p>
    Below is the content of the <strong>application/views/templates/Example/hello.php</strong> file which is associated with the
    <a href="<?php echo $this->route("Example", "helloWorld");?>">helloWorldAction()</a>. However from the example provided, we can see how the <strong>$this->view->renderer("Example", "hello");</strong>
    line changes the default view file of an action.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Example/hello.php"));?>
</div>

<h4>One More Thing</h4>
<p>
    Just look again at how the helloWorldAction() declares <strong>$this->view->whoAmI;</strong> and how it's displayed by the hello.php template.
</p>
<p>
    Did you know that because of dynamically created variables any variable declared with <strong>$this->view->anyVariableName;</strong> is available
    within the view template as <strong>$this->anyVariableName;</strong>?
</p>