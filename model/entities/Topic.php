<?php
    namespace Model\Entities;

    use App\Entity;

    final class Topic extends Entity{

        private $id;
        private $title;
        private $user;
        private $creationdate;
        private $status;

        public function __construct($data){         
            $this->hydrate($data);        
        }
 

// todo ID Topic

        /* Get the value of id */ 
        public function getId(){
                return $this->id;
        }

        /** Set the value of id
         * @return  self */ 

        public function setId($id){
                $this->id = $id;
                return $this;
        }

// todo Title 

        /* Get the value of title */ 
        public function getTitle(){
                return $this->title;
        }

        /** Set the value of title
         * @return  self */ 

        public function setTitle($title){
                $this->title = $title;
                return $this;
        }


//todo user

        /* Get the value of user */ 
        public function getUser(){
                return $this->user;
        }

        /** Set the value of user
         * @return  self */ 

        public function setUser($user){
                $this->user = $user;
                return $this;
        }


// todo creation date topic

        public function getCreationdate(){
            $formattedDate = $this->creationdate->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setCreationdate($date){
            $this->creationdate = new \DateTime($date);
            return $this;
        }


// todo statut topic

        /* Get the value of status */ 
        public function getStatus(){
                return $this->status;
        }

        /** Set the value of statut
         * @return  self */ 

        public function setStatus($status){
                $this->status = $status;
                return $this;
        }



    }
