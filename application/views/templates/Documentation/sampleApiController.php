<?php
    class ApiController extends FrontController
    {
        /**
         * Initialization
         *
         */
        public function initialize()
        {
            if ($this->method != "POST")
                $this->raiseError("Method Not Supported.");

            $this->view->outputType = "json";

            $this->addRoute($this->action);
        }

        /**
         * URL: Api/
         *
         * @return View
         */
        public function indexAction()
        {
            $this->redirect("Index", "index");
        }

        /**
         * URL: Api/contacts/?action=&context=
         * Route: Api/contacts/action/context
         *
         * @annotation DependenciesLocations(Contacts)
         * @annotation DependencyInjection(ContactsMapperValidator, ContactsModel, ContactsService)
         *
         * @param string             $action the given action to perform
         * @param object             $context an object of different types (id, list, void)
         * @return View
         */
        public function contactsAction($action = "", $context = NULL)
        {
            try
            {
                $action = strtolower($this->retrieveParameter("action", "POST", $action));
                $context = $this->retrieveParameter("context", "POST", $context);

                $contact = new ContactsModel(json_decode($context, true));

                $contactsService = new ContactsService(new ContactsMapperValidator());

                if ($action == "add")
                    $this->view->content = json_encode($contactsService->add($contact));
                else if ($action == "delete")
                    $this->view->content = json_encode($contactsService->delete((int)base64_decode($context)));
                else if ($action == "list")
                    $this->view->content = json_encode($contactsService->get());
                else if ($action == "get")
                    $this->view->content = json_encode($contactsService->retrieve((int)base64_decode($context)));
                else if ($action == "update")
                    $this->view->content = json_encode($contactsService->update($contact));
                else
                    throw new Exception("Action Not Implemented.");
            }
            catch (Exception $e)
            {
                $this->actionError($e->getMessage());
            }

            return $this->view();
        }

        /**
         * Sets the action content with an exception message
         *
         * @param string             $message to display with the exception
         * $return void
         */
        private function actionError($message)
        {
            http_response_code(500);

            $this->view->content = json_encode(array("error" => $message));
        }

        /**
         * Raises an error
         *
         * @param string             $message to display with the exception
         * @throws Exception
         */
        private function raiseError($message)
        {
            http_response_code(500);

            throw new Exception($message);
        }
    } /*end of class ApiController*/