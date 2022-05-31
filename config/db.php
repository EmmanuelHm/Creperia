<?php

class Database{
    public static function connect(){
        $db = new mysqli('localhost', 'root', '', 'creperia2');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}