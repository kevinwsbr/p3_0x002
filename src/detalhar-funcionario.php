<?php

require_once 'configs/Database.php';
require_once 'configs/Employee.php';
require_once 'configs/Timecard.php';

$conn = new Database();
$employee = new Employee($conn->db);
$timecard = new Timecard($conn->db);

$employee->getEmployee($_GET['id']);
$timecards = $timecard->getTimecardsFromEmployee($_GET['id']);

?>

<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Detalhar Funcionário | Sistema de Folha de Pagamento</title>
</head>

<body>
  <?php require_once "components/header.php"; ?>
  <section class="container">
    <div class="row my-3">
      <div class="col col-12">
        <h3>Detalhar funcionário #<?php echo $employee->getID(); ?></h3>
        <div class="dropdown-divider"></div>
      </div>
    </div>
    <div class="row">
      <div class="col col-7">
        <section class="personal-data">
            <div class="row">
                <div class="col">
                    <h4>Dados pessoais</h4>
                </div>
            </div>
            <div class="row">
                <div class="col col-4">
                    <h5>Nome</h5>
                    <p><?php echo $employee->getName();?></p>
                </div>
                <div class="col col-8">
                    <h5>Endereço</h5>
                    <p><?php echo $employee->getAddress();?></p>
                </div>
            </div>
            <div class="row">
                <div class="col col-4">
                    <h5>Vínculo</h5>
                    <p>
                    <?php 
                        if ($employee->getType() == 'comissioned') {
                            echo 'Comissionado';
                        }else if ($employee->getType() == 'salaried') {
                            echo 'Assalariado';
                        }else if ($employee->getType() == 'hourly') {
                            echo 'Horista';
                        }
                    ?>
                    </p>
                </div>
                <div class="col col-8">
                    <h5>Salário</h5>
                    <p>
                    <?php 
                        if ($employee->getType() == 'comissioned') {
                            echo 'R$'.$employee->getComission(). '/venda.';
                        }else if ($employee->getType() == 'salaried') {
                            echo 'R$'.$employee->getBaseSalary();
                        }else if ($employee->getType() == 'hourly') {
                            echo 'R$'.$employee->getHourlySalary(). '/hora.';
                        }
                    ?>
                    </p>
                </div>
            </div>
            
        </section>
      </div>
      <div class="col col-5">
          <section class="timecards-data">
              <div class="row">
                <div class="col">
                    <h4>Cartões de ponto</h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-sm">
          <thead class="text-white bg-success">
            <tr>
              <th scope="col">Data</th>
              <th scope="col">Horas trabalhadas</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($timecards as $tcd) {?>
            <tr>
              <th scope="row">
                <?php echo date('d/m/Y', strtotime($tcd['date'])); ?>
              </th>
              <td>
                <?php echo $tcd['time']; ?>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
                </div>
            </div>
          </section>
      </div>
    </div>
  </section>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/register.js"></script>
</body>

</html>