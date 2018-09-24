<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 9/24/2018
 * Time: 1:20 AM
 */

/*
 * Para ejecutar el controlador
 * http://localhost/myshop/index.php?fc=module&module=fotocliente&controller=fotos&module_action=listafotos
 */

class FotoclienteFotosModuleFrontController extends ModuleFrontController {

    public function init() {
        //Ocultar la columna izquierda y derecha de la pagina
        $this->display_column_left = false;
        $this->display_column_right = false;
        parent::init();
    }

    //Funcion para anaidir CSS y JS al controlador
    public function setMedia() {
        parent::setMedia();

        $this->path = __PS_BASE_URI__.'modules/fotocliente/';   //Obtenemos la url del nuestro modulo
        $this->context->controller->addCSS($this->path.'views/css/fotocliente.css', 'all');
        $this->context->controller->addJS($this->path.'views/js/fotocliente.js');
    }

    protected function initListaFotos() {
        $fotos = FotoclienteObj::getAll();
        $this->context->smarty->assign('fotos', $fotos);
        $enable_comment = Configuration::get('FOTOCLI_COMMENTS');
        $this->context->smarty->assign('enable_comment', $enable_comment);

        $this->setTemplate("listaFotos.tpl");
    }

    public function initContent() {
        parent::initContent();

        $module_action = Tools::getValue('module_action');
        $actions_list = array('listafotos' => 'initListaFotos');
        if(isset($actions_list[$module_action]))
            $funcion = $actions_list[$module_action];
        $this->$funcion();
    }
}