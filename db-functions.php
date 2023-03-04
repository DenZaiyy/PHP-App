<?php

function connexion()
{
    $pdo = new PDO(
        'mysql:host=localhost;dbname=store',
        'root',
        '',
        array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        )
    );
    return $pdo;
}

function findAll()
{
    $db = connexion();
    $state = $db->query("SELECT id, name, description, price FROM product");
    return $state->fetchAll();
}

function findOneById($id)
{
    $db = connexion();
    $state = $db->prepare("SELECT id, name, description, price FROM product WHERE id = :id");
    $state->execute(['id' => $id]);
    return $state->fetch();
}

function insertProduct($name, $descr, $price)
{
    $db = connexion();
    $state = $db->prepare("INSERT INTO product (name, description, price) VALUES (:name, :descr, :price)");
    $state->execute([
        'name' => $name,
        'descr' => $descr,
        'price' => $price
    ]);
    return $db->lastInsertId();
}

function deleteById($id)
{
    $db = connexion();
    $state = $db->prepare("DELETE FROM product WHERE id = :id");
    $state->execute(['id' => $id]);
}
