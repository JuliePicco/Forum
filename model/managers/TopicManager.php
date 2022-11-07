<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\TopicManager;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }


        public function findTopicsByUser($id){

            $sql = "SELECT t.title, t.creationDate, t.user_id
            FROM ".$this->tableName." t
            WHERE user_id = :id
            ";

            return $this->getMultipleResults(
                DAO::select($sql, [':id' => $id], true),
                $this->className
            );
        }



        public function requestLockTopic($id){

            $sql = "UPDATE ".$this ->tableName." t
                    SET t.status = 0
                    WHERE t.id_topic = :id
                   ";

            return DAO::update($sql, [
                ':id' => $id,
            ]);                
        }


        public function requestUnlockTopic($id){

            $sql = "UPDATE ".$this ->tableName." t
                    SET t.status = 1
                    WHERE t.id_topic = :id
                   ";

            return DAO::update($sql, [
                ':id' => $id,
            ]);                
        }


    }