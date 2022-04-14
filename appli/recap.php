<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Récapitulatif des produits</title>
</head>
<body>

    <?php
        // var_dump($_SESSION);
    ?>

    <h1>RECAPITULATIF</h1>
    <!-- Lien page en navigation -->
    <nav>
        <ul>
            <li><a href="http://localhost/exercices/Appli-PHP/appli/index.php">ACCUEIL</a></li>
            <li><a href="http://localhost/exercices/Appli-PHP/appli/recap.php">RECAPUTILATIF</a></li>
            <li>Total produits : <?php echo $product['qtt'] ?> </li>
        </ul>
    </nav>
    <div class="table">
        <?php 
        // || : ... OU ...
            if(!isset($_SESSION['products']) || empty($_SESSION['products'])) {
                echo "<p>Aucun produit en session...</p>";
            }
            else {
                // Ossature du thead du tableau
                echo "<table>",
                        "<thead>",
                            "<tr>",
                                "<th>#</th>",
                                "<th>Nom</th>",
                                "<th>Prix</th>",
                                "<th>Quantité</th>",
                                "<th>Total</th>",
                            "</tr>",
                        "</thead>",
                        "<tbody>";
                $totalGeneral = 0;
                foreach($_SESSION['products'] as $index => $product) {
                    echo "<tr>",
                            // index est ce qui va définir la ligne du produit à cibler
                            "<td>".$index."</td>",
                            "<td>".$product['name']."</td>",
                            // "&nbsp;" correspond à un espace
                            "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                            "<td>
                            <a href='traitement.php?action=moins&id=".$index."'><button>-</button></a>
                            ".number_format($product['qtt'])."
                            <a href='traitement.php?action=plus&id=".$index."'><button>+</button></a>
                            </td>",
                            "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€</td>",
                            "<td id='button'><a href='traitement.php?action=supprimer&id=".$index."' ><button>Supprimer</button><a></td>",
                        "</tr>";
                    $totalGeneral += $product['total'];
    
                }
                echo "<tr>",
                        "<td colspan=4>Total général : </td>",
                        "<td><strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>";
                   
            }
        ?>
                    <td id='button'>
                        <a href="traitement.php?action=vider"><button>Vider le panier</button></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <p>
        
    </p>
</body>
</html>

<!-- 
session : C'est un mécanisme permettant de sauvegarder temporairement sur le serveur des informations relatives à un internaute.
La session se conserve tant que le navigateur reste ouvert
https://apprendre-php.com/tutoriels/tutoriel-14-les-sessions.html 
-->

<!-- variable globale : variable qui peut être utilisée dans tout le programme, portée globale (global $b )-->

<!-- 
superglobale : variables créées automatiquement par PHP.
Elles sont accessibles n'importe où dans le script (local ou global) et sont des variables tableaux.
Les superglobales sont toujours en majuscule (convention).

$GLOBALS : variable qui stocke toute les variables globales dans le script
$_SERVER : 

 SUPERGLOBALES pour manipuler les informations envoyées via formulaire HTML
$_GET : transmet les informations en clair dans la barre d'adresse
$_POST : transmet les informations en masqué mais non crypté dans la barre d'adresse
https://apprendre-php.com/tutoriels/tutoriel-12-traitement-des-formulaires-avec-get-et-post.html

$_FILES : variable contenant toute les informations sur un fichier téléchargé ( nom, taille, etc)
$_COOKIE : variable contenant toutes les variables passées via le cookie HTTP
$_REQUEST : variable qui contient toutes les variables envoyées via HTTP GET / HTTP POST
-->

