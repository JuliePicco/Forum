<?php

    namespace Controller;

    // on appelle les classes 
    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class HomeController extends AbstractController implements ControllerInterface{

        public function index(){
                return [
                    "view" => VIEW_DIR."home.php"
                ];
            }
            
        
        public function users(){
            $this->restrictTo("ROLE_ADMIN");

            $manager = new UserManager();
            $users = $manager->findAll(['registerDate', 'DESC']);

            return [
                "view" => VIEW_DIR."security/users.php",
                "data" => [
                    "users" => $users
                ]
            ];
        }

        public function forumRules(){
            return [
                "view" => VIEW_DIR."rules.php"
            ];
        }


        /*public function ajax(){
            $nb = $_GET['nb'];
            $nb++;
            include(VIEW_DIR."ajax.php");
        }*/
    }
