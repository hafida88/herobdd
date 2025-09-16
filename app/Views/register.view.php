
<?php 
require_once(__DIR__ . '/partials/head.php');
?>


<h1>Formulaire </h1>
    <form action="validform.php" method="post">
        <div class="container mt-5">
            <div class="form-group">
                <label for="name">Pseudo</label>
                <input type="text" class="form-control" name="name" placeholder="Marie">
            </div>
            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input type="email" class="form-control" name="email" placeholder="maria@gmail.com">
            </div>
           <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary mt-2">Envoyer</button>
        </div>
    </form>

































<?php 
require_once(__DIR__ . '/partials/footer.php');
?>