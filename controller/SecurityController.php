<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    
    class SecurityController extends AbstractController implements ControllerInterface{


// todo FONCTION 
    public function index(){

        }

// todo FONCTION nous renvoyant à la page php de register
    public function registerForm(){

        return [
            "view" =>VIEW_DIR."security/register.php",
            "data" => null,
        ];

    }

// todo FONCTION permettant de s'enregistrer
    public function register(){

        if(!empty($_POST)){

            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_REGEXP,
            //     array("options" => array("regexp" =>'/[A-Za-z0-9]{7,32}/')
            //     )
            // );
            // $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_REGEXP,
            // array("options" => array("regexp" =>'/[A-Za-z0-9]{7,32}/')
            // ));
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);

            
            if($pseudo && $password && $email){
                
                if(($password == $confirmPassword) and strlen($password) >=8){
                    
                    $manager = new UserManager();
                    $user = $manager->findOneByPseudo($pseudo);
                    
                    if(!$user){

                        $hash = password_hash($password, PASSWORD_DEFAULT);
                        
                        if($manager->add([
                            "pseudo" => $pseudo,
                            "email" => $email,
                            "password" => $hash,
                            "roles"=>json_encode(["ROLE_USER"]),
                        ])){

                            
                            // ! je ne suis pas redirect sur le login
                            return $this->redirectTo("security", "loginForm");
                            Session::addFlash("success", "Vous avez bien été enregistré.");
                         
                        }

                    }
                       
                } else {
                    Session::addFlash("error", "Votre mot de passe est incorrecte. Veuillez saisir des mots de passe correspondant et comportant un minimum de 8 caractères.");
                };

            }
            
        }
        return [
            "view" => VIEW_DIR."security/register.php",
        ];
    }


// todo FONCTION nous renvoyant à la page php de login
    public function loginForm(){

        return [
            "view" =>VIEW_DIR."security/login.php",
            "data" => null,
        ];
    }

// todo FONCTION Permettant de ce connecter
    public function login(){

        // password_verify() est un fonction native de PHP
        // mettre user en session
        
        if(!empty($_POST)){

            $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
            if($pseudo && $password){
                
                $userManager = new UserManager();
                $user = $userManager->findOneByPseudo($pseudo);

                // recupération de l'user en base de données
            
                if($user){

                    // recupération du MDP dans la base de données
                    $hash = $userManager->findPasswordByPseudo($pseudo);
                    $password_hashed = $hash->getPassword();
                    
                    
                    // vérification que le MDP recupéré correspond bien à celui de la base de donnée
                    if(password_verify($password, $password_hashed)){
                        
                        session::setUser($user);
      
                        $this->redirectTo("home", "index");
                    }

                }

            }

        } 
        return [
            "view" =>VIEW_DIR."home.php",
            "data" => null,
        ];

    }


// todo FONCTION permettant de ce déconnecter
    public function logout(){

        if ($_SESSION ['user']){

            unset($_SESSION ['user']);

            $this->redirectTo('DEFAULT_CTRL');
        }  

    }

    

// todo Permet d'avoir tous les détails d'un User 
    public function profile(){

        $postManager = new PostManager();
        $topicManager = new TopicManager();
        $user = SESSION::getUser();

        return [
            "view" => VIEW_DIR."security/profile.php",
            "data" => [
                "user" => $user,
                "topics" => $topicManager->findTopicsByUser($user->getId()),
                "posts" => $postManager->findPostsByUser($user->getId()),
                
            ]
        ];

        
    }



// todo FONCTION permettant à l'user de modifier son mdp

    public function modifyPassword(){

        if(isset($_POST["submit"])){
         
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


            if(($password && $confirmPassword) && ($password == $confirmPassword) and strlen($password) >=8){

                $userManager = new UserManager;

                if(isset($_SESSION["user"])){

                    $user = $_SESSION["user"];
                    $pseudo = $user->getPseudo();

                    $infoUser = $userManager -> findOneByPseudo($pseudo);

                    $id = $infoUser -> getId();

                    $hash = password_hash($password, PASSWORD_DEFAULT);

                    $hash = $userManager -> editPassword($id, $hash);

                    unset($_SESSION ['user']);

                    return $this->redirectTo("security", "loginForm");
                    // Session::addFlash("success", "Votre mot de passe a bien été changé.");

                }
            }
        }

        return [
            "view" => VIEW_DIR."security/editPassword.php",
            "data" => []
        ];

    }



    // todo FONCTION permettant à l'user de modifier ses info (mail et pseudo)

    public function modifyInfo(){


        if(isset($_SESSION["user"])){


            if(isset($_POST["submit"])){

                $userManager = new UserManager;

                $user = $_SESSION["user"];
                $pseudo = $user->getPseudo();
                $email = $user->getEmail();
    
                $infoUser = $userManager -> findOneByPseudo($pseudo, $email);
    
                $id = $infoUser -> getId();
         
                $NewPseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $NewEmail = filter_input(INPUT_POST, "email", FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);


                $userManager -> editInfo($id, $NewPseudo, $NewEmail);

                $user -> setPseudo($NewPseudo);
                $user -> setEmail($NewEmail);

                return $this->redirectTo("security", "profile");
                Session::addFlash("success", "Vos modifications ont bien été effectué.");

            }
        }

        return [
            "view" => VIEW_DIR."security/editInfo.php",
            "data" => [
                "user" => SESSION::getUser(),
            ]
        ];
    }

    


    // todo FONCTION permerttant de changer d'avatar

    // il est egalement possible d'ajouter les images en base de données si l'on veut par plus tard utiliser les images (galerie d'image ou ancienne image de profile utiliser)
    // pour cela, il faut un acces à la BDD (plus de détails ici : https://espritweb.fr/comment-uploader-une-image-en-php/)

    public function modifyAvatar(){

        if(isset($_SESSION["user"])){

            $userManager = new UserManager;

            $user = $_SESSION["user"];
            $id = $user -> getId();


            if(isset($_POST["submit"])){


                if(!empty($_FILES['avatar'])){

            
                    $tmpName = $_FILES['avatar']['tmp_name'];
                    $name = $_FILES['avatar']['name'];
                    $size = $_FILES['avatar']['size'];
                    $error = $_FILES['avatar']['error'];

                    $tabExtension = explode('.', $name);
                    // La fonction explode permets de découper une chaîne de caractère en plusieurs morceaux à partir d’un délimiteur.
                    
                    $extension = strtolower(end($tabExtension));
                    // Le fonction strtolower permets de mettre en minuscule tout une chaîne de caractère.

                    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
                    // Tableau des extensions que l'on accepte

                    $maxSize = 400000;
                    // Taille max des fichier que l'on accepte

                    if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){


                        $uniqueName = uniqid('', true);
                        //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
                        $file = $uniqueName.".".$extension;
                        //$file = 5f586bf96dcd38.73540086.jpg
            
                        move_uploaded_file($tmpName, './public/img/avatar/'.$file);


                        $userManager -> editAvatar($id, $file);

                        if($userManager -> editAvatar($id, $file)){

                            $user -> setAvatar($file);

                            $this -> redirectTo("security", "profile");

                        }else {
                            session::addFlash("error", "Une erreur est survenue, veuillez réessayer !");
                        }

                    } else {

                        session::addFlash("error", "L'extension de votre fichier ou le format est incorrecte. Veuillez réessayer !") ;

                    }

                
                }

            }  

        }

        return [
            "view" => VIEW_DIR."security/editAvatar.php",
            "data" => [
                "user" => SESSION::getUser(),
            ]
        ];

    }



    
    
    
}