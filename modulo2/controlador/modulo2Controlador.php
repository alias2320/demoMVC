<?php

class modulo2Controlador {

    public function inicio() {
        $pagina = $this->cargar_plantilla('MODULO 2');
        $barra = $this->cargar_pagina('vista/secciones/navi.php');
        $contenido = $this->cargar_pagina('vista/contenidos/inicioContenido.php');
        $pagina = $this->cambiar_contenido('/\#NAVI\#/ms', $barra, $pagina);
        $pagina = $this->cambiar_contenido('/\#CONTENIDO\#/ms', $contenido, $pagina);
        $this->generar_vista($pagina);
    }
    
    public function opcion1() {
        $pagina = $this->cargar_plantilla('MODULO 2');
        $barra = $this->cargar_pagina('vista/secciones/navi.php');
        $contenido = $this->cargar_pagina('vista/contenidos/contenido1.php');
        $pagina = $this->cambiar_contenido('/\#NAVI\#/ms', $barra, $pagina);
        $pagina = $this->cambiar_contenido('/\#CONTENIDO\#/ms', $contenido, $pagina);
        $this->generar_vista($pagina);
    }
    
    public function opcion2() {
        $pagina = $this->cargar_plantilla('MODULO 2');
        $barra = $this->cargar_pagina('vista/secciones/navi.php');
        $contenido = $this->cargar_pagina('vista/contenidos/contenido2.php');
        $pagina = $this->cambiar_contenido('/\#NAVI\#/ms', $barra, $pagina);
        $pagina = $this->cambiar_contenido('/\#CONTENIDO\#/ms', $contenido, $pagina);
        $this->generar_vista($pagina);
    }

    public function cargar_plantilla($title = 'Sin Titulo') {
        $pagina = $this->cargar_pagina('../master.php');
        $header = $this->cargar_pagina('vista/secciones/header.php');
        $pagina = $this->cambiar_contenido('/\#HEADER\#/ms', $header, $pagina);
        $pagina = $this->cambiar_contenido('/\#TITLE\#/ms', $title, $pagina);
        $menu = $this->cargar_pagina('vista/secciones/menu.php');
        $pagina = $this->cambiar_contenido('/\#MENU\#/ms', $menu, $pagina);
        return $pagina;
    }

    private function cargar_pagina($page) {
        return file_get_contents($page);
    }

    private function generar_vista($html) {
        echo $html;
    }

    private function cambiar_contenido($in = '/\#CONTENIDO\#/ms', $out, $pagina) {
        return preg_replace($in, $out, $pagina);
    }

}
