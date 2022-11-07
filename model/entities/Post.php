<?php
    namespace Model\Entities;

    use App\Entity;

    final class Post extends Entity{

        private $id;
        private $user; 
        private $topic;
        private $message;
        private $creationdateP;


        public function __construct($data){         
            $this->hydrate($data);        
        }

// todo ID POST

        /* Get the value of id */ 
        public function getId(){
                return $this->id;
        }

        /** Set the value of id
         * @return  self 
         * */ 
        public function setId($id){
                $this->id = $id;
                return $this;
        }


// todo USER 

        /* Get the value of id */ 
        public function getUser(){
                return $this->user;
        }

        /** Set the value of id
         * @return  self 
         * */ 
        public function setUser($user){
                $this->user = $user;
                return $this;
        }


// todo TOPIC

        /* Get the value of id */ 
        public function getTopic(){
                return $this->topic;
        }

        /** Set the value of id
         * @return  self 
         * */ 
        public function setTopic($topic){
                $this->topic = $topic;
                return $this;
        }

    
// todo MESSAGE

        /* Get the value of message */ 
        public function getMessage(){
                return $this->message;
        }

        /** Set the value of message
         * @return  self 
         * */ 
        public function setMessage($message){
                $this->message = $message;
                return $this;
        }

// todo creationdate POST

        public function getCreationdateP(){
            $formattedDateP = $this->creationdateP->format("d/m/Y, H:i:s");
            return $formattedDateP;
        }

        public function setCreationdateP($date){
            $this->creationdateP = new \DateTime($date);
            return $this;
        }

       
    }