<?php
    class ExampleController extends FrontController
    {
        /**
         * Initialization
         *
         */
        public function initialize()
        {
            $this->addRoute("articles");
            $this->addRoute("blog");
        }

        /**
         * URL: Example/
         *
         * @return View
         */
        public function indexAction()
        {
            $this->redirect("welcome", "");
        }

        /**
         * URL: Example/articles/?name=&year=&month=
         * Route: Example/articles/name/year/month
         * Alias: my-articles/
         *
         * @param string             $name a dummy holder for name of fake article
         * @param string             $year a dummy holder for year of fake article
         * @param string             $month a dummy holder for month of fake article
         * @return View
         */
        public function articlesAction($name = "", $year = "", $month = "")
        {
            $this->view->title = "Articles Route Test";
            $this->view->content = "Hello World from the <b>ExampleController articlesAction</b> action<br /><br />";

            $this->view->myBoundParameters = array(
                $name, $year, $month
            );

            return $this->view();
        }

        /**
         * URL: Example/blog/
         *
         * @return View
         */
        public function blogAction()
        {
            $this->view->title = "Blog Entry";

            return $this->view();
        }

        /**
         * URL: Example/controllerApi/
         * Alias: api-type-example/
         *
         * @return View
         */
        public function controllerApiAction()
        {
            $this->createExampleDisplayTemplate("Api Type Controller Example", "_controllerApi");

            return $this->view();
        }

        /**
         * URL: Example/controllerAutomatic/
         * Alias: automatic-routing-example/
         *
         * @return View
         */
        public function controllerAutomaticAction()
        {
            $this->createExampleDisplayTemplate("Automatic Routing Controller Example", "_controllerAutomatic");

            return $this->view();
        }

        /**
         * URL: Example/controllerSimple/
         * Alias: simple-controller-example/
         *
         * @return View
         */
        public function controllerSimpleAction()
        {
            $this->createExampleDisplayTemplate("Simple Controller Example", "_controllerSimple");

            return $this->view();
        }

        /**
         * URL: Example/definingAliases/
         * Alias: defining-aliases-example/
         *
         * @return View
         */
        public function definingAliasesAction()
        {
            $this->createExampleDisplayTemplate("Defining Aliases", "_aliases");

            return $this->view();
        }

        /**
         * URL: Example/definingAnnotations/
         * Alias: defining-annotations-example/
         *
         * @return View
         */
        public function definingAnnotationsAction()
        {
            $this->createExampleDisplayTemplate("Defining Annotations", "_annotations");

            return $this->view();
        }

        /**
         * URL: Example/definingBundles/
         * Alias: defining-bundles-example/
         *
         * @return View
         */
        public function definingBundlesAction()
        {
            $this->createExampleDisplayTemplate("Defining Bundles", "_bundles");

            return $this->view();
        }

        /**
         * URL: Example/definingRoutes/
         * Alias: defining-routes-example/
         *
         * @return View
         */
        public function definingRoutesAction()
        {
            $this->createExampleDisplayTemplate("Defining Routes", "_routes");

            return $this->view();
        }

        /**
         * URL: Example/helloWorld/
         *
         * @return View
         */
        public function helloWorldAction()
        {
            $this->view->title = "Hello World";
            $this->view->whoAmI = $this->model->whatIsMyName();

            $this->view->renderer("Example", "hello");

            return $this->view();
        }

        /**
         * URL: Example/modelDefaultBinding/
         * Alias: default-model-binding-example/
         *
         * @return View
         */
        public function modelDefaultBindingAction()
        {
            $this->createExampleDisplayTemplate("Default Model Binding Example", "_modelDefaultBinding");

            return $this->view();
        }

        /**
         * URL: Example/viewSimple/
         * Alias: action-view-example/
         *
         * @return View
         */
        public function viewSimpleAction()
        {
            $this->createExampleDisplayTemplate("Action Views Example", "_viewSimple");

            return $this->view();
        }

        /**
         * URL: Example/viewPartial/
         * Alias: partial-view-example/
         *
         * @return View
         */
        public function viewPartialAction()
        {
            $this->createExampleDisplayTemplate("Partial Views Example", "_viewPartial");

            return $this->view();
        }

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

        /**
         * URL: Example/Json/
         *
         * @return View
         */
        public function JsonAction()
        {
            $this->view->outputType = "json";
            $this->view->content = json_encode(
                array(
                    array("Id" => 1000, "FirstName" => "John", "LastName" => "Public"),
                    array("Id" => 1001, "FirstName" => "Jane", "LastName" => "Helper")
                )
            );

            return $this->view();
        }

        /**
         * URL: Example/XML/
         *
         * @return View
         */
        public function XMLAction()
        {
            $this->view->outputType = "xml";
            $this->view->content = "
                                        <books>
                                            <book>
                                                <author>Jack Herrington</author>
                                                <title>PHP Hacks</title>
                                                <publisher>O'Reilly</publisher>
                                            </book>
                                            <book>
                                                <author>Jack Herrington</author>
                                                <title>Podcasting Hacks</title>
                                                <publisher>O'Reilly</publisher>
                                            </book>
                                        </books>
                                       ";

            return $this->view();
        }

        /**
         * Creates the necessary settings for an example type file
         *
         * @param string             $title title to load into template
         * @param string             $partial name of partial view to load into template
         * @return void
         */
        private function createExampleDisplayTemplate($title, $partial)
        {
            $this->view->title = $title;
            $this->view->partial = $partial;

            $this->view->renderer("Example", "example");
        }
    } /*end of class ExampleController*/