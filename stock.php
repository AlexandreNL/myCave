<?php 
    require __DIR__ . '/header.php';
?>



<main>
    <section id="section-stock-nav">
        <hr class="hr1">
        <!-- <div>
            <ul id="ul-tri">
                <li> 

                </li>
                <li>
                    
                </li>
            </ul>
        </div> -->
    </section>

    <section id="section-stock">
            <?php
            $req = $db->query("
                SELECT *
                FROM bouteilles 
                INNER JOIN couleur c
                ON couleur_id = c.id
            ");

            $req->execute();
            $results = $req->fetchAll(PDO::FETCH_OBJ);

            ?>
            <ul class="cards-list">
                <?php
                foreach($results as $result) { ?>
                <?php
                    $id_bouteille_test = $result->bouteille_id
                 ?>
                <li class="carte-vin">
                <?php if(empty($_SESSION)) : ?>
                <?php else : ?>
                    <a href="delete.php?msg=<?php echo $id_bouteille_test ?> " class="delete_button"> Supprimer </a>
                <?php endif; ?>
                
                <img src="<?= "assets/img/$result->image_path"; ?>" alt="">
                    <h3 class="cards-li"><?php echo $result->chateau ?></h3>
                    <ul class="card-ul">
                        <li>
                            <ul class="cards-ul-geo">
                                <li class="cards-li"><?php echo $result->pays ?></li>
                                <li class="cards-li"><?php echo $result->region ?></li>
                                <li class="cards-li"><?php echo $result->millesime ?></li>
                            </ul>
                        </li>
                        <li class="cards-li"><?php echo $result->description ?></li>
                        <ul class="cards-ul-genre">
                            <li class="cards-li"><?php echo $result->cepage ?></li>
                            <li class="cards-li"><?php echo $result->couleur ?></li>
                        </ul>
                    </ul>
                </li>
                
                <?php } ?> 
                <?php if(empty($_SESSION)) : ?>

                <?php else : ?>
                    <li id="add-card">
                        <a href="stock_add.php">
                            <div id="add-card-button">
                                <p>AJOUTER UNE BOUTEILLE</p>
                            </div>
                        </a>
                    </li>
                <?php endif; ?>
                
            </ul>

        

    </section>
</main>


<?php

    require __DIR__ . '/footer.php';
?> 