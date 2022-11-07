





<?php
if(App\Session::getUser()){
    ?>

    <main class="homeBackground">

    <div class="home">

        <h1>BIENVENUE SUR LE FORUM <br> ~ <?= App\Session::getUser()->getPseudo()?> ~ </h1>

        <p>Discuter, échanger et partager avec la communautée.</p>

        <figure>
            <img src="public\img\mascotte\hi.png">
        </figure> 

    </main>

    <?php
}
else{
    ?>
        <main class="homeBackground">

            <div class="home">

                <h1>BIENVENUE SUR LE FORUM </h1>

                <p>Discuter, échanger et partager avec la communautée.</p>

                <figure>
                    <img src="public\img\mascotte\hi.png">
                </figure>     

                <div class="link">
                    <a href="index.php?ctrl=security&action=loginForm">Se connecter</a>
                    <span>&nbsp;-&nbsp;</span>
                    <a href="index.php?ctrl=security&action=registerForm">S'inscrire</a>
                </div>

            </div>

        </main>
    
<?php
}
?>
