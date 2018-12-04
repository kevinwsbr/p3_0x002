<?php

require_once 'configs/Database.php';
require_once 'configs/Employee.php';

$conn = new Database();

$employee = new Employee($conn->db);

$employee->deleteEmployee($_GET['id']);

header('Location: index.php');

?>