<?php
$user = $result["data"]['user'];
?>
    

    
<div class="formulaire">

    <h1>Modifier Avatar</h1>

    <figure class="modifImg preview">
        <img id="file-ip-1-preview" class="modifAvatar" src="public/img/avatar/<?=$user->getAvatar()?>" >
    </figure>


    <form class="uploadButton" action="index.php?ctrl=security&action=modifyAvatar" method="post" enctype="multipart/form-data">
        
        <input class="file-upload" id="file-ip-1" type="file" name="avatar" accept="image/*" onchange="showPreview(event);">
        <button type="submit" name="submit">Enregistrer</button>

    </form>

</div>