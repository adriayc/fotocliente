<?php
/**
 * Created by PhpStorm.
 * User: Adriano
 * Date: 9/23/2018
 * Time: 5:42 PM
 */

class FotoclienteObj extends ObjectModel {

    public $id_fotocliente_item;
    public $id_product;
    public $foto;
    public $comment;

    //Funcion que permite guardar y recoger los datos de la DB
    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'fotocliente_item', 'primary' => 'id_fotocliente_item', 'multilang' => false,
        'fields' => array(
            'id_product' => array('type' => self::TYPE_INT, 'validate' => 'isUnsignedId', 'required' => true),
            'foto' => array('type' => self::TYPE_STRING, 'required' => true),
            'comment' => array('type' => self::TYPE_HTML, 'validate' => 'isCleanHtml'),
        ),
    );

}