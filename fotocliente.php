<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 9/22/2018
 * Time: 9:35 AM
 */

//Agregamos la clase FotoclienteObj.php
require_once(dirname(__FILE__).'/classes/FotoclienteObj.php');

class FotoCliente extends Module {

    public function __construct() {
        $this->name = "fotocliente";    //Nombre interno del modulo
        $this->displayName = $this->l("Fotos de los clientes");   //Nombre del modulo
        $this->description = $this->l("Modulo que sirve para que los clientes puedan añadir sus propias fotos en los productos"); //Descripcion del modulo
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

        $enable_comment = Configuration::get("FOTOCLI_COMMENTS");   //Recuperamos el valor guardado de Configuration
        $this->context->smarty->assign("enable_comment", $enable_comment);  //Pasar un valor al formulario de getContent

        return $this->display(__FILE__, "getContent.tpl");  //Leer un archivo tpl del hook
    }

    //Funcion de instalacion
    public function install() {
        if(!parent::install())
            return false;

        Configuration::updateValue("FOTOCLI_COMMENTS", "1");    //Guardamos el valor configuracion por defecto
        $this->registerHook("displayProductTabContent");    //Registrar el modulo en el hook

        //Almacenamos la funcion en la variable
        $result = $this->installDB();
        return $result;
//        return true;
    }

    //Funcion que crea una tabla en la DB
    public function installDB() {
        return Db::getInstance()->execute(
            "CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."fotocliente_item` (
                    `id_fotocliente_item` int(11) NOT NULL AUTO_INCREMENT,
                    `id_product` int(11) NOT NULL,
                    `foto` VARCHAR(255) NOT NULL,
                    `comment` text NOT NULL,
                    PRIMARY KEY (`id_fotocliente_item`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;"
        );
    }

    //Funcion de desinstalacion
    public function uninstall() {
        if(!parent::uninstall())
            return false;

        Configuration::deleteByName("FOTOCLI_COMMENTS");    //Eliminar el valor de configuracion guardada

        $result = $this->uninstallDB();
        return $result;
//        return true;
    }

    //Funcion que elimina la tabla
    public function uninstallDB() {
        return Db::getInstance()->execute(
            "DROP TABLE `"._DB_PREFIX_."fotocliente_item`;"
        );
    }

    //Muestra contenido en el hook
    public function hookDisplayProductTabContent($params) {
        if(Tools::isSubmit("fotocliente_submit_foto")) {
            if(isset($_FILES["foto"])) {
                $foto = $_FILES["foto"];
                if($foto["name"] != "") {
                    $allowed = array('image/gif', 'image/jpeg', 'image/jpg', 'image/png');
                    if(in_array($foto["type"], $allowed)) {
                        $path = './upload/';
                        list($width, $height) = getimagesize($foto['tmp_name']);
                        $propo = 400/$width;
                        $copy = ImageManager::resize($foto["tmp_name"], $path.$foto['name'], 400, $propo*$height, $foto["type"]);
                        if(!$copy) {
                            $this->context->smarty->assign("errorForm", $this->l("Error moviendo la imagen: ").$path.$foto["name"]);
                        } else {
                            $id_product = Tools::getValue("id_product");
                            $pathfoto = "upload/".$foto['name'];
                            $comentario = Tools::getValue("comment");

                            //Creamos una nueva instancio de la clase FotoclienteObj
                            $fotoObj = new FotoclienteObj();
                            $fotoObj->id_product = (int)$id_product;
                            $fotoObj->foto = $pathfoto;
                            $fotoObj->comment = pSQL($comentario);
                            $result = $fotoObj->add();  //El metodo add() hace el objecto creado sea guardado en la DB

                            if($result) {
                                $this->context->smarty->assign("saveForm", "1");
                            } else {
                                $this->context->smarty->assign("errorForm", $this->l("No se a podido grabar la foto en la BD"));
                            }
                        }
                    } else {
                        $this->context->smarty->assign("errorForm", $this->l("Formato de imagen no valido"));
                    }
                }
            }
        }

        //Obtnemos todas las fotos del id_product de la pagina
        $fotos = FotoclienteObj::getProductFotos(Tools::getValue("id_product"));
        $this->context->smarty->assign('fotos', $fotos);

        $enable_comment = Configuration::get("FOTOCLI_COMMENTS");
        $this->context->smarty->assign("enable_comment", $enable_comment);

        return $this->display(__FILE__, "displayProductTabContent.tpl");
    }
}