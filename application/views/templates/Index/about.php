<div class="row">
    <div class="col-md-6">
        <h4>About</h4>
        <p>
            This lightweight framework is highly inspired by the ASP.NET MVC 5/6 approach to development. It therefore has a differentiation
            with other PHP frameworks, on how model-view-controller or model-view-view-model is done.
        </p>
        <p>
            The framework uses annotations, which are similar to decorators, to extend the meta information provided by phpdoc. When used
            with view model bindings; it is possible to have tag-helper like syntax to provide dynamic binding.
        </p>
        <p>
            Another difference is how bundles are used. Much like the BundleConfig, bundles combine css and javascript definitions that can
            be reused as many times as needed from within view files.
        </p>
        <p>
            Finally routing and aliases help, further, improve on controller action's urls. Imitating how the RouteConfig definitions work in
            ASP.NET MVC, action parameters are mapped and automatically bound to the get or post arrays.
        </p>

        <h4>One More Thing</h4>
        <p>
            Did you know that this page is actually an alias for the <a href="<?php echo $this->route("Index", "about");?>">aboutAction found in the IndexController</a>?
        </p>
    </div>
</div>