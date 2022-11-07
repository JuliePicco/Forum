<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity{

        private $id;
        private $pseudo;
        private $email;
        private $password;
        private $avatar;
        private array $roles;
        private $registerDate;


        public function __construct($data){         
            $this->hydrate($data);        
        }
 
// todo ID user

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


// todo Pseudo

        /* Get the value of pseudo */ 
        public function getPseudo(){
                return $this->pseudo;
        }

        /** Set the value of pseudo
         * @return  self */ 

        public function setPseudo($pseudo){
                $this->pseudo = $pseudo;
                return $this;
        }


// todo email

        /* Get the value of email */ 
        public function getEmail(){
                return $this->email;
        }

        /** Set the value of email
         * @return  self */ 

        public function setEmail($email){
                $this->email = $email;
                return $this;
        }


// todo password

        /* Get the value of password */ 
        public function getPassword(){
                return $this->password;
        }

        /** Set the value of password
         * @return  self */ 

        public function setPassword($password){
                $this->password = $password;
                return $this;
        }


// todo avatar

        /* Get the value of avatar */ 
        public function getAvatar(){
                return $this->avatar;
        }

        /** Set the value of avatar
         * @return  self */ 

        public function setAvatar($avatar){
                $this->avatar = $avatar;
                return $this;
        }


//todo role user

        public function getRoles(){

                return $this->roles;
        }

         /** Set the value of role
         * @return  self 
         */ 
 
        public function setRoles($roles): self{

                $this->roles=json_decode($roles);

                if(empty ($this->roles)){
                        $this->roles ="ROLE_USER";
                }

                return $this;

        }

        public function hasRole($role){
                // on retourner donc si dans un tableau Json on trouve un role qui correspond au role envoyer en parametre alors on returne true
                return in_array($role, $this->getRoles());
        }





// todo register date

        public function getRegisterDate(){
                $formattedDate = $this->registerDate->format("d/m/Y, H:i:s");
                return $formattedDate;
        }

        public function setRegisterDate($date){
                $this->registerDate = new \DateTime($date);
                return $this;
        }


// todo Permet de recuperer le pseudo

        public function __toString()
        {
                return $this->getPseudo();
        }
     
    }

           