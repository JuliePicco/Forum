<?php

$user = $result["data"]['user'];
$posts = $result["data"]['posts'];
$topics = $result["data"]['topics'];



?>

<div class="backgroundProfil">

    <figure>
        <div class="profilAvatar">
            <img class="avatarP" src="public/img/avatar/<?=$user->getAvatar()?>" >
            <a href="index.php?ctrl=security&action=modifyAvatar">
                <button class="textAvatar" type="button" value="modifier" name="modifier" >modifier image</button>
            </a>
        </div>
    </figure>

    

    <div class="profil">

    <h1>Profil de <?=$user->getPseudo()?></h1>

        <div class="infoP">

            <h2>Informations</h2>
            <span class="ligne"></span>

            <div class="profileInfo">
                    
                <div class="editInfo">
                    <p><strong>Pseudonyme :</strong> <?=$user->getPseudo()?></p> 
                    <p><strong>e-mail :</strong> <?=$user->getEmail()?></p>
                    <a href="index.php?ctrl=security&action=modifyInfo">
                        <button type="button" value="Modifier" name="modifier">Modifier</button>
                    </a>
                    
                
                </div>

                <div class="editInfo">
                    <p class="mdp"><strong>Mot de passe </strong> <?=$user->getPassword()?></p>
                    <a href="index.php?ctrl=security&action=modifyPassword">
                        <button type="button" value="Modifier" name="modifier">Modifier</button>
                    </a>
                </div>

            </div>


        </div>

        <div class="topicP">

            <h2>Topics créés</h2>
            <div class="ligne"></div>

            <?php
            if($topics == null){
                ?>

                <p>Aucun Topic créé !</p>

            <?php
            } else { 

                foreach($topics as $topic){     
            ?>

                <div class="topicProfil">
                    <p><strong><?=$topic->getTitle()?></strong> à <?=$topic->getCreationdate()?></p>
                </div>

                <?php
                }
            }
            ?>

        </div>

        <div class="messageP">
            <h2>Messages envoyés</h2>
            <div class="ligne"></div>

            <?php
            if($posts == null){
            ?>

                <p>Aucun message</p>

            <?php
            }else{

                foreach($posts as $post){
            ?>

                <div class="postProfil">
                    <!-- gettopic ne fonctionne pas -->
                    <p><strong><?=$post->getMessage()?></strong> dans <?=$post->getTopic()?> à <?=$post->getCreationdateP()?></p>
                </div>

                <?php
                }
            }
            ?>

        </div>

    </div>


</div>