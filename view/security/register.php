
<div class="formulaire">

    <h1>Inscription</h1>


    <form action="index.php?ctrl=security&action=register" method="post"> 

        <label>

            <div class="info">
                <p>Pseudonyme :</p> 
                <input  type="text" name="pseudo" placeholder="Pseudo" required>
            </div>

            <div class="info">
                <p>Adresse e-mail :</p>
                <input  type="email" name="email" placeholder="Email" required>
            </div>

            <div class="info">
                <p>Mot de passe :</p>
                <input  type="password" name="password" placeholder="Password" required>
            </div>

            <div class="info">
                <p>Confirmer mot de passe :</p>
                <input  type="password" name="confirmPassword" placeholder="Confirm Password" required>
            </div>

            <button type="submit">Envoyer</button>

        </label> 

    </form>

</div>

