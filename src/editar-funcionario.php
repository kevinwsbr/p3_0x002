<?php

require_once 'configs/Database.php';
require_once 'configs/Employee.php';
require_once 'configs/Timecard.php';

$conn = new Database();
$employee = new Employee($conn->db);
$timecard = new Timecard($conn->db);

$employee->getEmployee($_GET['id']);
$timecards = $timecard->getTimecardsFromEmployee($_GET['id']);
$employee->updateData();
print_r($timecards);

?>

<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Editar Funcionário | Sistema de Folha de Pagamento</title>
</head>

<body>
  <?php require_once "components/header.php"; ?>
  <section class="container">
    <div class="row my-3">
      <div class="col col-12">
        <h3>Editar funcionário</h3>
        <div class="dropdown-divider"></div>
      </div>
    </div>
    <div class="row">
      <div class="col col-12">
        <form action="editar-funcionario.php?id=<?php echo $employee->getID(); ?>" method="POST">
          <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" class="form-control" id="name" value="<?php echo $employee->getName();?>" placeholder="Nome do funcionário">
          </div>
          <div class="form-group">
            <label for="address">Endereço</label>
            <input type="text" name="address" class="form-control" id="address" value="<?php echo $employee->getAddress();?>" placeholder="ex.: Rua Sem Futuro, nº 185.">
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="salary">Salário base</label>
                <input type="text" name="baseSalary" class="form-control" id="baseSalary" value="<?php echo $employee->getBaseSalary();?>" placeholder="ex.: Rua Sem Futuro, nº 185.">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="salary">Salário por hora</label>
                <input disabled type="text" name="hourlySalary" class="form-control" id="hourlySalary" value="<?php echo $employee->getHourlySalary();?>" placeholder="ex.: Rua Sem Futuro, nº 185.">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="salary">Comissão por venda</label>
                <input disabled type="text" name="comission" class="form-control" id="comission" value="<?php echo $employee->getComission();?>" placeholder="ex.: Rua Sem Futuro, nº 185.">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="type">Tipo de vínculo</label>
                <select name="type" class="form-control" id="type">
                  <option value="salaried" <?php if($employee->getType() == 'salaried') {echo 'selected';}?>>Assalariado</option>
                  <option value="hourly" <?php if($employee->getType() == 'hourly') {echo 'selected';}?>>Horista</option>
                  <option value="comissioned" <?php if($employee->getType() == 'comissioned') {echo 'selected';}?>>Comissionado</option>
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="type">Filiado a sindicato?</label>
                <select class="form-control" id="type">
                  <option>Não</option>
                  <option>Sim</option>
                </select>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-success">Atualizar registro</button>
        </form>
      </div>
    </div>
  </section>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/register.js"></script>
</body>

</html>