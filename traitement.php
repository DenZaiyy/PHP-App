<?php
session_start();
require './db-functions.php';

$msg = "";

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
                    "product_id" => $item['id'],
                    "name" => $item['name'],
                    "price" => $item['price'],
                    "qtt" => $qtt,
                    "total" => $item['price'] * $qtt
                ];

                $already_exists = false;

                foreach ($_SESSION['products'] as $key => $value) {
                    if ($value['product_id'] === $item['id']) {
                        $already_exists = $key;
                        break;
                    }
                }

                if ($already_exists !== false) {
                    $msg = "Vous venez de rajouter 1 " . $product['name'] . " au panier";
                    $_SESSION['products'][$already_exists]['qtt'] += $qtt;
                    $_SESSION['products'][$already_exists]['total'] = $_SESSION['products'][$already_exists]['price'] * $_SESSION['products'][$already_exists]['qtt'];
                } else {
                    $_SESSION['products'][] = $product;
                    $msg = "Vous venez d'ajouter le produit " . $product['name'] . " au panier";
                }

                $_SESSION['message'] = $msg;
                header('Location:index.php');
            }
            break;
        case "addProduct":
            if (isset($_POST['submit'])) {
                $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $desc = filter_input(INPUT_POST, "desc", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if ($name && $price && $desc) {
                    $product = [
                        "name" => $name,
                        "price" => $price,
                        "desc" => $desc
                    ];

                    $id = insertProduct($product['name'], $product['desc'], $product['price']);
                    header('Location:product.php?id=' . $id);
                } else {
                    header('Location:index.php');
                }
            }
            break;

        case "removeAll":
            $msg = "Vous venez de supprimer tout les articles du panier.";
            unset($_SESSION['products']);
            $_SESSION['message'] = $msg;
            header('Location:recap.php');
            die(); //die() fonction native signifie qu'après l'action précédé on arrête l'execution du script
            break;
        case "deleteItem":
            //si j'ai le mot clé "id" dans l'URL et que j'ai un produit dans mon tableau qui correspond à cet id
            if (isset($_GET['id']) && isset($_SESSION['products'][$_GET['id']])) {
                //alors je supprime la ligne de mon tableau contenant l'id selectionner
                $msg = "Vous venez de supprimer <strong>" . $_SESSION['products'][$_GET['id']]['name'] . "</strong> du panier.";
                unset($_SESSION['products'][$_GET['id']]);
                $_SESSION['message'] = $msg;
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
        case "deleteBddItem":
            if (isset($_POST['submit'])) {
                $id = $_POST['products'];
                filter_var($id, FILTER_VALIDATE_INT);
                deleteById($id);
                header('Location: index.php');
                die();
            }
    }
}
