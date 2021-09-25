<nav class="side-menu">
    <h5>Controllers</h5>
    <ul>
        <li><a class="<?php echo $this->model->isMenuActive($this->menuIndex, 1);?>" href="<?php echo $this->route("simple-controller-example");?>">Simple Controller</a></li>
        <li><a class="<?php echo $this->model->isMenuActive($this->menuIndex, 2);?>" href="<?php echo $this->route("automatic-routing-example");?>">Automatic Routing Controller</a></li>
        <li><a class="<?php echo $this->model->isMenuActive($this->menuIndex, 3);?>" href="<?php echo $this->route("api-type-example");?>">Api Type Controller</a></li>
    </ul>

    <h5>Models</h5>
    <ul>
        <li><a class="<?php echo $this->model->isMenuActive($this->menuIndex, 4);?>" href="<?php echo $this->route("default-model-binding-example");?>">Default Model Binding</a></li>
    </ul>

    <h5>Views</h5>
    <ul>
        <li><a class="<?php echo $this->model->isMenuActive($this->menuIndex, 5);?>" href="<?php echo $this->route("action-view-example");?>">Action Views</a></li>
        <li><a class="<?php echo $this->model->isMenuActive($this->menuIndex, 6);?>" href="<?php echo $this->route("partial-view-example");?>">Partial Views</a></li>
    </ul>

    <h5>ViewModels</h5>
    <ul>
        <li><a class="<?php echo $this->model->isMenuActive($this->menuIndex, 7);?>" href="<?php echo $this->route("view-model-binding-example");?>">ViewModel Binding</a></li>
        <li><a class="<?php echo $this->model->isMenuActive($this->menuIndex, 8);?>" href="<?php echo $this->route("view-model-annotated-binding-example");?>">Annotated ViewModel Binding</a></li>
    </ul>

    <h5>Annotations</h5>
    <ul>
        <li><a class="<?php echo $this->model->isMenuActive($this->menuIndex, 9);?>" href="<?php echo $this->route("defining-annotations-example");?>">Defining Annotations</a></li>
        <li><a href="<?php echo $this->route("api-type-example");?>">Controller Annotations</a></li>
        <li><a href="<?php echo $this->route("view-model-annotated-binding-example");?>">Annotated ViewModel Binding</a></li>
    </ul>

    <h5>Bundles</h5>
    <ul>
        <li><a class="<?php echo $this->model->isMenuActive($this->menuIndex, 10);?>" href="<?php echo $this->route("defining-bundles-example");?>">Defining Bundles</a></li>
    </ul>

    <h5>Aliases</h5>
    <ul>
        <li><a class="<?php echo $this->model->isMenuActive($this->menuIndex, 11);?>" href="<?php echo $this->route("defining-aliases-example");?>">Defining Aliases</a></li>
    </ul>

    <h5>Routing</h5>
    <ul>
        <li><a class="<?php echo $this->model->isMenuActive($this->menuIndex, 12);?>" href="<?php echo $this->route("defining-routes-example");?>">Defining Routes</a></li>
        <li><a href="<?php echo $this->route("automatic-routing-example");?>">Automatic Routing Controller</a></li>
    </ul>
</nav>
