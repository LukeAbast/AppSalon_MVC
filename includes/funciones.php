<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//Verifica si se Encuentra Autenticado
function isAuth() : void {
    if(!isset($_SESSION['login'])){
        header('Location: /');
    }
}

//Verifica si es Admin
function isAdmin() : void {
    if(!isset($_SESSION['admin'])){
        header('Location: /');
    }
}

//Verifica si es el Ultimo Elemento
function esUltimo(string $actual, string $proximo): bool {
    if($proximo !== $actual){
        return true;
    }
    return false;
}