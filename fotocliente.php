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
        $this->tab = "front_office_features";   //Categoria de modulos donde pertenecera
        $this->author = "Adriano Ayala";    //Autor del modulo
        $this->version = "1.0"; //Version del modulo
        $this->bootstrap = true; //Habilitar bootstrap en el modulo

        //Compatibilidad para las versiones
        $this->ps_versions_compliancy = array(
            'min' => '1.6',
            'max' => _PS_VERSION_
        );
        $this->dependencies = array();  //Dependencia de los modulos

        parent::__construct();
    }

    //Funcion de configuracion
    public function getContent() {
        //Verificar si recibe un formulario
        if(Tools::isSubmit("fotoclient_form")) {
            $enable_comment = Tools::getValue("enable_comment");    //Obtener el valor del radio
            Configuration::updateValue("FOTOCLI_COMMENTS", $enable_comment);    //Guardar el valor
        }

        return $this->display(__FILE__, "getContent.tpl");  //Leer un archivo tpl del hook
    }

    //Funcion de instalacion
    public function install() {
//        parent::install();
        if(!parent::install())
            return false;

        return true;
    }

    //Funcion de desinstalacion
    public function uninstall() {
        if(!parent::uninstall())
            return false;

        return true;
    }
}