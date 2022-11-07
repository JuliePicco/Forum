<?php

$topics = $result["data"]['topics'];

?>

<div class="mainTopic">
    <h1>Topics</h1>

    <?php
    if($topics == null){
    ?>

        <div class="postVide">
            <p>Aucun topics n'a été créé pour le moment !</p>
            <figure>
                <img src="public\img\mascotte\404.png">
            </figure>
        </div>

    <?php    
    } else {
        
        foreach($topics as $topic ){
            $topic_id=$topic->getId();
            ?>

            <div class="boxTopic">

                <li><a href="index.php?ctrl=forum&action=detailTopic&id=<?=$topic->getId();?>"><strong class="titleTopic"><?=$topic->getTitle()?></strong></a> créé par <strong><?=$topic->getUser()->getPseudo()?></strong> le <?=$topic->getCreationdate()?></a></li>

                <?php 

                    if($topic -> getStatus() == 1){ ?>

                        <p class="lock"><i class="fa-solid fa-unlock-keyhole"></i><p>

                        <?php
                    }else{ ?>

                        <p class="lock"><i class="fa-solid fa-lock"></i><p>
        
                        <?php
                    }
                
                
                if((app\Session::isAdmin())){

                    if($topic -> getStatus() == 1){
                        ?>

                         <a class="lock" href="index.php?ctrl=forum&action=lockTopic&id=<?=$topic_id?>">verrouiller</i></a>

                        <?php
                    }else{
                        ?>

                        <a class="lock" href="index.php?ctrl=forum&action=unlockTopic&id=<?=$topic_id?>">déverouiller</a>
        
                        <?php
                    }
                }
                ?>
                    <a href="index.php?ctrl=forum&action=deleteTopic&id=<?=$topic_id?>">
                        <button class="x" type="button" value="Supprimer">X</button>
                    </a>

            </div>
            
            
            <?php
        }
    }
        ?>

    <figure>
        <img src="public\img\mascotte\1-01.png">
        <img src="public\img\mascotte\2-01.png">
    </figure>

    <a class="addTopic" href="index.php?ctrl=forum&action=addTopic">Ajouter un topic</a>
           


</div>




  
