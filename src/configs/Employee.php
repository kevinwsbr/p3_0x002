<?php

class Employee {
    protected $ID;
    protected $name;
    protected $address;
    protected $type;
    protected $baseSalary;
    protected $hourlySalary;
    protected $comission;
    protected $lastPayment;
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getID ()
    {
        return $this->ID;
    }

    public function getName ()
    {
        return $this->name;
    }

    public function getAddress ()
    {
        return $this->address;
    }

    public function getType ()
    {
        return $this->type;
    }

    public function getBaseSalary ()
    {
        return $this->baseSalary;
    }

    public function getHourlySalary ()
    {
        return $this->hourlySalary;
    }

    public function getComission ()
    {
        return $this->comission;
    }

    public function getLastPayment ()
    {
        return $this->lastPayment;
    }

    public function extractData() 
    {
        if(!isset($_POST['baseSalary'])) {
            $this->baseSalary = 0;
        }
        else {
            $this->baseSalary = $_POST['baseSalary'];
        }
        if(!isset($_POST['hourlySalary'])) {
            $this->hourlySalary = 0;
        }
        else {
             $this->hourlySalary = $_POST['hourlySalary'];
        }
        if(!isset($_POST['comission'])) {
            $this->comission = 0;
        }
        else {
            $this->comission = $_POST['comission'];
        }
    }

    public function getEmployee($employeeID) {
        $sql='SELECT * FROM `employees` WHERE `ID` = :ID ;';

        $db=$this->db->prepare($sql);
        $db->bindValue(':ID', $employeeID, PDO::PARAM_STR);
        $db->execute();

        $this->setData($db->fetch(PDO::FETCH_ASSOC));
        print_r($db->fetch(PDO::FETCH_ASSOC));
    }

    public function setData($user)
    {
        $this->ID = $user['ID'];
        $this->name = $user['name'];
        $this->address = $user['address'];
        $this->type = $user['type'];
        $this->baseSalary = $user['base_salary'];
        $this->hourlySalary = $user['hourly_salary'];
        $this->comission = $user['comission'];
    }

    public function updateData() {
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            echo 'teste';
            $this->extractData();

            $sql='UPDATE `employees` SET `name` = :name, `address` = :address, `type` = :type, `base_salary` = :baseSalary, `hourly_salary` = :hourlySalary, `comission` = :comission WHERE `ID` = :ID;';
            
            $db=$this->db->prepare($sql);
            var_dump($sql);
            $db->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
            $db->bindValue(':address', $_POST['address'], PDO::PARAM_STR);
            $db->bindValue(':type', $_POST['type'], PDO::PARAM_STR);
            $db->bindValue(':baseSalary', $_POST['baseSalary'], PDO::PARAM_STR);
            $db->bindValue(':hourlySalary', $_POST['hourlySalary'], PDO::PARAM_STR);
            $db->bindValue(':comission', $_POST['comission'], PDO::PARAM_STR);
            $db->bindValue(':ID', $_GET['id'], PDO::PARAM_STR);

            $db->execute();
            header('Location: index.php');
        }
    }

    public function generatePayroll($date) {
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $sql='SELECT * FROM `employees` WHERE `next_payment` = :date;';

            $db=$this->db->prepare($sql);
            $db->bindValue(':date', $date, PDO::PARAM_STR);

            $db->execute();

            return $db->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function calculatePayment($employeeID) {
        
    }

    public function deleteEmployee($employeeID) {
        if ($_SERVER['REQUEST_METHOD']=='GET') {
            $sql='SET foreign_key_checks = 0; DELETE FROM `sales` WHERE `sales`.`idemployee` = :idemployee; DELETE FROM `taxes` WHERE `taxes`.`idemployee` = :idemployee; DELETE FROM `timecards` WHERE `timecards`.`idemployee` = :idemployee; DELETE FROM `employees` WHERE `employees`.`ID` = :idemployee;';
            
            $db=$this->db->prepare($sql);

            $db->bindValue(':idemployee', $employeeID, PDO::PARAM_STR);

            $db->execute();
        }
    }

    public function getEmployees()
    {
        $sql='SELECT * FROM `employees`;';

        $db=$this->db->prepare($sql);
        $db->execute();

        return $db->fetchAll(PDO::FETCH_ASSOC);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $this->extractData();
            $sql='INSERT INTO `employees` (`name`, `address`, `base_salary`, `hourly_salary`, `comission`, `type`, `last_payment`) VALUES (:name, :address, :baseSalary, :hourlySalary, :comission, :type, :lastPayment);';
            
            $db=$this->db->prepare($sql);
            $db->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
            $db->bindValue(':address', $_POST['address'], PDO::PARAM_STR);
            $db->bindValue(':baseSalary', $this->baseSalary, PDO::PARAM_STR);
            $db->bindValue(':hourlySalary', $this->hourlySalary, PDO::PARAM_STR);
            $db->bindValue(':comission', $this->comission, PDO::PARAM_STR);
            $db->bindValue(':type', $_POST['type'], PDO::PARAM_STR);
            $db->bindValue(':lastPayment', date("Y-m-d H:i:s"), PDO::PARAM_STR);
            
            $db->execute();
            header('Location: index.php');
        }
    }
    
}
?>