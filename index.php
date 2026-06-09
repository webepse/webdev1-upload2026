<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>PHP Upload</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                  <form action="traitement.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nom">Nom: </label>
                        <input type="text" name="nom" id="nom" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="fichier">Fichier</label>
                        <input type="file" name="fichier" id="fichier" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Envoyer" class="btn btn-success mt-3">
                    </div>
                </form>
            </div>
        </div>
        <?php
            require "connexion.php";
            $req = $bdd->query("SELECT * FROM fichiers");
            while($don = $req->fetch(PDO::FETCH_ASSOC)){
                echo "<div class='col-3'>";
                    echo "<img src='upload/".$don['fichier']."' alt='image de ".$don['nom']."' class='img-fluid'>";
                echo "</div>";
            }
            $req->closeCursor();
        ?>
    
    </div>


</body>
</html>