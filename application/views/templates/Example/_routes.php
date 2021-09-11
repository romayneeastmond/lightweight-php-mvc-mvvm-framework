<p>
    Routing is a mapping mechanism that allows controller actions to be bound to the structure of the url. Since controller actions are by definition urls, the default
    structure is
    <a href="<?php echo $this->route("Example", "articles", array("name" => "Framework Example", "month" => "November", "year" => "2015"));?>">Example/articles/?name=Framework Example&month=November&year=2015</a>.
</p>
<p>
    If a route is defined for the above example, we would simply have a url in the following format:
    <a href="<?php echo $this->route("Example", "articles") ."Framework Example/November/2015";?>">Example/articles/Framework Example/November/2015</a>
</p>

<p>
    Below the ExampleController has been shortened for the purposes of this example.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Documentation/sampleExampleControllerRouting.php"));?>
</div>

<p>
    The convention is to define a route inside the initialize function of the Controller. Simply call the <strong>$this->addRoute("");</strong> method which accepts the name of an
    action. The other convention to add a route can be seen inside the <a href="<?php echo $this->route("automatic-routing-example");?>">automatic routing controller</a> example.
</p>

<h4>Additional Use Case</h4>
<p>
    Routing can be used to help make urls more human readable (and SEO friendly). When controller actions have been defined as routes the mapping to the parameters is more dynamic, instead of
    being as rigid as "normal" controller actions. What happens in cases where routes have no parameters, or has more, or has less values provided than is needed? Here is a list of urls:
</p>
<ol>
    <li><a href="<?php echo $this->route("Example", "blog");?>">Example/blog/</a></li>
    <li><a href="<?php echo $this->route("Example", "blog") ."November/2015/how-routing-can-be-dynamic/1432454";?>">Example/blog/November/2015/how-routing-can-be-dynamic/1432454</a></li>
    <li><a href="<?php echo $this->route("Example", "blog") ."another-dynamic-url/no-parameters/still-valid/";?>">Example/blog/another-dynamic-url/no-parameters/still-valid/</a></li>
</ol>
<p>
    Naturally this use case would need to have logic built around it to manually parse the individual parts of the url.
</p>

<p>
    Below the ExampleController has been shortened for the purposes of this example.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Documentation/sampleExampleControllerRoutingDynamic.php"));?>
</div>

<p>
    Below is the content of the <strong>application/views/templates/Example/blog.php</strong> view template.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Example/blog.php"));?>
</div>

<h4>One More Thing</h4>
<p>
    Did you know that that aliases also respect any routing and automatic parameter binding attached to a controller?
    <br/>
    The <a href="<?php echo $this->route("my-articles") ."Framework Example/November/2015";?>">my-articles/Framework Example/November/2015</a> alias points to the same
    controller action from the first example shown above.
</p>