

<div class="formulaire">

    <h1>Modifier mot de passe</h1>

    <form action="index.php?ctrl=security&action=modifyPassword" method="post"> 

        <label>

            <div class="infoEdit">
                <p>Nouveau mot de passe :</p>
                <input  type="password" name="password" placeholder="Password" required>
            </div>

            <div class="infoEdit">
                <p>Confirmer le nouveau mot de passe :</p>
                <input  type="password" name="confirmPassword" placeholder="Confirm Password" required>
            </div>
                        
            <button type="submit" name="submit">Envoyer</button>

        </label>

    </form>

</div>

