<?php
/**
 * Created by PhpStorm.
 * User: DIGITAL
 * Date: 28/03/2019
 * Time: 09:49
 */

namespace YamiTec\Interfaces;

use YamiTec\DatabaseHandler;

interface Modelifc {
    public function __construct($_db = null);
    public function getData();
    public function setTable($table);
    public function setStore($data);
    public function setUpdate($id,$data);
    public function setDelete($id);
}
abstract class ModelInterface implements Modelifc {
    public $_table = null;
    private $_db = null;
    private $_cnf = null;
    public function __construct($_cnf = []){
        $this->_cnf = ($_cnf == null) ? $this->_cnf : $_cnf;
    }

    /**
     * @return null|DatabaseHandler
     */
    public function getDb()
    {
        $this->_db = new DatabaseHandler($this->_cnf);
        return $this->_db;
    }
    /**
     * @param null $db
     */
    public function setDb($db)
    {
        $this->_db = $db;
    }

    public function setTable($table)
    {
        $this->_table = $table;
    }
    public function getData($conditions = null){
       $data = $this->_db->get()->select()
            ->from($this->_table);
       if($conditions !== null) $data->where($conditions);
        return $this->_db->get()->execute($data)->fetchAll(\PDO::FETCH_CLASS);
    }
    public function setStore($data){
        echo "s Store  : ".$this->table;
    }
    public function setUpdate($id,$data){
        echo "s Update  : ".$this->table;
    }
    public function setDelete($id){
        echo "s Delete  : ".$this->table;
    }
}