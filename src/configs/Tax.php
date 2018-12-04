<?php

class Tax {
    protected $ID;
    protected $value;
    protected $date;
    protected $employeeID;
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getEmployeeID()
    {
        return $this->employeeID;
    }

    public function setData($tax)
    {
        $this->ID = $tax['ID'];
        $this->time = $tax['value'];
        $this->date = $tax['date'];
        $this->employeeID = $tax['idemployee'];
    }

    public function getTaxesFromEmployee($employeeID)
    {
        $sql='SELECT * FROM `taxes` WHERE `idemployee` = :idemployee;';

        $db=$this->db->prepare($sql);
        $db->bindValue(':idemployee', $employeeID, PDO::PARAM_STR);
        $db->execute();

        return $db->fetchAll(PDO::FETCH_ASSOC);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $value = str_replace(',', '.', $_POST['value']);
            $sql='INSERT INTO `taxes` (`value`, `date`, `idemployee`) VALUES (:value, :date, :idemployee);';
            
            $db=$this->db->prepare($sql);
            $db->bindValue(':value', $value, PDO::PARAM_STR);
            $db->bindValue(':date', $_POST['date'], PDO::PARAM_STR);
            $db->bindValue(':idemployee', $_POST['employeeID'], PDO::PARAM_STR);
            
            $db->execute();
            header('Location: index.php');
        }
    }
    
}
?>