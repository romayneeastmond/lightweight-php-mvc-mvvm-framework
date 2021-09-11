<p class="page-header">
    <?php echo $this->content;?> <span class="label label-info"><i class="fa fa-arrow-left"></i> Normal Action View Binding</span>
    <br/>
    Hello <?php echo $this->boundModel->firstName ." " .$this->boundModel->lastName ." " .$this->boundModel->emailAddress;?> <span class="label label-info"><i class="fa fa-arrow-left"></i> ViewModel Binding</span>
</p>

<p>
    At the top of this page we have an example of how <a href="<?php echo $this->route("action-view-example");?>">normal action view</a> binding happens, as well as binding data via a provided
    view model. The framework is capable of providing a MVVM approach to development. In <a href="<?php echo $this->route("default-model-binding-example");?>">previous examples</a> there is automatic
    binding to a model, in the example below, we see that using <strong>return $this->viewModel();</strong> provides view model binding to the view.
</p>
<p>
    In this example, the view accepts an instance of a Person class and binds it to a special variable called <strong>$this->view->boundModel;</strong>, which is naturally accessible within the view as
    <strong>$this->boundModel;</strong>.
</p>
<p>
    Below the ExampleController has been shortened for the purposes of this example.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Documentation/sampleExampleControllerViewModel.php"));?>
</div>

<p>
    Below the PersonService has been shortened for the purposes of this example.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Documentation/samplePersonService.php"));?>
</div>

<p>
    Below the <strong>application/views/templates/Example/_viewModelBinding.php</strong>, which is the partial view currently dislayed at the top of this page,
    has been shortened for the purposes of this example.
</p>
<div class="highlight-php">
    <?php highlight_string(file_get_contents("application/views/templates/Documentation/sampleViewModelBinding.php"));?>
</div>

<h4>One Use Case To Consider</h4>
<p>
    Since view models can be accessed from the view using the <strong>$this->boundModel;</strong> variable, they can be serialized or unserialized and used to fill javascript frameworks
    that would also benefit from a MVVM approach.
</p>