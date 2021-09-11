<p>
    Annotations extends the phpdoc syntax to provide metadata information to Controllers or ViewModels. In both the
    <a href="<?php echo $this->route("view-model-binding-example");?>">ViewModel Binding</a> example and the
    <a href="<?php echo $this->route("view-model-annotated-binding-example");?>">Annotated ViewModel Binding</a> example we see
    how annotations are used to extend the functionality of the individual use cases.
</p>

<p>
    Below the ExampleController has been shortened for the purposes of this example.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Documentation/sampleExampleControllerViewModel.php"));?>
</div>

<p>
    From the snippet above the <strong>* @annotation DependenciesLocations(People)</strong> and <strong>* @annotation DependencyInjection(PersonService, PersonViewModel)</strong>
    lines tells a mechanism in the background that within the <strong>application/Models/People</strong> and <strong>application/ViewModels/People</strong> folders to make
    available the PersonService.class.php and PersonViewModel.class.php files to the current controller action.
</p>
<p>
    It is possible to create custom annotations, for controller actions, that will respond to custom built functionality but for purposes of this framework's demonstrations, those
    will be discussed at a later date.
</p>

<p>
    The framework supports the MVVM approach to organizing a project. The default location for view models files is <strong>application/ViewModels/</strong> which is similar to "normal"
    models but offer the flexiblity of not having to be organized into a folder structure that resembles the names of controllers.
</p>
<p>
    Below the PersonViewModel has been shortened for the purposes of this example.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Documentation/samplePersonViewModel.php"));?>
</div>

<p>
    The above extract is used to do view model binding in the <a href="<?php echo $this->route("view-model-annotated-binding-example");?>">Annotated ViewModel Binding</a> example. The phpdoc
    contain <strong>@ annotation</strong> definitions that are then interpreted by a view template by binding to custom tag helpers or simple php output.
</p>

<h4>Two Things To Remember</h4>
<p>
    The <strong>return $this->viewModel()</strong> method creates two special variables, one called <strong>$this->view->viewModel;</strong> which contain annotation information (if any), and another
    called <strong>$this->view->boundModel;</strong> which contains the actual data stored by the view model.
</p>