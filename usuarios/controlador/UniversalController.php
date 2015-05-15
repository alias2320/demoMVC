<?php

require 'modelo/UsuarioModel.php';

//require 'modelo/plantillas.php';
class UniversalController {

    public function inicio() {
        $pagina = $this->cargar_plantilla('MODULO USUARIOS');
        $barra = $this->cargar_pagina('vista/secciones/navi.php');
        $contenido = $this->cargar_pagina('vista/contenidos/inicioContenido.php');
        $pagina = $this->cambiar_contenido('/\#NAVI\#/ms', $barra, $pagina);
        $pagina = $this->cambiar_contenido('/\#CONTENIDO\#/ms', $contenido, $pagina);
        $this->generar_vista($pagina);
    }

    public function crearUsuario($params) {
        $pagina = $this->cargar_plantilla('Creación de Usuario');
        $barra = $this->cargar_pagina('vista/secciones/navi.php');
        if ($params != '') {           //al pricipio los parametros estan vacios y envia a cargar la pagina de ingreso usuarios
            $usuario = new Usuario(); //se crea el objeto de tipo usuario de la clase del modelo para enviar la acción
            $id = $usuario->insert($params); //utilizamos el la variable $id= porque nos devuelve un valor la funcion 
            $contenido = '<h3>Usuario creadooooo</h3>';
        } else {

            $contenido = $this->cargar_pagina('vista/contenidos/ingresoUsuario.php'); //carga la pagina de ingreso de usuario el formulario
        }

        $pagina = $this->cambiar_contenido('/\#NAVI\#/ms', $barra, $pagina);          //construyo la pagina
        $pagina = $this->cambiar_contenido('/\#CONTENIDO\#/ms', $contenido, $pagina); //construyo la pagina
        $this->generar_vista($pagina);
    }

    public function eliminarUsuario($params)
    {
        $pagina = $this->cargar_plantilla('Eliminar Usuario');
        $barra = $this->cargar_pagina('vista/secciones/navi.php');
        if ($params != '') {           //al pricipio los parametros estan vacios y envia a cargar la pagina de ingreso usuarios
            $usuario = new Usuario(); //se crea el objeto de tipo usuario de la clase del modelo para enviar la acción
            $id = $usuario->eliminar($params); //utilizamos el la variable $id= porque nos devuelve un valor la funcion 
            $contenido = '<h3>Usuario eliminado</h3>' ;
        } else {

            $contenido = $this->cargar_pagina('vista/contenidos/eliminarUsuario.php'); //carga la pagina de ingreso de usuario el formulario
            
        }
        
        $pagina = $this->cambiar_contenido('/\#NAVI\#/ms', $barra, $pagina);
        $pagina = $this->cambiar_contenido('/\#CONTENIDO\#/ms', $contenido, $pagina); //construyo la pagina
        $this->generar_vista($pagina); 
    }

    public function listar() {
        $usuario = new Usuario();
        ob_start();                                                                    //activa el almacenamiento del buffer de salida
        $lista = $usuario->listar();                                                   //lamamos al metodo listar del modelo 
        $pagina = $this->cargar_plantilla('MODULO USUARIOS');                          //llamamos a la plantilla master 
        $barra = $this->cargar_pagina('vista/secciones/navi.php');

        if ($lista != '') {                                                             //verifica si la lista esta llena 
            $titulo = "LISTADO DE USUARIOS";
            include('vista/contenidos/tablaListado.php');                               //llama a la vista que mostrara la lista de usuarios
            $tabla = ob_get_clean();
            //$contenido = $this->cargar_pagina('vista/contenidos/tablaListado.php');
            $pagina = $this->cambiar_contenido('/\#CONTENIDO\#/ms', $tabla, $pagina);
        } else {
            $contenido = 'No existen usuarios registros';
            $pagina = $this->cambiar_contenido('/\#CONTENIDO\#/ms', $contenido, $pagina);
        }
        $pagina = $this->cambiar_contenido('/\#NAVI\#/ms', $barra, $pagina);
        $this->generar_vista($pagina);                                                       //se genera la vista para el usuario luego de haber construido
    }

    public function cargar_plantilla($title = 'Sin Titulo') {
        $pagina = $this->cargar_pagina('../master.php');                                    //llamamos a la pagina master 
        $header = $this->cargar_pagina('vista/secciones/header.php');                       //llamamos a las secciones de cada modulo de acuerdo al modulo
        $pagina = $this->cambiar_contenido('/\#HEADER\#/ms', $header, $pagina);
        $pagina = $this->cambiar_contenido('/\#TITLE\#/ms', $title, $pagina);
        $menu = $this->cargar_pagina('vista/secciones/menu.php');
        $pagina = $this->cambiar_contenido('/\#MENU\#/ms', $menu, $pagina);
        return $pagina;
    }

    private function cargar_pagina($page) {
        return file_get_contents($page);                                                    //funcion que nos permite cargar la pagina que se esta construyendo 
    }

    private function generar_vista($html) {                                                 //funcion que permite ya generar en si la pagina despues de haver construido 
        echo $html;
    }

    private function cambiar_contenido($in = '/\#CONTENIDO\#/ms', $out, $pagina) {          //funcion que permite 
        return preg_replace($in, $out, $pagina);
    }

}
