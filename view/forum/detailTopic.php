<?php

$posts = $result["data"]['posts'];
$topic = $result["data"]['topics'];

?>

<div class="mainPost">

    <h1><?=$topic->getTitle()?></h1>

    <?php
    if($posts == null){
    ?>
        <div class="postVide">
            <p>Aucun post n'a été créé pour le moment !</p>
            <figure>
                <img src="public\img\mascotte\404.png">
            </figure>
        </div>

    <?php
    } else {
        
        foreach($posts as $post){
            $post_id=$post->getId();
            ?>

            <div class="boxMessage">

                <div class="userMessage">

                    <figure>
                        <img class="avatarM" src="public/img/avatar/<?=$post->getUser()->getAvatar()?>" >
                        <p><?= $post->getUser()->getPseudo()?></p>
                    </figure>

                <div class="messageDate">
                    <p><?=$post->getMessage()?></p>
                    <small>le <?=$post->getCreationdateP()?></small>
                </div>
                
                </div>

                <?php

                if(isset($_SESSION["user"])){

                    // On recherche les info de l'user en session
                    $infoUser = $_SESSION["user"];

                    // On recupère l'id de l'user en session
                    $idUser = $infoUser -> getId();

                    // On récupère l'id de l'user qui a écrit le topic
                    $userPost = $post -> getUser() -> getId();

                    if(app\Session::isAdmin()){
                        ?>
                        
                        <div class="modifyPost">

                            <a href="index.php?ctrl=forum&action=editPost&id=<?=$post_id?>">
                                <button class="modify" type="button" value="Modifier" name="modifier">Modifier</button>
                            </a>

                            <a href="index.php?ctrl=forum&action=deletePost&id=<?=$post_id?>">
                                <button class="x" type="button" value="Supprimer" >X</button>
                            </a>

                        </div>

                        <?php    
                    } elseif ((app\Session::getUser()-> getId()) == $userPost){
                        ?>

                        <div class="modifyPost">

                            <a href="index.php?ctrl=forum&action=editPost&id=<?=$post_id?>">
                                <button class="modify" type="button" value="Modifier" name="modifier">Modifier</button>
                            </a>

                        </div>

                    <?php
                    }
                }
                ?>

            </div>

            <?php
        }
    }
    

    if(app\Session::getUser()){

        if(!empty($post)){

            if($post -> getTopic() -> getStatus() == 1){ ?>

                <div class="newMessage">
                    <h3>Nouveau message</h3>

                    <form action="index.php?ctrl=forum&action=addPost&id=<?=$id?>" method="post"> 

                        <textarea name="message" placeholder="Votre message ..."></textarea>
                        <button type="submit" name="submit">Envoyer</button>

                    </form>
                </div>

                <?php

            }else { ?>

                <div class="postVide">
                    <br>
                    <p>Le topic est fermé, vous ne pouvez plus poster de message</p>
                </div>

                <?php
            }

        } else { ?>

            <div class="newMessage">
                <h3>Nouveau message</h3>

                <form action="index.php?ctrl=forum&action=addPost&id=<?=$id?>" method="post"> 

                    <textarea name="message" placeholder="Votre message ..."></textarea>
                    <button type="submit" name="submit">Envoyer</button>

                </form>
            </div>

            <?php

        }
    }

    ?>

</div>

