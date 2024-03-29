<?php
    //créé un session ou récupère une session sur le serveur, via une requête GET/POST ou par un cookie
    //$_SESSION en PHP est une variable qui permet de stocker des informations pour un utilisateur pendant la durée de sa visite sur le site.
    session_start();

    if(isset($_GET['action'])) {

        // équivaut à une série d'instruction if
        switch($_GET['action']) {

            case "ajouter" :
                // isset : Détermine si une variable est déclarée ET est différente de null
                if(isset($_POST['submit'])) {
                    // filter_input : récupère une variable externe et la filtre
                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
                    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
            
                    if($name && $price && $qtt) {                       
                        $product = [
                            "name" => $name,
                            "price" => $price,
                            "qtt" => $qtt,
                            "total" => $price*$qtt
                        ];           
                        $_SESSION['products'] [] = $product;                        
                    }
                }    
                // redirige dans le navigateur        
                header("Location:recap.php");
                die();
            // Instruction permettant de sortir de la structure 
            break;

// Vider le panier en totalité
            case "vider" :
                // vide les tableaux dans session
                unset($_SESSION['products']);
                // redirige à la page 
                header("Location:recap.php");
                // die : équivaut à exit
                die();           
            break;

// Supprimer un produit de la liste
            case "supprimer" :
                if (isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) {
                    // "id" est lié à l'index de du produit dans "index.php"
                    unset($_SESSION['products'][$_GET['id']]);
                } 
                header("Location:recap.php");
                die();

            break;

// Bouton + sur les produits
            case "plus" :
                if ($_SESSION['products'][$_GET['id']]['qtt'] >= 1) {
                    ++$_SESSION['products'][$_GET['id']]['qtt'];
        
                    // le calcul du total est relancé
                    $_SESSION['products'][$_GET['id']]['total'] =
                    $_SESSION['products'][$_GET['id']]['qtt'] * $_SESSION['products'][$_GET['id']]['price'];
                }
                header("Location:recap.php");
                die();
            break;

// Bouton - sur les produits
            case "moins" :
                if ($_SESSION['products'][$_GET['id']]['qtt'] > 1) {
                    --$_SESSION['products'][$_GET['id']]['qtt'];
        
                    $_SESSION['products'][$_GET['id']]['total'] =
                    $_SESSION['products'][$_GET['id']]['qtt'] * $_SESSION['products'][$_GET['id']]['price'];
                } else  {
                    
                }
                header("Location:recap.php");
                die();               
            break;
        
            
        }

        
    }

    
?>

<!-- Source :
https://www.youtube.com/watch?v=Y29NdxwlovY -->