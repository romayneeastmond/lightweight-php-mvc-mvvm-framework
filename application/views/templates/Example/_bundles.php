<p>
    Define bundles inside the <strong>application/configs/bundles.php</strong> file to make them accessible by any controller action.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Documentation/sampleBundles.php"));?>
</div>

<p>
    Below is an example of a FakeController with an action that uses some bundles defined in the above sample file. Note that this
    controller is not actually part of this project and is used only for demonstration purposes.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Documentation/sampleFakeController.php"));?>
</div>

<h4>One More Thing</h4>
<p>
    Did you know that you can also add individual javascript or CSS files without using bundles?
    <br/>Just use the <strong>$this->view->addJavascript("");</strong> or <strong>$this->view->addCSS("");</strong> methods instead.
</p>