<?php
function conectar($bdimovel)
{
    return new PDO("mysql:host=localhost;dbname=$bdimovel", "root", "");

}

function encerrar()
{
    return null;

}

?>