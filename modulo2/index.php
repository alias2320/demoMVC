<?php

require './controlador/modulo2Controlador.php';
$objmod2 = new modulo2Controlador();
if (filter_input(INPUT_GET, 'enlace') == 'opcion1') {
    $objmod2->opcion1();
} else if (filter_input(INPUT_GET, 'enlace') == 'opcion2') {

    $objmod2->opcion2();
} else {
    $objmod2->inicio();
}

