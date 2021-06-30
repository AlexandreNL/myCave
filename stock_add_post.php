<?php 
    require __DIR__ . '/header.php';
?>

<?php
mb_internal_encoding( "UTF-8" );
function mb_ucfirst($s)
{
	$s = mb_strtolower($s);
    return mb_strtoupper(mb_substr( $s, 0, 1 )).mb_substr( $s, 1 );
}
?>

<?php
$chateau = htmlentities(mb_strtoupper(trim($_POST['chateau'])), ENT_QUOTES);
$pays = htmlentities(trim($_POST['pays']), ENT_QUOTES);
$region = htmlentities(mb_ucfirst(trim($_POST['region'])), ENT_QUOTES);
$millesime = intval($_POST['millesime']);
$description = htmlentities(mb_ucfirst(trim($_POST['description'])), ENT_QUOTES);
$cepage = htmlentities(mb_ucfirst(trim($_POST['cepage'])), ENT_QUOTES);
$couleur = intval($_POST['couleur_id']);

$image = $_FILES['image_path']; 

$ext = array('png', 'jpg', 'jpeg', 'gif'); 
if(in_array('', $_POST)) {
	$msg_error = 'Merci de renseigner les champs manquants';
}
// error 4 : pas de fichier envoyé
elseif($image['error'] === 4) {
	$msg = 'Merci d\'ajouter un fichier';
}
// error 1 : taille supérieure au php.ini
// error 2 : taille supérieure au MAX_FILE_SIZE du formulaire
elseif($image['error'] === 1 || $image['error'] === 2) {
	$msg = 'La taille du fichier est limité à 1Mo';
}
// error d'upload voir le lien pour les raisons exactes
elseif($image['error'] === 3 || $image['error'] > 4) {
	$msg = 'Une erreur s\'est produite lors du téléchargment';
}
// donc error 0 : fichier bien stocké dans le dossier temporaire
else {
	// on vérifie la taille exacte du fichier
	if($image['size'] > 1000000) {
		$msg = 'La taille du fichier est limité à 1Mo';
	}
	// on récupére l'extension de fichier et on la compare au tableau créé en haut de page
	elseif(!in_array(pathinfo($image['name'], PATHINFO_EXTENSION), $ext)) {
		$msg = 'Le fichier n\'est pas une image';
	}
	// tout est ok, on récupère le fichier et on le stocke sur le serveur
	else {
		// on créé un nom unique pour éviter les doublons (cela écrasement l'image existante)
		$img_name = uniqid() . '_' . $image['name'];
		// on crée le répertoire s'il n'existe pas
		@mkdir(__DIR__ . '/img/', 0775);
		// on récupère le chemin du dossier créé (ou existant)
		$img_folder = __DIR__ . '/assets/img/';
		// on crée le chemin (avec son nom) où sera envoyé le fichier
		$dir = $img_folder . $img_name;
		// on déplace le fichier du dossier temporaire à sa destination finale
		// on stocke le résultat de cette instruction dans une variable (true ou false)
		$move_file = @move_uploaded_file($image['tmp_name'], $dir);
		// le transfert s'est bien passé
        $req = $db->prepare("
        INSERT INTO bouteilles(chateau, pays, region, description, cepage, image_path, millesime, couleur_id)
        VALUES (:chateau, :pays, :region, :description, :cepage, :image_path, :millesime, :couleur_id)
        ");
        
        $req->bindValue(':chateau', $chateau, PDO::PARAM_STR);
        $req->bindValue(':pays', $pays, PDO::PARAM_STR);
        $req->bindValue(':region', $region, PDO::PARAM_STR);
        $req->bindValue(':millesime', $millesime, PDO::PARAM_INT);
        $req->bindValue(':description', $description, PDO::PARAM_STR);
        $req->bindValue(':cepage', $cepage, PDO::PARAM_STR);
        $req->bindValue(':couleur_id', $couleur, PDO::PARAM_INT);
        
        $req->bindValue(':image_path', $img_name, PDO::PARAM_STR);





    $result = $req->execute();

    if($result) {
        $msg_success = 'Bouteille créée';
    }
    else {
        $msg_error = 'Oups, une erreur s`\'est produite';
        
    }
}

	$msg = isset($msg_error);

	$last_url = $_SERVER['HTTP_REFERER']; // url d'où je viens
	if(strpos($last_url, '?') !== FALSE) {
		$req_get = strrchr($last_url, '?');
		$last_url = str_replace($req_get, '', $last_url);
	}
	if($msg) {
		header("Location: $last_url?msg=$msg_error");
	}
	else {
		header("Location: $last_url?msg=$msg_success");
	}
}
?>



<?php
require __DIR__ . '/footer.php';
?> 