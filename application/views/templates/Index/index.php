<div class="jumbotron text-center">
    <h1 class="h2"><?php echo $this->subTitle;?></h1>

    <p>
        This example page shows features associated with the lightweight framework that is capable of organizing applications
        using either the MVC or MVVM development approach.
    </p>

    <p>
        <a class="btn btn-lg btn-outline-info" href="<?php echo $this->route("examples");?>" role="button">Click to View Examples <i class="fa fa-arrow-right"></i></a>
    </p>
</div>
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <h3><i class="fa fa-cogs"></i> Controllers</h3>
        <p>
            Responds to requests via actions that are responsible for tying specific models, view models, and views together.
        </p>
        <p>
            <a class="btn btn-info btn-xs" href="<?php echo $this->route("simple-controller-example");?>">
                Simple Controller Example <i class="fa fa-arrow-right"></i>
            </a>
        </p>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <h3><i class="fa fa-object-ungroup"></i> Models</h3>
        <p>
            Captures functionality that is typically a set of methods that interact closely with actions, repositories, or services.
        </p>
        <p>
            <a class="btn btn-info btn-xs" href="<?php echo $this->route("default-model-binding-example");?>">
                Default Model Binding Example <i class="fa fa-arrow-right"></i>
            </a>
        </p>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <h3><i class="fa fa-picture-o"></i> Views</h3>
        <p>
            Houses a collection of presentation focused templates that provide the controller with a way of expressing output.
        </p>
        <p>
            <a class="btn btn-info btn-xs" href="<?php echo $this->route("action-view-example");?>">
                Action Views Example <i class="fa fa-arrow-right"></i>
            </a>
        </p>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <h3><i class="fa fa-rocket"></i> ViewModels</h3>
        <p>
            Ties data closely to the view by binding view model data into special placeholders that make displaying data easier.
        </p>
        <p>
            <a class="btn btn-info btn-xs" href="<?php echo $this->route("view-model-annotated-binding-example");?>">
                ViewModel Binding Example <i class="fa fa-arrow-right"></i>
            </a>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <h3><i class="fa fa-commenting-o"></i> Annotations</h3>
        <p>
            Extends phpdoc metadata to do behind the scenes work such as automatic class inclusion or decorating data bound properties.
        </p>
        <p>
            <a class="btn btn-success btn-xs" href="<?php echo $this->route("defining-annotations-example");?>">
                Defining Annotations <i class="fa fa-arrow-right"></i>
            </a>
        </p>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <h3><i class="fa fa-puzzle-piece"></i> Bundles</h3>
        <p>
            Defines css and javascript definitions that can be reused within views to add additional styles or functions not defined in layouts.
        </p>
        <p>
            <a class="btn btn-success btn-xs" href="<?php echo $this->route("defining-bundles-example");?>">
                Defining Bundles <i class="fa fa-arrow-right"></i>
            </a>
        </p>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <h3><i class="fa fa-bookmark-o"></i> Aliases</h3>
        <p>
            Creates a way to "fancify" urls by allowing controller action endpoints to be rewritten in a more human readable (and SEO friendly) way.
        </p>
        <p>
            <a class="btn btn-success btn-xs" href="<?php echo $this->route("defining-aliases-example");?>">
                Defining Aliases <i class="fa fa-arrow-right"></i>
            </a>
        </p>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <h3><i class="fa fa-map-signs"></i> Routing</h3>
        <p>
            Works in conjunction with controller actions to seamlessly bind action parameters to the logical hierarchy of urls.
        </p>
        <p>
            <a class="btn btn-success btn-xs" href="<?php echo $this->route("defining-routes-example");?>">
                Defining Routes <i class="fa fa-arrow-right"></i>
            </a>
        </p>
    </div>
</div>