<?php
/**
 * Created by PhpStorm.
 * User: DIGITAL
 * Date: 29/03/2019
 * Time: 10:35
 */

namespace YamiTec\Handlers;


use EphyDB\EphyDB;

interface Database {
    public function __construct($_config);
    public function get();
}
abstract class YamitecDatabase implements Database
{
    private  $_config = [];
    public function __construct($_config)
    {
        $this->_config = $_config;

    }
    public function get(){
        $db = new EphyDB(new \EphyDB\Adapter\Adapter($this->_config));
        return $db;
    }
}