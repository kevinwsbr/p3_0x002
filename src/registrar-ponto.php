<?php

require_once 'configs/Database.php';
require_once 'configs/Employee.php';
require_once 'configs/Timecard.php';

$conn = new Database();

$employee = new Employee($conn->db);
$timecard = new Timecard($conn->db);

$employees = $employee->getEmployees();

$timecard->register();

?>

<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Registrar Ponto | Sistema de Folha de Pagamento</title>
</head>

<body>
  <?php require_once "components/header.php"; ?>
  <section class="container">
    <div class="row my-3">
      <div class="col col-12">
        <h3>Registrar ponto</h3>
      </div>
    </div>
    <div class="row">
      <div class="col col-12">
        <form action="registrar-ponto.php" method="POST">
          <div class="form-group">
                <label for="employeeID">Selecionar funcionário</label>
                <select required name="employeeID" class="form-control" id="employeeID">
                <?php foreach ($employees as $emp) {?>
                  <option value="<?php echo $emp['ID'];?>"><?php echo $emp['name'];?></option>
                <?php } ?>
                </select>
              </div>
              <div class="row">
                  <div class="col">
                      <div class="form-group">
            <label for="time">Horas trabalhadas</label>
            <input required type="number" min="1" max="16" name="time" class="form-control" id="time" placeholder="Número de horas trabalhadas">
          </div>
                  </div>
                  <div class="col">
<div class="form-group">
            <label for="date">Data do registro</label>
            <input required type="date" name="date" class="form-control" id="date" value="<?php echo date("d/m/Y"); ?>">
          </div>
                  </div>
              </div>

          <button type="submit" class="btn btn-success">Cadastrar</button>
        </form>
      </div>
    </div>
  </section>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/register.js"></script>
  <script>
    $('#employeeID').change(function () {
  switch ($(this).val()) {
    case 'salaried':
      $('#baseSalary').prop("disabled", false);
      $('#hourlySalary').prop("disabled", true);
      $('#comission').prop("disabled", true);
      break;
    case 'comissioned':
      $('#comission').prop("disabled", false);
      $('#hourlySalary').prop("disabled", true);
      $('#baseSalary').prop("disabled", true);
      break;
    case 'hourly':
      $('#hourlySalary').prop("disabled", false);
      $('#baseSalary').prop("disabled", true);
      $('#comission').prop("disabled", true);
      break;
    default:
      break;
  }
});
  </script>
</body>

</html>