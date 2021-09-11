<?php
    class ExampleController extends FrontController
    {
        /**
         * URL: Example/viewModelFormBinding/
         * Alias: view-model-annotated-binding-example/
         *
         * @annotation DependenciesLocations(People)
         * @annotation DependencyInjection(PersonService, PersonViewModel)
         *
         * @return View
         */
        public function viewModelFormBindingAction()
        {
            $this->createExampleDisplayTemplate("Annotated ViewModel Binding Example", "_viewModelAnnotatedBinding");

            $this->view->content = "Hello World from the <b>ExampleController viewModelFormBindingAction</b> action";
            $this->view->addJavascript("public/js/example.js");

            return $this->viewModel("People/Person", PeopleService::get());
        }

        /**
         * Accepts postback from Example/viewModelFormBinding/
         * Accepts postback from /view-model-annotated-binding-example/
         *
         * @annotation DependenciesLocations(People)
         * @annotation DependencyInjection(PersonService, PersonViewModel)
         *
         * @return View
         */
        public function viewModelFormBindingPostAction()
        {
            $this->createExampleDisplayTemplate("Annotated ViewModel Binding Example", "_viewModelAnnotatedBinding");

            $this->view->content = "Hello World from the postback of <b>ExampleController viewModelFormBindingPostAction</b> action";
            $this->view->addJavascript("public/js/example.js");

            $_POST['genders'] = PeopleService::genders();
            $_POST['languages'] = PeopleService::languages();
            $_POST['province'] = PeopleService::provinces();

            return $this->viewModel("People/Person", (object)$_POST);
        }
    } /*end of class ExampleController*/