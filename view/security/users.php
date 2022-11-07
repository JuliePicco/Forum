<?php

$users = $result["data"]['users'];

?>

<div class="listUserBackground">

    <h1>Listes des utilisateurs</h1>

    <?php

    foreach($users as $user ){

        $user_id = $user->getId();
        ?>

        <div class="listUser">

            <li><strong><?=$user->getPseudo()?></strong> enregistré depuis le <?=$user->getRegisterDate()?></li>

        </div>

    <?php
    }
    ?>


</div>

