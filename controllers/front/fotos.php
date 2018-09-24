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

    protected function initListaFotos() {
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