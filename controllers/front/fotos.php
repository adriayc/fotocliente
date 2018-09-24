<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 9/24/2018
 * Time: 12:46 AM
 */

class FotoclienteFotosModuleFrontController extends ModuleFrontController {

    protected function initListaFotos() {

    }

    public function initContent() {
        parent::initContent();

        $module_action = Tools::getValue('module_action');
        $action_list = array('listafotos' => 'initListafotos');
        if(isset($action_list[$module_action]))
            $funcion = $action_list[$module_action];
            $this->$funcion;
    }
}