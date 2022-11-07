<?php
$post = $result["data"]['post'];
?>

<div class="editBackgroundPost">

    <h1>Modifier message</h1>

    <form action="index.php?ctrl=forum&action=editPost&id=<?=$id?>" method="post"> 

        <textarea name="message" placeholder=""><?=$post->getMessage()?></textarea>
        <button class="addButton" type="submit" name="submit">Envoyer</button>

    </form>

</div>


