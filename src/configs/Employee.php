<?php

class Employee {
    protected $ID;
    protected $name;
    protected $address;
    protected $type;
    protected $baseSalary;
    protected $hourlySalary;
    protected $comission;
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
            $sql='INSERT INTO `employees` (`name`, `address`, `base_salary`, `hourly_salary`, `comission`, `type`) VALUES (:name, :address, :baseSalary, :hourlySalary, :comission, :type);';
            
            $db=$this->db->prepare($sql);
            $db->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
            $db->bindValue(':address', $_POST['address'], PDO::PARAM_STR);
            $db->bindValue(':baseSalary', $this->baseSalary, PDO::PARAM_STR);
            $db->bindValue(':hourlySalary', $this->hourlySalary, PDO::PARAM_STR);
            $db->bindValue(':comission', $this->comission, PDO::PARAM_STR);
            $db->bindValue(':type', $_POST['type'], PDO::PARAM_STR);
            
            $db->execute();
            header('Location: index.php');
        }
    }
    
}
?>