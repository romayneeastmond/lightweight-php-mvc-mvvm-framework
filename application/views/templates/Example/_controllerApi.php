<p>
    Controllers can be given specific roles by specifying the output type, the anticipated method of accessing controller actions, and combing that with the
    <a href="<?php echo $this->route("defining-routes-example");?>">routing</a> mechanisms.
</p>

<p>
    Below is an example of the ApiController which shows that the controller only outputs json, will only work with post data, and creates
    <a href="<?php echo $this->route("automatic-routing-example");?>">automatic routing</a> on all actions defined within it. Note that this controller is not actually part of
    this project and is used only for demonstration purposes.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Documentation/sampleApiController.php"));?>
</div>

<h4>One More Thing</h4>
<p>
    Did you know that you can redirect from actions to other controller actions by using the <strong>$this->redirect("Controller", "action");</strong> method?
</p>