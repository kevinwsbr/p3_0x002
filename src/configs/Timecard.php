<?php

class Timecard {
    protected $ID;
    protected $time;
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

    public function getTime()
    {
        return $this->time;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getEmployeeID()
    {
        return $this->employeeID;
    }

    public function setData($timecard)
    {
        $this->ID = $timecard['ID'];
        $this->time = $timecard['time'];
        $this->date = $timecard['date'];
        $this->employeeID = $user['idemployee'];
    }

    public function getTimecardsFromEmployee($employeeID)
    {
        $sql='SELECT * FROM `timecards` WHERE `idemployee` = :idemployee;';

        $db=$this->db->prepare($sql);
        $db->bindValue(':idemployee', employeeID, PDO::PARAM_STR);
        $db->execute();

        return $db->fetchAll(PDO::FETCH_ASSOC);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $sql='INSERT INTO `timecards` (`time`, `date`, `idemployee`) VALUES (:time, :date, :idemployee);';
            
            $db=$this->db->prepare($sql);
            $db->bindValue(':time', $_POST['time'], PDO::PARAM_STR);
            $db->bindValue(':date', $_POST['date'], PDO::PARAM_STR);
            $db->bindValue(':idemployee', $_POST['employeeID'], PDO::PARAM_STR);
            
            $db->execute();
            header('Location: index.php');
        }
    }
    
}
?>