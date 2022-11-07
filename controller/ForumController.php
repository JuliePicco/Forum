<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class ForumController extends AbstractController implements ControllerInterface{


// todo FONCTION D'AFFICHAGE DE TOPICS ET DE POSTS 

        //* Permet d'afficher tous les topics par ordre de date créée.
        public function index(){

           $topicManager = new TopicManager();
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["creationdate", "ASC"])
                ]
            ];

        }

        //* Permet d'afficher tous les post d'un topic.
        public function detailTopic($id){

            $postManager = new PostManager();
            $topicManager = new TopicManager();
            
            return [
                "view" => VIEW_DIR."forum/detailTopic.php",
                "data" => [
                    "posts" => $postManager->findPostByTopic($id),
                    "topics" => $topicManager->findOneById($id),
                ]
            ];

        }

// todo FONCTION D'AJOUT DE TOPIC ET DE POST 

        //* Permet d'ajouter un nouveau topic
        // ! ajouter avec un topic le message du créateur du topic
        public function addTopic(){

            $topicManager = new TopicManager();

            if(!empty($_POST)){

                $newTopic = filter_input(INPUT_POST, "newTopic", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
               
                $user = $_SESSION['user'];
                $id_user = $user->getId();

                $topicManager->add([
                    "title" => $newTopic,
                    "user_id" => $id_user
                ]);

                 $this->redirectTo("forum", "index"); 
            }

            return [
                "view" => VIEW_DIR."forum/addTopic.php",
                ];
           
        }


        //* Permet d'ajouter un nouveau post
        public function addPost($id){

            $postManager = new PostManager();

            if(isset($_POST["submit"]) && !empty($_POST["message"])){

                $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                $user = $_SESSION['user'];
                $id_user = $user->getId();
    
                $postManager->add([
                    "message" => $message,
                    "topic_id" => $id,
                    "user_id" => $id_user
                    
                ]);

                 $this->redirectTo("forum", "detailTopic", $id); 
            }

            return [
                "view" => VIEW_DIR."forum/detailTopic.php",
                ];

        }


// todo FONCTION DE SUPPRESSION DE TOPIC ET DE POST

        //* Permet de supprimer un topic (ce qui inclut tous ces messages)
        
        public function deleteTopic($id){

            $topicManager = new TopicManager();
            $topicManager->delete($id);

            $this->redirectTo("forum", "listTopic");

        }


        //* Permet de supprimer un post

        public function deletePost($id){

            $postManager = new PostManager();

            // recherche le poste en question ...
            $post = $postManager->findOneById($id);
            // ... qui est associé à un topic ...
            $topic_id = $post->getTopic()->getId();
            // ... et le supprime
            $postManager->delete($id);

            $this->redirectTo("forum", "detailTopic", $topic_id);

        }



// todo FONCTION DE MODIFICATION D'UN POSTS

        public function editPost($id){

            $postManager = new PostManager();

            // permet de recuperer le le post en question par son l'id
            $updatePost = $postManager->findOneById($id);
            // permet de trouver à quel topic il est attaché
            $topic_id = $updatePost->getTopic()->getId();
            

            if (!empty($_POST['message'])){

                $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $postManager->editPost($id, $message);

                $this->redirectTo("forum", "detailTopic", "$topic_id");
            }
            
            return [
                "view" => VIEW_DIR."forum/editPost.php",
                "data" => [
                    "post" => $updatePost,
                ]
            ];

        }

// todo FONCTION  DE VERROUILLAGE/DEVERROUILLAGE DE TOPIC 

        public function lockTopic($id){

            $topicManager = new TopicManager();

            $topic = $topicManager ->findOneById($id);

            $topic_id = $topic -> getId();

            $topicManager -> requestLockTopic($topic_id);
        
            header("Location:index.php?ctrl=forum&action=listTopics");

        }


        public function unlockTopic($id){

            $topicManager = new TopicManager();

            $topic = $topicManager ->findOneById($id);

            $topic_id = $topic -> getId();

            $topicManager -> requestUnlockTopic($topic_id);

            header("Location:index.php?ctrl=forum&action=listTopics");

        }





        

            
        

        

        





    } 
       


        

    


   
