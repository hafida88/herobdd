<?php
    require_once __DIR__ . ('/../Views/register.view.php');
?>
<?php


    require_once 'partials/head.php';
    //var_dump($_POST);
    if((!empty($_POST['pseudo'])) && (!empty($_POST['email'])) && (!empty($_POST['mot']))){
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['mot de passe']);
        ?>
             adresse mail: <?= $email ?></p>
        <?php
    }else{
        echo "<p>Merci de remplir le formulaire.</p>";
    }
?>



















<?php
    require_once 'partials/footer.php';
?>

