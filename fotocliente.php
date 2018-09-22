<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 9/22/2018
 * Time: 9:35 AM
 */

class FotoCliente extends Module {

    public function __construct() {
        $this->name = "fotocliente";    //Nombre interno del modulo
        $this->displayName = "Fotos de los clientes";   //Nombre del modulo
        $this->description = "Modulo que sirve para que los clientes puedan añadir sus propias fotos en los productos"; //Descripcion del modulo
        $this->tab = "front_office_features";   //Seccion donde se mostrara el modulo
        $this->author = "Adriano Ayala";    //Autor del modulo
        $this->version = "1.0"; //Version del modulo
        $this->bootstap = true; //Habilitar bootstrap en el modulo

        parent::__construct();
    }
}