<?php
/**
 * Created by PhpStorm.
 * User: DIGITAL
 * Date: 29/03/2019
 * Time: 10:14
 */

namespace YamiTec;


use YamiTec\Handlers\YamitecDatabase;

class DatabaseHandler extends YamitecDatabase
{
    public function __construct($_conf = [])
    {
       parent::__construct($_conf);
    }
    public function get()
    {
        return parent::get(); // TODO: Change the autogenerated stub
    }
}