<?php
    // vérifier si le formulaire a été envoyé
    if(isset($_POST['nom']))
    {
        // traitement des données
        // init variable $err
        $err = 0;
        if(empty($_POST['nom'])){
            $err = 1;
        }else{
            $nom = htmlspecialchars($_POST['nom']);
        }

        // vérifier s'il y a eu une erreur
        if($err == 0){
           if($_FILES['fichier']['error']==4)
            {
                header("LOCATION:index.php?error=2");
                exit();
            }else{
                $dossier = "upload/";
                $fileName = basename($_FILES['fichier']['name']);
                $fileType = $_FILES['fichier']['type'];
                $extension = strrchr($_FILES['fichier']['name'],'.');
                $size = filesize($_FILES['fichier']['tmp_name']);

                $maxSize = 2000000;
                $extensions = [".png",".gif",".jpg",".jpeg",".svg"];
                $mimeType = ["image/png","image/gif","image/jpeg","image/svg+xml"];

                // tester le poids
                if($size > $maxSize){
                    $err = 3;
                }

                // test mimeType
                if(!in_array($fileType,$mimeType)){
                    $err = 4;
                }

                // extension
                if(!in_array($extension,$extensions)){
                    $err = 5;
                }

                if($err==0){
                    $fileName = strtr($fileName,'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                    'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                    $fileName = preg_replace('/([^.a-z0-9]+)/i', '-', $fileName);
                    $fileNameFinal = rand().$fileName;

                    // déplacer le fichier tmp vers la destination
                    // $dossier = "upload/"
                    // $fileNameFinal = 5161561mon-image.jpg
                    // $dossier.$fileNameFinal
                    // upload5161561mon-image.jpg
                    // upload/5161561mon-image.jpg
                    if(move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier.$fileNameFinal)){
                        // insertion dans la bdd
                        require "connexion.php";
                        $insert = $bdd->prepare("INSERT INTO fichiers(nom,fichier) VALUES(:nom,:fichier)");
                        $insert->execute([
                            ":nom"=>$nom,
                            ":fichier"=>$fileNameFinal
                        ]);
                        header("LOCATION:index.php?add=success");
                        exit();
                    }else{
                        header("LOCATION:index.php?error=6");
                        exit();
                    }
                }else{
                    header("LOCATION:index.php?error=".$err);
                    exit();
                }
                        
            }
        }else{
            // redirection avec info erreur
            header("LOCATION:index.php?error=".$err);
            exit();
        }
    }else{
        // pas de formulaire => redirection
        header("LOCATION:index.php");
        exit();
    }
