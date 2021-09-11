<?php
    class ExampleController extends FrontController
    {
        /**
         * URL: Example/viewModelBindingAction/
         * Alias: view-model-binding-example/
         *
         * @annotation DependenciesLocations(People)
         * @annotation DependencyInjection(PersonService, PersonViewModel)
         *
         * @return View
         */
        public function viewModelBindingAction()
        {
            $this->createExampleDisplayTemplate("ViewModel Binding Example", "_viewModelBinding");

            $this->view->content = "Hello World from the <b>ExampleController viewModelBindingAction</b> action";

            return $this->viewModel(PeopleService::get());
        }
    } /*end of class ExampleController*/