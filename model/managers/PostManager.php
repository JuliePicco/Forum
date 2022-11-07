<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\PostManager;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";


        public function __construct(){
            parent::connect();
        }



        //* Fonction permettant de trouver tous les post d'un topic ainsi que sont créateur rangé par date de création.
        public function findPostByTopic($id){

                $sql = "SELECT p.id_post, p.topic_id, p.user_id, t.title, p.message, u.pseudo, p.creationdateP
                    FROM ".$this->tableName." p
                    INNER JOIN topic t
                    ON p.topic_id = t.id_topic
                    INNER JOIN user u
                    ON p.user_id = u.id_user
                    WHERE p.topic_id = :id
                    ORDER BY p.creationdateP
                    ";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );

        }

        public function findPostsByUser($id){

            $sql = "SELECT p.id_post, p.user_id, p.message, p.creationdateP
            FROM ".$this->tableName." p
            WHERE user_id = :id
            ";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true),
                $this->className
            );
        }



        // * Fonction permettant d editer un post
        public function editPost($id, $message){

            $sql = "UPDATE post p
                    SET p.message = :message
                    WHERE p.id_post = :id
                    ";

                    return DAO::update($sql, [
                        ":id"=>$id, 
                        ":message"=>$message]
                    );

        }



        

        


    }