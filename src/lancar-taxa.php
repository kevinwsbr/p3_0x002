<?php

require_once 'configs/Database.php';
require_once 'configs/Employee.php';
require_once 'configs/Tax.php';

$conn = new Database();

$employee = new Employee($conn->db);
$tax = new Tax($conn->db);

$employees = $employee->getEmployees();
$tax->register();

?>

<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <title>Lançar Taxa | Sistema de Folha de Pagamento</title>
</head>

<body>
  <?php require_once "components/header.php"; ?>
  <section class="container">
    <div class="row my-3">
      <div class="col col-12">
        <h3>Lançar taxa</h3>
      </div>
    </div>
    <div class="row">
      <div class="col col-12">
        <form action="lancar-taxa.php" method="POST">
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
            <label for="value">Valor da taxa</label>
            <input required type="text" name="value" class="form-control" id="value" placeholder="Custo da taxa">
          </div>
                  </div>
                  <div class="col">
<div class="form-group">
            <label for="date">Data da taxa</label>
            <input required type="date" name="date" class="form-control" id="date" value="<?php echo date("d/m/Y"); ?>">
          </div>
                  </div>
              </div>

          <button type="submit" class="btn btn-success">Registrar taxa</button>
        </form>
      </div>
    </div>
  </section>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/mask.js"></script>
  <script>
      $(document).ready(function(){
        $('#value').mask('000.000.000.000.000,00', {reverse: true});
      });
  </script>
</body>

</html>