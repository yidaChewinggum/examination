<?php
/**
 * Created by PhpStorm.
 * User: shengye
 * Date: 2018/6/26
 * Time: 20:04
 */

namespace lib\model;

use lib\Datebase;


class Model
{
    protected $table;
    protected $host;
    protected $db;
    protected $user;
    protected $pass;
    protected $port = '3306';
    protected $dbobj;
    function __construct($table)
    {
        $dbconfig = require('../lib/config/db.php');
        $this->host = $dbconfig['DB_HOST'];
        $this->db = $dbconfig['DB_NAME'];
        $this->user = $dbconfig['DB_USER'];
        $this->pass = $dbconfig['DB_PASS'];
        $this->port = $dbconfig['DB_PORT'];
        $this->table = $dbconfig['DB_PREFIX'].$table;
        $this->dbobj = new Datebase($this->host,$this->db,$this->user,$this->pass,$this->port);
    }
    public function __call($name, $arg)
    {
        $dbobj = $this->dbobj;
        $data = $dbobj->select_table($this->table);
        return $dbobj->$name();
    }

    private function connet_db() {
    }

}