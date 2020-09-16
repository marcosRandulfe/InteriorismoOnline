<?php
require_once 'Cliente.php';
$c = new Cliente("Marcos", 
                "abc123.",
                "77484013A",
                "Marcos Randulfe", 
                "pp", 4, "B");

var_dump($c->validarLetra("555"));
var_dump($c->validarLetra("BBB"));
var_dump($c->validarLetra("ccc"));
var_dump($c->validarLetra("c"));
var_dump($c->validarLetra("C"));
var_dump($c->dniValido("77484013A"));
?>
