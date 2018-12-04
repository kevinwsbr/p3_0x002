<?php

require_once 'configs/Database.php';
require_once 'configs/Employee.php';
require_once 'configs/Timecard.php';
require_once 'configs/Tax.php';
require_once 'configs/Sale.php';

$conn = new Database();

$employee = new Employee($conn->db);
$timecard = new Timecard($conn->db);
$sale = new Sale($conn->db);
$tax = new Tax($conn->db);
$totals = 0;

$employees = $employee->getEmployees();
?>

<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Gerar folha de pagamento | Sistema de Folha de Pagamento</title>
</head>

<body>
  <?php require_once "components/header.php"; ?>
  <section class="container">
    <div class="row my-3">
      <div class="col col-12">
        <h3>Folha de pagamento para <?php echo date('d/m/Y'); ?></h3>
        <div class="dropdown-divider"></div>
      </div>
    </div>
    <div class="row">
      <div class="col col-12">
           <table class="table">
          <thead class="text-white bg-success">
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Salário base</th>
              <th scope="col">Pontos registrados</th>
              <th scope="col">Comissões por venda</th>
              <th scope="col">Taxas</th>
            </tr>
          </thead>
          <tbody>
              <?php
              
              foreach ($employees as $emp) {
                    $timecards = $timecard->getTimecardsFromEmployee($emp['ID']);
                    $taxes = $tax->getTaxesFromEmployee($emp['ID']);
                    $sales = $sale->getSalesFromEmployee($emp['ID']);
                    $total = 0;

              ?>
            <tr>
              <th scope="row">
                <?php echo $emp['name']; ?>
              </th>
              <td>
                  <?php 
                  echo 'R$'.$emp['base_salary'];
                    $total += $emp['base_salary'];
                  ?>
              </td>
              <td>
                  <?php
                  foreach ($timecards as $tcd) {
                      $value;
                      if ($tcd['time'] > 8) {
                          $value = (8*$emp['hourly_salary']) + (($tcd['time']%8)*1.5*$emp['hourly_salary']);
                      }
                      else {
                          $value = $tcd['time']*$emp['hourly_salary'];
                      }
                        echo '<span class="d-block">R$'.$value.'</span>';
                        $total += $value;
                    }
                  ?>
              </td>
              <td>
                  <?php
                  foreach ($sales as $sls) {
                        $value = ($sls['value']*$sls['comission'])/100;
                        echo '<span class="d-block">R$'.$value.'</span>';
                        $total += $value;
                    }
                  
                  ?>
              </td>
              <td>
                  <?php
                  foreach ($taxes as $txe) {
                        echo '<span class="d-block">-R$'.$txe['value'].'</span>';
                        $total -= $txe['value'];
                    }
                  
                  ?>
              </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <th>Valor parcial: <?php echo 'R$'.$total; ?></th>
                <?php
                    $totals += $total;
                ?>
            </tr>
            <?php } ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <th>Pagamento total: <?php echo 'R$'.$totals; ?></th>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>