<?php
/**
 * Created by PhpStorm.
 * User: DIGITAL
 * Date: 28/03/2019
 * Time: 11:21
 */

namespace YamiTec\Interfaces;


interface Controller
{
    public function __construct($_conf);
    public function getIndex();
    public function getStore();
    public function getUpdate($id);
    public function postStore();
    public function postUpdate($id,$data);
    public function postDelete($id);

}

abstract class Controllerinterface implements Controller{
    private $_table = null;
    private $_template = null;

    public function __construct($_conf)
    {
        $this->_template = $_conf['template'];
    }

    public function getIndex()
    {
        // TODO: Implement getIndex() method.
        echo $this->_template."/index.tpl";
    }
    public function getStore()
    {
        // TODO: Implement getStore() method.
        echo $this->_template."/new.tpl";
    }
    public function getUpdate($id)
    {
        // TODO: Implement getUpdate() method.
        echo $this->_template."/edit.tpl";
    }
    public function postStore()
    {
        // TODO: Implement setStore() method.
        echo $data;
    }
    public function postUpdate($id, $data)
    {
        // TODO: Implement setUpdate() method.
        echo $data;
    }
    public function postDelete($id)
    {
        // TODO: Implement setDelete() method.
        echo $id;
    }
}