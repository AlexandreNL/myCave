<?php 
    require __DIR__ . '/header.php';
    
?>


<main>

    <section id="section-connexion">
        <hr class="hr1">
            <div id="section_connexion_div">
                <form action="connexion_post.php" method="POST" id="form_connect">
                    <div>
                        <label for="email">eMail</label>
                        <input id="email" type="text" name="email">
                    </div>
                    <div>
                        <label for="password">Mot de passe</label>
                        <div class="password_input">
                            <input id="password" type="password" name="password">
                        </div>
                        
                    </div>
                    <button type="submit">Se connecter</button>

                    <div id="result"><?php if(isset($_GET['msg'])) echo $_GET['msg']; ?></div>

                </form>
            </div>
    </section>
</main>

<?php 
    require __DIR__ . '/footer.php';
?>