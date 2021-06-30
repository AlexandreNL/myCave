<?php 
    require __DIR__ . '/header.php';
?>

<main>
    <section id="section_stock_add">
    <?php if(empty($_SESSION)) : 
        header('Location: index.php');?>

        <?php 
        else : 

            mb_internal_encoding( "UTF-8" );
            function mb_ucfirst( $s ){
                $s = mb_strtolower($s);
                return mb_strtoupper(mb_substr( $s, 0, 1 )).mb_substr( $s, 1 );
                }
                
                $req = $db->query("
                SELECT *
                FROM bouteilles 
                INNER JOIN couleur c
                ON couleur_id = c.id
                ");
                $req2 = $db->query("
                SELECT *
                FROM couleur
                ");
            $req->execute();
            ?>
            <div id="section_stock_add_div">
            <h1>Création d'une bouteille</h1>
            <form action="stock_add_post.php" enctype="multipart/form-data" method="POST" id="form_stock_add">
                <div>
                    <label for="image_path"> Image <span class="red">*</span></label>
                    <input id="image_path" type="file" name="image_path">
                    <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
		        </div>
                <div>
                    <label for="chateau">Chateau</label>
                    <input type="text" name="chateau" id="chateau">
                </div>
                <div>
                    <label for="pays">Pays</label>
                    <input type="text" name="pays" id="pays">
                </div>
                <div>
                    <label for="region">Region</label>
                    <input type="text" name="region" id="region">
                </div>
                <div>
                    <label for="millesime">Millésime</label>
                    <input type="number" min="2005" max="2021" step="1"  name="millesime" id="millesime">
                </div> 
                <div>
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description">
                </div>
                <div>
                    <label for="cepage">Cépage</label>
                    <input type="text" name="cepage" id="cepage">
                </div>
                <div>
                    <label for="couleur_id">Couleur</label>
                    <select name="couleur_id" id="couleur_id">
                    <?php while($option = $req2->fetchObject()) {
                        echo '<option value="' . $option->id . '">' . mb_ucfirst($option->couleur) . '</option>';
                    } ?>
			        </select>
                </div>
                <button type="submit">Créer bouteille</button>
	        </form>
            
            <div id="result"><?php if(isset($_GET['msg'])) echo $_GET['msg']; ?></div>
            </div>

            <?php
            
            
            ;

        endif; ?>
        </section>
</main>










<?php
require __DIR__ . '/footer.php';
?> 