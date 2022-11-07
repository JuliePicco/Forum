<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\UserManager;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }

        // Récupétation des données par rapport au pseudo 
        public function findOneByPseudo($data){

            $sql = "SELECT u.id_user, u.email, u.pseudo, u.avatar, u.roles
            FROM ".$this->tableName." u
            WHERE u.pseudo = :pseudo
            ";

            return $this->getOneOrNullResult(
            DAO::select($sql, ['pseudo' => $data], false), 
            $this->className
            );

        }


        // recupération du MDP par pseudo.
        public function findPasswordByPseudo($pseudo){

            $sql = "SELECT u.password
            FROM ".$this->tableName." u
            WHERE u.pseudo = :pseudo
            ";

            return $this->getOneOrNullResult(
            DAO::select($sql, ['pseudo' => $pseudo], false), 
            $this->className
            );

        }


        // * Fonction permettant d editer un MDP
        public function editPassword($id, $password){

            $sql = "UPDATE user u 
                    SET u.password = :password
                    WHERE u.id_user = :id
                    ";

                    return DAO::update($sql, [
                        ":id"=>$id, 
                        ":password"=>$password]
                    );

        }


        // * Fonction permettant d editer le pseudo et le mail
        public function editInfo($id, $pseudo, $email){

            $sql = "UPDATE user u 
                    SET u.pseudo = :pseudo,
                        u.email = :email
                    WHERE u.id_user = :id
                    ";

                    return DAO::update($sql, [
                        ":id"=>$id, 
                        ":pseudo"=>$pseudo,
                        ":email"=>$email]
                    );

        }

        // * Fonction permettant d editer l'avatar

        public function editAvatar($id, $file){

            $sql = "UPDATE user u 
                    SET u.avatar = :avatar
                    WHERE u.id_user = :id
                    ";

                    return DAO::update($sql, [
                        ":id"=>$id, 
                        ":avatar"=>$file]
                    );

        }


    }