<?php

require './controlador/UniversalController.php';

//se instancia al controlador 
$controladorUniversal = new UniversalController();

//isset permite evaluar si la variable esta definida o no en este caso en el formulario 

if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['clave'])&& isset($_POST['edad'])&& isset($_POST['id'])) 
    
    {
    //usunombre y usudireccion son los nobres de la tabla de la base de datos => de tipo post  usuanombre nombre variable => $_POST de tipo POST

    $params = array('NOMBRE' => $_POST['nombre'], 'EMAIL' => $_POST['email'], 'CLAVE' => $_POST['clave'], 'EDAD' => $_POST['edad'], 'ID' => $_POST['id']);
    // unset($params['usunombre']); elimina el elemneto de la lista 
    $controladorUniversal->crearUsuario($params); //enviamos los parametros al metodo crear 
    } 
else if (filter_input(INPUT_GET, 'enlace') == 'crear') {//utilizo el input_get par que no salga error la utilizacion del get es para enviar informacion por medio del url aqui es importante utilizar el get para enviar el enlace de nuestra
    $params = '';
    $controladorUniversal->crearUsuario($params);
    
} else if (filter_input(INPUT_GET, 'enlace') == 'listar') {

    $controladorUniversal->listar();
    
} else if (filter_input(INPUT_GET, 'enlace') == 'eliminar') {
    
    
    if(isset($_POST['id']))
       {
           $params = array ('ID' => $_POST['id']);
           $controladorUniversal->eliminarUsuario($params);
       }
     else{
         $params ='';
         $controladorUniversal->eliminarUsuario($params);
     }
   
    
} else {
    $controladorUniversal->inicio();
}
?>
