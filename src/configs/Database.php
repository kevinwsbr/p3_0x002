<?php

class Database {
    public $db;

    public function __construct()
    {
        $this->getInstance();
    }

    public function getInstance() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=payroll-system', 'root','root');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}

?>