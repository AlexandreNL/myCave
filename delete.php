<?php 
    require __DIR__ . '/header.php';
?>


<?php

$id = $_GET['msg'];

 $req=$db->prepare("
 DELETE FROM bouteilles
 WHERE bouteille_id = $id
 ");


 $req->execute();

 header("Location: stock.php")

?>

<?php
require __DIR__ . '/footer.php';
?> 