<p>
    Define aliases inside the <strong>application/configs/aliases.php</strong> file to turn any valid controller action into a human readable (or SEO friendly) url.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/configs/aliases.php"));?>
</div>

<h4>Two More Things</h4>
<p>
    Did you know that multiple aliases can be defined for a single controller action and that aliases also respect any routing and automatic parameter binding attached to a controller?
</p>

<h4>Examples</h4>
<p>
    The <a href="<?php echo $this->route("error");?>">error</a> and <a href="<?php echo $this->route("error-screen", "Just An Example");?>">error-screen</a> aliases
    point to the same action and respect the route defined inside the <a href="<?php echo $this->route("simple-controller-example");?>">ErrorController</a>.
</p>