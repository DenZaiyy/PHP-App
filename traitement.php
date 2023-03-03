<?php
session_start();
require './db-functions.php';

//si il y a le mot action dans l'url
if (isset($_GET['action'])) {
    //switch entre différentes actions possibles
    switch ($_GET['action']) {
        case "addToCart":
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                filter_var($id, FILTER_VALIDATE_INT);
                $item = findOneById($id);
                $qtt = 1;

                $product = [
                    "name" => $item['name'],
                    "price" => $item['price'],
                    "qtt" => $qtt,
                    "total" => $item['price'] * $qtt
                ];

                if ($_SESSION['products']['name'] === $item['name']) {
                }
                $_SESSION['products'][] = $product;
                header('Location:index.php');
            }
            break;
        case "addProduct":
            if (isset($_POST['submit'])) {
                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

                $_SESSION['statuts'] = $message;
                $message = "";

                if ($name && $price && $qtt) {
                    $product = [
                        "name" => $name,
                        "price" => $price,
                        "qtt" => $qtt,
                        "total" => $price * $qtt
                    ];

                    $_SESSION['products'][] = $product;
                    $_SESSION['statuts'] = "Produit enregistré";
                    header('Location:index.php');
                } else {
                    $_SESSION['statuts'] = "Veuillez remplir tous les champs avant de valider";
                    header('Location:index.php');
                }
            }
            break;

        case "removeAll":
            unset($_SESSION['products']);
            header('Location:index.php');
            die(); //die() fonction native signifie qu'après l'action précédé on arrête l'execution du script
            break;
        case "deleteItem":
            //si j'ai le mot clé "id" dans l'URL et que j'ai un produit dans mon tableau qui correspond à cet id
            if (isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) {
                //alors je supprime la ligne de mon tableau contenant l'id selectionner
                unset($_SESSION['products'][$_GET['id']]);
                header('Location:recap.php');
                die();
            }
            break;
        case "decreaseQuantity":
            if (isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) {
                //je décrémente la valeur de "qtt" de 1
                $_SESSION['products'][$_GET['id']]['qtt'] -= 1;
                //je recalcule mon total pour pouvoir mettre à jour le prix par rapport a la quantité
                $_SESSION['products'][$_GET['id']]['total'] = $_SESSION['products'][$_GET['id']]['price'] * $_SESSION['products'][$_GET['id']]['qtt'];
                //je vérifie si la quantité est égale à 0, si oui, je supprime la ligne du tableau
                if ($_SESSION['products'][$_GET['id']]['qtt'] === 0) {
                    unset($_SESSION['products'][$_GET['id']]);
                }
                header('Location:recap.php');
                die();
            }
            break;
        case "increaseQuantity":
            if (isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) {
                $_SESSION['products'][$_GET['id']]['qtt'] += 1;
                $_SESSION['products'][$_GET['id']]['total'] = $_SESSION['products'][$_GET['id']]['price'] * $_SESSION['products'][$_GET['id']]['qtt'];
                header('Location:recap.php');
                die();
            }
            break;
    }
}
