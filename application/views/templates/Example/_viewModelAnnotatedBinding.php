<p class="page-header">
    <?php echo $this->content;?> <span class="label label-info"><i class="fa fa-arrow-left"></i> Normal Action View Binding</span>
</p>

<ul id="ExampleViewModelAnnotatedOptions" class="nav nav-tabs visible-lg visible-md visible-sm">
    <li role="presentation" class="active"><a href="#" class="tab1" data-target="ExampleViewModelAnnotatedOutput">Output</a></li>
    <li role="presentation"><a href="#" class="tab2" data-target="ExampleViewModelAnnotatedController">Controller</a></li>
    <li role="presentation"><a href="#" class="tab3" data-target="ExampleViewModelAnnotatedViewModel">ViewModel</a></li>
    <li role="presentation"><a href="#" class="tab4" data-target="ExampleViewModelAnnotatedPersonService">Bound Model</a></li>
    <li role="presentation"><a href="#" class="tab5" data-target="ExampleViewModelAnnotatedTags">Tag Helpers</a></li>
    <li role="presentation"><a href="#" class="tab6" data-target="ExampleViewModelAnnotatedPost">Post</a></li>
</ul>
<ul id="ExampleViewModelAnnotatedOptionsSmall" class="nav nav-tabs visible-xs small">
    <li role="presentation" class="active"><a href="#" class="tab1" data-target="ExampleViewModelAnnotatedOutput">Output</a></li>
    <li role="presentation"><a href="#" class="tab2" data-target="ExampleViewModelAnnotatedController">Controller</a></li>
    <li role="presentation"><a href="#" class="tab3" data-target="ExampleViewModelAnnotatedViewModel">ViewModel</a></li>
    <li role="presentation"><a href="#" class="tab4" data-target="ExampleViewModelAnnotatedPersonService">Bound Model</a></li>
    <li role="presentation"><a href="#" class="tab5" data-target="ExampleViewModelAnnotatedTags">Tag Helpers</a></li>
    <li role="presentation"><a href="#" class="tab6" data-target="ExampleViewModelAnnotatedPost">Post</a></li>
</ul>
<div class="panel panel-default panel-tab">
    <div class="panel-body example-view-model">
        <div class="row">
            <div id="ExampleViewModelAnnotatedOutput" class="col-md-6 example-panel">
                <p>
                <span class="label label-info"><i class="fa fa-arrow-down"></i> ViewModel Binding with tag helpers</span>
                </p>

                <?php $this->bindStart();?>
                    <?php $this->renderFormView("Person", "person");?>
                <?php $this->bindEnd();?>
            </div>
            <div id="ExampleViewModelAnnotatedController" class="col-md-12 example-panel hidden">
                <p>
                    The controller is responsible for tying the view model and its data to the view. In the <a href="<?php echo $this->route("view-model-binding-example");?>">ViewModel Binding</a>
                    example, using the <strong>return $this->viewModel();</strong> provided view model binding behaviour. With annotated view models, the controller needs to be provided
                    with the location of the actual view model and a reference to the data used to populate the view model.
                </p>
                <p>
                    The <strong>return $this->viewModel("People/Person", PeopleService::get());</strong> tells the controller that there is an
                    <a href="<?php echo $this->route("defining-annotations-example");?>">annotated view model</a> inside the
                    <strong>application/viewModels/People/PersonViewModel.class.php</strong> file, and that the <strong>PeopleService::get()</strong> method returns the needed data.
                </p>
                <p>
                    The second parameter, of <strong>return $this->viewModel();</strong> accepts an object with data. The action that accepts the postback is able to using
                    the <strong>(object)$_POST</strong> to repopulate the view model. Therefore the <strong>viewModelFormBindingPostAction()</strong> needed a little, extra help
                    in filling in the blanks of the $_POST values to complete the annotations listed in the view model.
                </p>
                <p>
                    Below the ExampleController has been shortened for the purposes of this example.
                </p>
                <div class="highlight-php">
                    <?php highlight_string(file_get_contents("application/views/templates/Documentation/sampleExampleControllerViewModelBinding.php"));?>
                </div>
            </div>
            <div id="ExampleViewModelAnnotatedViewModel" class="col-md-12 example-panel hidden">
                <p>
                    Below the <strong>application/viewModels/People/PersonViewModel.class.php</strong> has its properties using the <strong>@ annotation</strong> declarations
                    within the phpdoc.
                </p>
                <div class="highlight-php">
                    <?php highlight_string(file_get_contents("application/viewModels/People/PersonViewModel.class.php"));?>
                </div>
            </div>
            <div id="ExampleViewModelAnnotatedPersonService" class="col-md-12 example-panel hidden">
                <p>
                    Below the <strong>application/models/People/PersonService.class.php</strong> provides the view model with default values.
                </p>
                <div class="highlight-php">
                    <?php highlight_string(file_get_contents("application/models/People/PersonService.class.php"));?>
                </div>
            </div>
            <div id="ExampleViewModelAnnotatedTags" class="col-md-12 example-panel hidden">
                <p>
                    Below the <strong>application/views/forms/Person/person.php</strong>, is an include file that contains the person form. Take note of the tag
                    helper syntax which is inspired by ASP.NET MVC 6 approach to view model binding.
                </p>
                <p>
                    The <strong>php-label-for</strong>, <strong>php-input-for</strong>, and <strong>php-value-for</strong> rewrite the annotations provided by
                    the view model and changes them into valid HTML elements. Each tag helper accepts a value corresponding to the name of a property of the
                    view model.
                </p>
                <div class="highlight-php">
                    <?php highlight_string(file_get_contents("application/views/forms/Person/person.php"));?>
                </div>
            </div>
            <div id="ExampleViewModelAnnotatedPost" class="col-md-12 example-panel hidden">
                <?php
                if (!empty($_POST))
                    Functions::dump(Base::capture($_POST));

                if (empty($_POST)):?>
                    <p>
                        Raw Post output only available after form has been submitted.
                    </p>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>

Generated on <?php echo gmdate("d-m-Y H:i A", time());?>.
