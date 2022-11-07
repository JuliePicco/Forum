<?php
$user = $result["data"]['user'];
?>

<div class="formulaire">

    <h1>Modifier Information</h1>

    <form action="index.php?ctrl=security&action=modifyInfo" method="post" > 

        <label>

            <div class="info">
                <p>Pseudonyme :</p>
                <input type="text" name="pseudo" value="<?= $user->getPseudo()?>" required>
            </div>

            <div class="info">
                <p>Adresse E-mail:</p>
                <input type="email" name="email" value="<?= $user->getEmail()?>" required>
            </div>
       
            <button type="submit" name="submit">Envoyer</button>

        </label>

    </form>

</div>